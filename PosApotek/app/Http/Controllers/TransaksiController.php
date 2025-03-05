<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $transaksi = Transaksi::with('produk')->get();
        $produk = Produk::all();
        return view('Transaksi.index', compact('user','produk','transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $transaksi = Transaksi::with('produk')->get();
        $produk = Produk::all();
        return view('Transaksi.InputTransaksi', compact('user','produk','transaksi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $validate = $req->validate([
            'jumlah'=> 'required',
            'tanggal'=> 'required',
            'produk_id'=> 'required',
        ]);

        $transaksi = new Transaksi;
        $id = IdGenerator::generate(['table' => 'transaksis','field'=>'kode', 'length' => 7, 'prefix' =>'TS']);
        $produk = Produk::where('kode',$req->get('produk_id'))->value('id');
        if($produk == null){
            Session::flash('warning', 'Data Tidak Ditemukan');
            return redirect()->route('transaksi.index');
        }
        $harga = Produk::where('kode',$req->get('produk_id'))->value('harga');
        $stok = Produk::where('kode',$req->get('produk_id'))->value('stok');
        $total = $harga * $req->get('jumlah');
        $transaksi->kode = $id;
        $transaksi->jumlah = $req->get('jumlah');
        $transaksi->total = $total;
        $transaksi->tanggal =  $req->get('tanggal');
        $transaksi->produk_id = $produk;
        $transaksi->save();
        $jumlah = $stok - $req->get('jumlah');
        $sum = DB::table('produks')->where('id', $produk)->update([ 'stok' =>$jumlah]);
        Session::flash('status', 'Tambah data Transaksi berhasil!!!');
        return redirect()->route('transaksi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        $transaksi = Transaksi::where('id',$id)->with('produk')->get();
        $produk = Produk::all();
        return view('Transaksi.EditTransaksi', compact('user','produk','transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req)
    {
        $transaksi= Transaksi::find($req->get('id'));
        $validate = $req->validate([
            'jumlah'=> 'required',
            'tanggal'=> 'required',
            'produk_id'=> 'required',
        ]);
        $produk = Produk::where('kode',$req->get('produk_id'))->value('id');
        if($produk == null){
            Session::flash('warning', 'Data Tidak Ditemukan');
            return redirect()->route('transaksi.index');
        }
        $harga = Produk::where('kode',$req->get('produk_id'))->value('harga');
        $stok = Produk::where('kode',$req->get('produk_id'))->value('stok');
        $total = $harga * $req->get('jumlah');
        $transaksi->kode =$req->get('kode');
        $transaksi->jumlah = $req->get('jumlah');
        $transaksi->total = $total;
        $transaksi->tanggal =  $req->get('tanggal');
        $transaksi->produk_id = $produk;
        $transaksi->save();
        $jumlah1 = $stok + $req->get('old_jumlah');
        $jumlah = $jumlah1 - $req->get('jumlah');
        $sum = DB::table('produks')->where('id', $produk)->update([ 'stok' =>$jumlah]);
        Session::flash('status', 'Ubah data Transaksi berhasil!!!');
        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
        $stok = Produk::where('id', $transaksi->produk_id)->value('stok');
        $jumlah = $stok + $transaksi->jumlah;
        $sum = DB::table('produks')->where('id', $transaksi->produk_id)->update([ 'stok' =>$jumlah]);
        $transaksi->delete();
        $success = true;
        $message = "Data Transkasi Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
