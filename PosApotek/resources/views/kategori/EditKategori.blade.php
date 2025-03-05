@extends('layout.main')
@section('judul')
<title>Edit Pengguna</title>
@endsection 
@section('content')
<div class="card-body bg-white shadow-md rounded-lg p-6 mx-auto">
<div class="container  ">
        <h2 class="text-2xl font-bold text-center mb-6">Edit Kategori</h2>

        <!-- Tabel -->
        <div class="flex justify-center">
        <div class="w-full md:w-1/2">
        @foreach($kategori as $row)
        <form method="post" action="{{ route('kategori.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <!-- Nama -->
        <div class="mb-4">
            <label for="singkatan" class="block text-sm font-semibold text-gray-700">Singkatan</label>
            <input type="text" id="singkatan" name="singkatan" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"  value="{{$row->singkatan}}">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="nama_kategori" class="block text-sm font-semibold text-gray-700">Nama Kategori</label>
            <input type="text" id="nama_kategori" name="nama_kategori" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{$row->nama_kategori}}">
        </div>
        <div class="mb-4">
    <label for="warna" class="block text-sm font-medium text-gray-700">Kategori</label>
    <select name="warna" id="warna" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="{{$row->warna}}">{{$row->warna}}</option>
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
        <input type="hidden" name="old_foto" value="{{$row->foto}}" />
        <input type="hidden" name="id" value="{{$row->id}}" />
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