@extends('layout.main')
@section('judul')
<title>Input Laporan</title>
@endsection 
@section('content')
<div class="card-body bg-white shadow-md rounded-lg p-6 mx-auto">
<div class="container ">
        <h2 class="text-2xl font-bold text-center mb-6">Input Laporan</h2>

        <!-- Tabel -->
        <div class="flex justify-center">
        <div class="w-full md:w-1/2">
        <form method="post" action="{{ route('laporan.submit') }}" enctype="multipart/form-data">
        @csrf
        <!-- Nama -->
        <div class="mb-4">
            <label for="dari_tanggal" class="block text-sm font-semibold text-gray-700">Dari Tanggal</label>
            <input type="date" id="dari_tanggal" name="dari_tanggal" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan nama Anda">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="sampai_tanggal" class="block text-sm font-semibold text-gray-700">Sampai Tanggal</label>
            <input type="date" id="sampai_tanggal" name="sampai_tanggal" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan email Anda">
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