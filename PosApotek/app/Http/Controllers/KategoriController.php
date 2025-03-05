<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $kategori = Kategori::all();
        return view('kategori.index', compact('user','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $kategori = Kategori::all();
        return view('kategori.InputKategori', compact('user','kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
        { $validate = $req->validate([
            'singkatan'=> 'required',
            'nama_kategori'=> 'required',
            'warna'=> 'required',
        ]);
        $cek = Kategori::where('nama_kategori',$req->get('nama_kategori'))->value('id');
        $cek_lagi = Kategori::where('singkatan',$req->get('singkatan'))->value('id');
        if($cek != null || $cek_lagi != null){
            Session::flash('warning', 'Data Sudah Tersedia');
            return redirect()->route('kategori.index');
        }
        $kategori = new Kategori;
        $kategori->singkatan = $req->get('singkatan');
        $kategori->nama_kategori = $req->get('nama_kategori');
        $kategori->warna = $req->get('warna');
        
        $kategori->save();
        Session::flash('status', 'Tambah data Kategori berhasil!!!');
        return redirect()->route('kategori.index');
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
    public function edit(string $id)
    {
        $user = Auth::user();
        $kategori = Kategori::where('id',$id)->get();
        return view('kategori.EditKategori', compact('user','kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req)
    {
        $kategori= Kategori::find($req->get('id'));
        $validate = $req->validate([
            'singkatan'=> 'required',
            'nama_kategori'=> 'required',
            'warna'=> 'required',
        ]);
        $kategori->singkatan = $req->get('singkatan');
        $kategori->nama_kategori = $req->get('nama_kategori');
        $kategori->warna = $req->get('warna');
        
        $kategori->save();
        Session::flash('status', 'Ubah data Kategori berhasil!!!');
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        $success = true;
        $message = "Data Kategori Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
