@extends('layout.main')
@section('judul')
<title>Edit Laporan</title>
@endsection 
@section('content')
<div class="card-body bg-white shadow-md rounded-lg p-6 mx-auto">
<div class="container  ">
        <h2 class="text-2xl font-bold text-center mb-6">Edit Laporan</h2>

        <!-- Tabel -->
        <div class="flex justify-center">
        <div class="w-full md:w-1/2">
        @foreach($laporan as $row)
        <form method="post" action="{{ route('laporan.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <!-- Nama -->
        <div class="mb-4">
            <label for="dari_tanggal" class="block text-sm font-semibold text-gray-700">Dari Tanggal</label>
            <input type="date" id="dari_tanggal" name="dari_tanggal" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"  value="{{$row->dari_tanggal}}">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="sampai_tanggal" class="block text-sm font-semibold text-gray-700">Nama Kategori</label>
            <input type="date" id="sampai_tanggal" name="sampai_tanggal" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{$row->sampai_tanggal}}">
        </div>


        <!-- Submit Button -->
        <div class="mt-6">
        <input type="hidden" name="id" value="{{$row->id}}" />
        <input type="hidden" name="kode" value="{{$row->kode}}" />
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Ubah Data
            </button>
        </div>
        
    </form>
    @endforeach
        </div>
    </div>
    </div>
    </div>
      @endsection