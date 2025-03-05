@extends('layout.main')
@section('judul')
<title>Daftar Transaksi</title>
@endsection 
@section('subjudul')
<title>Daftar Transaksi</title>
@endsection 
@section('content')
<div class="card-body bg-white shadow-md rounded-lg p-6">
<div class="container mx-auto ">
        <h2 class="text-2xl font-bold text-center mb-6"> Transaksi</h2>
        <ul class="flex space-x-4">
    <li>
        <a class="text-gray-700 border-b-2 hover:text-blue-500">Transaksi</a>
    </li>
    <li>
        <a class="text-blue-500 border-b-2 border-blue-500" href="{{ route('keranjang') }}">Keranjang</a>
    </li>
</ul>

<br>
<br>


        <!-- Tabel -->
        <table id="table-data" class="min-w-full bg-white border border-gray-200 rounded-lg table-auto sm:overflow-x-auto">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">NO</th>
                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Kode Transaksi</th>
                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Kode Obat</th>
                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Nama Obat</th>
                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Tanggal</th>
                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Jumlah</th>
                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Total</th>
                    </tr>
                </thead>
                <tbody>
                @php $no=1; @endphp
                    @foreach ($transaksi as $row)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $no++ }}</td>
                        <td class="py-3 px-4">{{ $row->kode }}</td>
                        <td class="py-3 px-4">{{ $row->produk->kode }}</td>
                        <td class="py-3 px-4">{{ $row->produk->nama_produk }}</td>
                        <td class="py-3 px-4">{{ $row->waktu }}</td>
                        <td class="py-3 px-4">{{ $row->jumlah }}</td>
                        <td class="py-3 px-4">{{ $row->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection
    @section('js')
    <script>

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
                        url: "transaksi/delete/" + npm,
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
  
        </script>
    @stop