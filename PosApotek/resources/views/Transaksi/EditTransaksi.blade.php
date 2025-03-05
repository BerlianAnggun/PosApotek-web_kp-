@extends('layout.main')
@section('judul')
<title>Edit Pengguna</title>
@endsection 
@section('content')
<div class="card-body bg-white shadow-md rounded-lg p-6 mx-auto">
<div class="container  ">
        <h2 class="text-2xl font-bold text-center mb-6">Edit Transaksi</h2>

        <!-- Tabel -->
        <div class="flex justify-center">
        <div class="w-full md:w-1/2">
        @foreach($transaksi as $row)
        <form method="post" action="{{ route('transaksi.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <!-- Nama -->
        <div class="mb-4">
            <label for="produk_id" class="block text-sm font-semibold text-gray-700">Kode Obat</label>
            <input type="text" id="produk_id" name="produk_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{$row->produk->kode}}" readonly>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="tanggal" class="block text-sm font-semibold text-gray-700">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{$row->tanggal}}" >
        </div>
        <div class="mb-4">
            <label for="jumlah" class="block text-sm font-semibold text-gray-700">Jumlah</label>
            <input type="number" id="jumlah" name="jumlah" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{$row->jumlah}}">
        </div>


        <!-- Submit Button -->
        <div class="mt-6">
        <input type="hidden" name="old_jumlah" value="{{$row->jumlah}}" />
        <input type="hidden" name="kode" value="{{$row->kode}}" />
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