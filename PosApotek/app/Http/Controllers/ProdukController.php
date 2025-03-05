<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Keranjang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $produk = Produk::with('kategori')->get();
        $kategori = Kategori::all();
        return view('Produk.index', compact('user','produk','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $produk = Produk::with('kategori')->get();
        $kategori = Kategori::all();
        return view('Produk.InputProduk', compact('user','produk','kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    { $validate = $req->validate([
            'nama_produk'=> 'required',
            'harga'=> 'required',
            'stok'=> 'required',
            'deskripsi'=> 'required',
            'jenis'=> 'required',
            'kategori_id'=> 'required',
        ]);
        $cari_kode = Kategori::where('id',$req->get('kategori_id'))->value('singkatan');
        $id = IdGenerator::generate(['table' => 'produks','field'=>'kode', 'length' => 7, 'prefix' =>$cari_kode]);
       
        $produk = new Produk;
        $produk->kode = $id;
        $produk->nama_produk = $req->get('nama_produk');
        $produk->jenis = $req->get('jenis');
        $produk->harga =str_replace('.','',$req->get('harga'));
        $produk->stok =  $req->get('stok');
        $produk->deskripsi =  $req->get('deskripsi');
        $produk->kategori_id = $req->get('kategori_id');
        $produk->save();
        Session::flash('status', 'Tambah data Produk berhasil!!!');
        return redirect()->route('produk.index');
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
        $produk = Produk::where('id',$id)->with('kategori')->get();
        $kategori = Kategori::all();
        return view('Produk.EditProduk', compact('user','produk','kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req)
    {
        $produk= Produk::find($req->get('id'));
        $validate = $req->validate([
            'nama_produk'=> 'required',
            'harga'=> 'required',
            'stok'=> 'required',
            'jenis'=> 'required',
            'deskripsi'=> 'required',
            'kategori_id'=> 'required',
        ]);
        $produk->nama_produk = $req->get('kode');
        $produk->nama_produk = $req->get('nama_produk');
        $produk->jenis = $req->get('jenis');
        $produk->harga = str_replace('.','',$req->get('harga'));
        $produk->stok =  $req->get('stok');
        $produk->deskripsi =  $req->get('deskripsi');
        $produk->kategori_id = $req->get('kategori_id');
        $produk->save();
        Session::flash('status', 'Ubah data Produk berhasil!!!');
        return redirect()->route('produk.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $hapus = DB::table('transaksis')->where('produk_id', $id)->delete();
        $produk->delete();
        $success = true;
        $message = "Data Produk Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function tambah_keranjang($id)
    {
        $total = Produk::where('id',$id)->value('harga');
        $keranjang = new Keranjang;
        $keranjang->user_id = auth()->user()->id;
        $keranjang->produk_id = $id;
        $keranjang->quantity = 1;
        $keranjang->inisial =  1;
        $keranjang->total =  $total;
        $keranjang->save();
        Session::flash('status', 'Tambah data Keranjang berhasil!!!');
        return redirect()->route('produk.index');
    }
}
