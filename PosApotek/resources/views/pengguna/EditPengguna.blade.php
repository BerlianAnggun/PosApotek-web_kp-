@extends('layout.main')
@section('judul')
<title>Edit Pengguna</title>
@endsection 
@section('content')
<div class="card-body bg-white shadow-md rounded-lg p-6 mx-auto">
<div class="container  ">
        <h2 class="text-2xl font-bold text-center mb-6">Edit Pengguna</h2>

        <!-- Tabel -->
        <div class="flex justify-center">
        <div class="w-full md:w-1/2">
        @foreach($pengguna as $row)
        <form method="post" action="{{ route('pengguna.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <!-- Nama -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold text-gray-700">Nama</label>
            <input type="text" id="name" name="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{$row->name}}">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
            <input type="email" id="email" name="email" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{$row->email}}"
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
            <input type="password" id="password" name="password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-50">
        </div>
        <div class="mb-4">
    <label for="roles_id" class="block text-sm font-medium text-gray-700">Roles</label>
    <select name="roles_id" id="roles_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="{{$row->roles_id}}">{{$row->roles->name}}</option>
        @foreach($roles as $rl)
            <option value="{{$rl->id}}">{{$rl->name}}</option>
        @endforeach
    </select>
</div>


        <!-- Submit Button -->
        <div class="mt-6">
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