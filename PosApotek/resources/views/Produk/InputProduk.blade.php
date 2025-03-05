@extends('layout.main')
@section('judul')
<title>Input Obat</title>
@endsection 
@section('content')
<div class="card-body bg-white shadow-md rounded-lg p-6 mx-auto">
<div class="container ">
        <h2 class="text-2xl font-bold text-center mb-6">Input Obat</h2>

        <!-- Tabel -->
        <div class="flex justify-center">
        <div class="w-full md:w-1/2">
        <form method="post" action="{{ route('produk.submit') }}" enctype="multipart/form-data">
        @csrf
        <!-- Nama -->
        <div class="mb-4">
            <label for="nama_produk" class="block text-sm font-semibold text-gray-700">Nama Obat</label>
            <input type="text" id="nama_produk" name="nama_produk" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan nama Obat">
        </div>
        <div class="mb-4">
    <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis</label>
    <select name="jenis" id="jenis" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="">Pilih Jenis Obat</option>
        <option value="Tablet">Tablet</option>
        <option value="Tablet">Kaplet</option>
        <option value="Tablet">Cair</option>
        <option value="Tablet">Tube</option>
        <option value="Kapsul">Kapsul</option>
        <option value="Sirup">Sirup</option>
        <option value="Salep">Salep</option>
        <option value="Lotion">Lotion</option>
        <option value="Suspensi">Suspensi</option>
        <option value="Inhaler">Inhaler</option>
        <option value="Drops">Drops</option>
        <option value="Suppositoria">Suppositoria</option>
        <option value="Plester">Plester</option>
        <option value="Enema">Enema</option>
        <option value="Infus">Infus</option>
        <option value="Injection">Injection</option>
        <option value="Gel">Gel</option>
        <option value="Lozenges">Lozenges</option>
      
    </select>
</div>
        <!-- Email -->
        <div class="mb-4">
            <label for="harga" class="block text-sm font-semibold text-gray-700">Harga</label>
            <input type="text" id="harga" name="harga" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan Harga Obat">
        </div>
        <div class="mb-4">
            <label for="stok" class="block text-sm font-semibold text-gray-700">Stok</label>
            <input type="number" id="stok" name="stok" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan Stok Obat">
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-semibold text-gray-700">Deskripsi</label>
            <input type="text" id="deskripsi" name="deskripsi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan Deskripsi">
        </div>
        <div class="mb-4">
    <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
    <select name="kategori_id" id="kategori_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="">Pilih Kategori Obat</option>
        @foreach($kategori as $kg)
            <option value="{{$kg->id}}">{{$kg->warna}}({{$kg->nama_kategori}})</option>
        @endforeach
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
      @section('js')
    <script>

$(function() {
var harga = document.getElementById('harga');
harga.addEventListener('keyup', function(e)
{
    harga.value = formatRupiah(this.value);
});

function formatRupiah(angka, prefix)
{
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split    = number_string.split(','),
        sisa     = split[0].length % 3,
        rupiah     = split[0].substr(0, sisa),
        ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
        
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
});
  
        </script>
    @stop