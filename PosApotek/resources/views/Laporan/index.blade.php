@extends('layout.main')
@section('judul')
<title>Daftar Laporan</title>
@endsection 
@section('subjudul')
<title>Daftar Laporan</title>
@endsection 
@section('content')
<div class="card-body bg-white shadow-md rounded-lg p-6">
<div class="container mx-auto ">
        <h2 class="text-2xl font-bold text-center mb-6">Daftar Laporan</h2>
        @if(Auth::user()->roles_id == 1 || Auth::user()->roles_id == 3)
        <a href="laporan/input" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
    <i class="fas fa-plus"></i> Tambah Data
</a>
@endif
<br>
<br>


        <!-- Tabel -->
            <table id="table-data" class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="text-left py-3 pxaaaaaaa-4 text-gray-700 font-semibold">NO</th>
                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Kode</th>
                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Dari Tanggal</th>
                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Sampai Tanggal</th>
                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @php $no=1; @endphp
                    @foreach ($laporan as $row)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $no++ }}</td>
                        <td class="py-3 px-4">{{ $row->kode }}</td>
                        <td class="py-3 px-4">{{ $row->dari_tanggal }}</td>
                        <td class="py-3 px-4">{{ $row->sampai_tanggal }}</td>
                        <td>
                        @if(Auth::user()->roles_id == 1 || Auth::user()->roles_id == 3)
    <div class="flex space-x-2" role="group" aria-label="Button group">
        <!-- Tombol Edit -->
        <a href="laporan/edit/{{ $row->id }}" class="bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded">
    <i class="fas fa-edit"></i>
</a>

        <!-- Spacer antara tombol -->
        <button class="px-2 py-1"></button>

        <!-- Tombol Delete -->
        <button type="button" class="px-2 py-1 px-4 text-white bg-red-500 hover:bg-red-400  border-b-4 border-red-700 hover:border-red-500 rounded"
            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->sampai_tanggal }}')">
            <i class="fas fa-times"></i>
        </button>
        <button class="px-2 py-1"></button>
        <a href="laporan/print/{{ $row->dari_tanggal }}/{{$row->sampai_tanggal}}" class="bg-yellow-500 hover:bg-yellow-400 text-white font-bold py-2 px-4 border-b-4 border-yellow-700 hover:border-yellow-500 rounded">
    <i class="fas fa-print"></i>
</a>
@elseif(Auth::user()->roles_id == 2)

        <a href="laporan/print/{{ $row->dari_tanggal }}/{{$row->sampai_tanggal}}" class="bg-yellow-500 hover:bg-yellow-400 text-white font-bold py-2 px-4 border-b-4 border-yellow-700 hover:border-yellow-500 rounded">
    <i class="fas fa-print"></i>
</a>
@endif
    </div>
</td>

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
                        url: "laporan/delete/" + npm,
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