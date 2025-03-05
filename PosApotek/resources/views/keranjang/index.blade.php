@extends('layout.main')

@section('judul')
<title>Daftar Keranjang</title>
@endsection

@section('subjudul')
<title>Daftar Keranjang</title>
@endsection

@section('content')
<div class="card-body bg-white shadow-md rounded-lg p-6">
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold text-center mb-6">Cari Barang</h2>
        @if(Auth::user()->roles_id == 1 || Auth::user()->roles_id == 5)
        @endif

        <!-- Tabel -->
        <div class="container mt-5">
        <ul class="flex space-x-4">
    <li>
    <a class="text-blue-500 border-b-2 border-blue-500" href="{{ route('transaksi.index') }}">Transaksi</a>
    </li>
    <li>
        <a class="text-gray-700 border-b-2 hover:text-blue-500">Keranjang</a>
    </li>
</ul>
<br>
<form action="{{ route('keranjang.submit') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="kode" class="block text-sm font-semibold text-gray-700">Kode Obat</label>
                        <input type="text" name="kode" id="barang" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukan Kode" />  
                        <div id="listbarang"></div>
                      </div>
                    <div class="mb-4">
                        <label for="jumlah" class="block text-sm font-semibold text-gray-700">Jumlah</label>
                        <input type="number" id="jumlah" name="jumlah" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Simpan
                        </button>
                    </div>
                </form>
                <br>
                <h2 class="text-2xl font-bold text-center mb-6">Daftar Keranjang</h2>

            <table id="table-data" class="min-w-full bg-white border border-gray-200 rounded-lg table-auto sm:overflow-x-auto">                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($keranjang as $item)
                        <tr>
                            <td>{{ $item->produk->kode }}</td>
                            <td>{{ $item->produk->nama_produk }}</td>
                            <td>
                                <input type="number" value="{{ $item->quantity }}" class="w-20 pl-2" onchange="updateQuantity({{ $item->id }}, this.value)">
                            </td>
                            <td>Rp.{{ $item->produk->harga }}</td>
                            <td>Rp.{{ $item->total }}</td>
                            <td>
                                <button type="button" class="px-2 py-1 px-4 text-white bg-red-500 hover:bg-red-400 border-b-4 border-red-700 hover:border-red-500 rounded" onclick="deleteConfirmation('{{ $item->id }}', '{{ $item->kode }}')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <td colspan="4"><b>Jumlah Pembayaran</b></td>
                        <td>Rp.<b>{{$total}}</b></td>
                    </tfoot>
                </table>
                <form action="{{ route('keranjang.bayar') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="jumlah_uang" class="block text-sm font-semibold text-gray-700">Jumlah Uang</label>
                        <input type="text" id="jumlah_uang" name="jumlah_uang" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" onchange="hitungKembalian(this.value)">
                    </div>
                    <div class="mb-4">
                        <label for="kembalian" class="block text-sm font-semibold text-gray-700">Kembalian</label>
                        <input type="text" id="kembalian" name="kembalian" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" readonly>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Bayar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
function updateQuantity(id, quantity) {
    $.ajax({
        type: 'PATCH',
        url: '/keranjang/update',
        data: {
            id: id,
            quantity: quantity,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            console.log(response);
            location.reload();
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

    function hitungKembalian(jumlah_uang) {
        var total = '{{$total}}';
        var kembalian = jumlah_uang - total;
        document.getElementById('kembalian').value = kembalian;
    }
    function deleteConfirmation(npm, judul) {
            swal.fire({
                title: "Hapus?",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus data dengan nama " + judul + "?!",

                showCancelButton: !0,
                confirmButtonText: "Ya, lakukan!",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "keranjang/delete/" + npm,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results.success === true) {
                                swal.fire("Done!", results.message, "success");
                                // refresh page after 2 seconds
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                swal.fire("Error!", results.message, "error");
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }
        $(document).ready(function() {
            $('#edit-nik').prop('disabled',true);
$('#barang').keyup(function() {
    var query = $(this).val();
    if (query != '') {
        var _token = $('input[name="csrf-token"]').val();
        $.ajax({
            url: "{{ url('keranjang/fetch') }}",
            method: "GET",
            data: {
                query: query,
                _token: _token
            },
            success: function(data) {
                $('#listbarang').fadeIn();
                $('#listbarang').html(data);
            }
        });
    }
});
});

$(document).on('click', 'li', function() {
    $('#barang').val($(this).text());
    $('#listbarang').fadeOut();

  
});
</script>

@stop