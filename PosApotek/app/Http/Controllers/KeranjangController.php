<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use PDF;

class KeranjangController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $keranjang = Keranjang::where('inisial',1)->get();
        $total = Keranjang::where('inisial',1)->sum('total');
        return view('keranjang.index', compact('user','keranjang','total'));
    }
    public function update(Request $request)
    {
        $keranjang = Keranjang::find($request->id);
        if (!$keranjang) {
            return response()->json(['error' => 'Keranjang tidak ditemukan'], 404);
        }
        $keranjang->quantity = $request->quantity;
        $harga =Produk::where('id',$keranjang->produk_id)->value('harga');
        $total =$keranjang->quantity * $harga;
        $keranjang->total = $total;
        $keranjang->save();
        return response()->json(['success' => 'Keranjang berhasil diupdate']);
    }
    public function destroy($id)
    {
        $keranjang = Keranjang::find($id);
        $keranjang->delete();
        $success = true;
        $message = "Data Keranjang Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function bayar(Request $req){
        if($req->get('jumlah_uang')==null){
            Session::flash('status', 'Masukan Jumlah Uang!!!');
            return redirect()->route('keranjang');
        }
        else{
        $user = Auth::user();
        $keranjang = Keranjang::where('inisial',1)->get();
        $total = Keranjang ::where('inisial',1)->sum('total');
        $jumlah_uang = $req->get('jumlah_uang');
        $kembalian = $req->get('kembalian');
        $tanggal = Carbon::now('Asia/Jakarta');
        $kode = Transaksi::orderBy('id','desc')->paginate(1);
        $pdf = PDF::loadview('Laporan.struk',['keranjang'=>$keranjang,'total'=>$total,'jumlah_uang'=>$jumlah_uang,'kembalian'=>$kembalian,'tanggal'=>$tanggal, 'kode'=>$kode]);     

        $id = IdGenerator::generate(['table' => 'transaksis','field'=>'kode', 'length' => 7, 'prefix' =>'TS']);
        foreach($keranjang as $row){
            $stok = Produk::where('id',$row->produk_id)->value('stok');
            $transaksi = new Transaksi;
            $transaksi->kode = $id;
            $transaksi->jumlah = $row->quantity;
            $transaksi->total = $row->total;
            $transaksi->tanggal =  Carbon::now('Asia/Jakarta');
            $transaksi->waktu =  Carbon::now('Asia/Jakarta');
            $transaksi->produk_id = $row->produk_id;
            $transaksi->save();
            $jumlah = $stok - $row->quantity;
            $sum = DB::table('produks')->where('id', $row->produk_id)->update([ 'stok' =>$jumlah]);
        }
        $hapus = DB::table('keranjangs')->where('inisial',1)->delete();
       
        Session::flash('status', 'Tambah data Transaksi berhasil!!!');
        set_time_limit(300);
        return $pdf->download('struk.pdf');
        
    }
    }
    function fetch_obat(Request $request)
{
    if($request->get('query'))
    {
        $query = $request->get('query');
        $data = DB::table('produks')
            ->where('kode', 'LIKE', "%{$query}%")
            ->get();
        $output = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%;">';
        foreach($data as $row)
        {
            $output .= '
            <li><a class="dropdown-item" href="#">'.$row->kode.'</a></li>
            ';
        }
        $output .= '</ul>';
        echo $output;
    }
}
public function submit(Request $req)
{
    $keranjang = new Keranjang;
    $id =Produk::where('kode',$req->get('kode'))->value('id');
    $keranjang->produk_id = $id;
    $keranjang->quantity =$req->get('jumlah');
    $harga =Produk::where('kode',$req->get('kode'))->value('harga');
    $total =$req->get('jumlah') * $harga;
    $keranjang->inisial = 1;
    $keranjang->user_id = auth()->user()->id;
    $keranjang->total = $total;
    $keranjang->save();
    Session::flash('status', 'Tambah data Keranjang berhasil!!!');
    return redirect()->route('keranjang');}
}
