<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard1', 
    [DashboardController::class, 'index']
)->middleware(['auth', 'verified'])->name('dashboard1');
Route::get('/dashboard2', 
    [DashboardController::class, 'index2']
)->middleware(['auth', 'verified'])->name('dashboard2');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::get('/pengguna/input', [PenggunaController::class, 'create'])->name('pengguna.input');
    Route::post('/pengguna/input', [PenggunaController::class, 'store'])->name('pengguna.submit');
    Route::get('/pengguna/edit/{id}', [PenggunaController::class, 'edit'])->name('pengguna.edit');
    Route::patch('/pengguna/edit', [PenggunaController::class, 'update'])->name('pengguna.update');
    Route::post('/pengguna/delete/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.delete');
});
Route::middleware('auth')->group(function () {
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/input', [KategoriController::class, 'create'])->name('kategori.input');
    Route::post('/kategori/input', [KategoriController::class, 'store'])->name('kategori.submit');
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::patch('/kategori/edit', [KategoriController::class, 'update'])->name('kategori.update');
    Route::post('/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.delete');
});
Route::middleware('auth')->group(function () {
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/input', [ProdukController::class, 'create'])->name('produk.input');
    Route::post('/produk/input', [ProdukController::class, 'store'])->name('produk.submit');
    Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::patch('/produk/edit', [ProdukController::class, 'update'])->name('produk.update');
    Route::post('/produk/delete/{id}', [ProdukController::class, 'destroy'])->name('produk.delete');
    Route::get('/produk/keranjang/{id}', [ProdukController::class, 'tambah_keranjang'])->name('produk.keranjang');
});
Route::middleware('auth')->group(function () {
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang');
    Route::post('/keranjang', [KeranjangController::class, 'submit'])->name('keranjang.submit');
    Route::get('/keranjang/fetch', [KeranjangController::class, 'fetch_obat'])->name('keranjang.fetch');
    Route::post('/keranjang/bayar', [KeranjangController::class, 'bayar'])->name('keranjang.bayar');
    Route::patch('/keranjang/update', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::post('/keranjang/delete/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.delete');
});
Route::middleware('auth')->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/input', [TransaksiController::class, 'create'])->name('transaksi.input');
    Route::post('/transaksi/input', [TransaksiController::class, 'store'])->name('transaksi.submit');
    Route::get('/transaksi/edit/{id}', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::patch('/transaksi/edit', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::post('/transaksi/delete/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.delete');
});
Route::middleware('auth')->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/input', [LaporanController::class, 'create'])->name('laporan.input');
    Route::post('/laporan/input', [LaporanController::class, 'store'])->name('laporan.submit');
    Route::get('/laporan/edit/{id}', [LaporanController::class, 'edit'])->name('laporan.edit');
    Route::patch('/laporan/edit', [LaporanController::class, 'update'])->name('laporan.update');
    Route::post('/laporan/delete/{id}', [LaporanController::class, 'destroy'])->name('laporan.delete');
    Route::get('/laporan/print/{dari}/{sampai}', [LaporanController::class, 'cetak'])->name('laporan.cetak');
});

require __DIR__.'/auth.php';
