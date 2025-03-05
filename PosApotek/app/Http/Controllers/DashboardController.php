<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $produk = Produk::COUNT();
        $kategori = Kategori::COUNT();
        $pengguna = User::COUNT();
        $transaksi = Transaksi::COUNT();
        $dataProduk = Produk::select(DB::raw("COUNT(*) as count"))->whereYear("created_at",date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck('count');
        $dataTransaksi = Transaksi::select(DB::raw("COUNT(*) as count"))->whereYear("tanggal",date('Y'))->groupBy(DB::raw("Month(tanggal)"))->pluck('count');
        return view('Dashboard.DashboardAdmin', compact('user','produk','kategori','pengguna','transaksi','dataProduk','dataTransaksi'));
    }
    public function index2()
    {
        $user = Auth::user();
        $produk = Produk::COUNT();
        $kategori = Kategori::COUNT();
        $pengguna = User::COUNT();
        $transaksi = Transaksi::COUNT();
        return view('Dashboard.DashboardUser', compact('user','produk','kategori','pengguna','transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
