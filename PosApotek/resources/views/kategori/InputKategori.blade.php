@extends('layout.main')
@section('judul')
<title>Input Pengguna</title>
@endsection 
@section('content')
<div class="card-body bg-white shadow-md rounded-lg p-6 mx-auto">
<div class="container ">
        <h2 class="text-2xl font-bold text-center mb-6">Input Kategori</h2>

        <!-- Tabel -->
        <div class="flex justify-center">
        <div class="w-full md:w-1/2">
        <form method="post" action="{{ route('kategori.submit') }}" enctype="multipart/form-data">
        @csrf
        <!-- Nama -->
        <div class="mb-4">
            <label for="singkatan" class="block text-sm font-semibold text-gray-700">Singkatan</label>
            <input type="text" id="singkatan" name="singkatan" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan singkatan">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="nama_kategori" class="block text-sm font-semibold text-gray-700">Nama Kategori</label>
            <input type="text" id="nama_kategori" name="nama_kategori" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan Kategori Obat">
        </div>
        <div class="mb-4">
    <label for="warna" class="block text-sm font-medium text-gray-700">Kategori</label>
    <select name="warna" id="warna" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="">Pilih Warna Kategori</option>
        <option value="HIJAU">HIJAU</option>
        <option value="BIRU">BIRU</option>
        <option value="PUTIH">PUTIH</option>
        <option value="MERAH">MERAH</option>
        <option value="ORANYE">ORANYE</option>
        <option value="HITAM">HITAM</option>
       
    </select>
</div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Simpan Data
            </button>
        </div>
        
    </form>
        </div>
    </div>
    </div>
    </div>
      @endsection