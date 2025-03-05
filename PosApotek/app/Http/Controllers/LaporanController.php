<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use PDF;
use Barryvdh\DomPDF\Facade;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $laporan = Laporan::all();
        return view('Laporan.index', compact('user','laporan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $laporan = Laporan::all();
        return view('Laporan.InputLaporan', compact('user','laporan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $validate = $req->validate([
            'dari_tanggal'=> 'required',
            'sampai_tanggal'=> 'required',
        ]);

        $laporan = new Laporan;
        $id = IdGenerator::generate(['table' => 'laporans','field'=>'kode', 'length' => 10, 'prefix' =>'LP-']);
        $laporan->kode = $id;
        $laporan->dari_tanggal = $req->get('dari_tanggal');
        $laporan->sampai_tanggal = $req->get('sampai_tanggal');
        $laporan->save();
        Session::flash('status', 'Tambah data Laporan berhasil!!!');
        return redirect()->route('laporan.index');
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
        $laporan = Laporan::where('id',$id)->paginate(1);
        return view('Laporan.EditLaporan', compact('user','laporan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req)
    {
        $laporan= Laporan::find($req->get('id'));
        $validate = $req->validate([
            'dari_tanggal'=> 'required',
            'sampai_tanggal'=> 'required',
        ]);

        $laporan->kode = $req->get('kode');
        $laporan->dari_tanggal = $req->get('dari_tanggal');
        $laporan->sampai_tanggal = $req->get('sampai_tanggal');
        $laporan->save();
        Session::flash('status', 'Ubah data Laporan berhasil!!!');
        return redirect()->route('laporan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $laporan = Laporan::find($id);
        $laporan->delete();
        $success = true;
        $message = "Data Laporan Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function cetak($dari,$sampai){
        $user = Auth::user();
        $laporan = Laporan::where('dari_tanggal',$dari)->where('sampai_tanggal',$sampai)->get();
        $transaksi = Transaksi::whereBetween('tanggal', [$dari, $sampai])->get();
        $total = DB::table('transaksis')
            ->whereBetween('tanggal', [$dari, $sampai])
            ->sum(DB::raw('(transaksis.total)'));
        $tanggal = Carbon::now('Asia/Jakarta');
        $pdf = PDF::loadview('Laporan.cetak',['transaksi'=>$transaksi,'total'=>$total,'tanggal'=>$tanggal, 'laporan'=>$laporan]);
        set_time_limit(300);
        return $pdf->stream('laporan.pdf');
    }
    public function getObat($kode)
{
    // Assuming you have a model called Obat and a 'kode' column in your database
    $obat = Obat::where('kode', $kode)->first();
    
    if ($obat) {
        return response()->json([
            'kode' => $obat->kode
        ]);
    } else {
        return response()->json([
            'error' => 'Kode obat tidak ditemukan'
        ], 404);
    }
}
}
