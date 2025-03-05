@extends('layout.main')
@section('judul')
<title>Daftar Pengguna</title>
@endsection 
@section('subjudul')
<title>Daftar Pengguna</title>
@endsection 
@section('content')
<div class="card-body bg-white shadow-md rounded-lg p-6">
<div class="container mx-auto ">
        <h2 class="text-2xl font-bold text-center mb-6">Daftar Pengguna</h2>
        <a href="pengguna/input" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
    <i class="fas fa-plus"></i> Tambah Data
</a>
<br>
<br>


        <!-- Tabel -->
            <table id="table-data" class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">NO</th>
                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Nama</th>
                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Email</th>
                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Roles</th>
                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @php $no=1; @endphp
                    @foreach ($pengguna as $user)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $no++ }}</td>
                        <td class="py-3 px-4">{{ $user->name }}</td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">{{ $user->roles->name }}</td>
                        <td>
    <div class="flex space-x-2" role="group" aria-label="Button group">
        <!-- Tombol Edit -->
        <a href="pengguna/edit/{{ $user->id }}" class="bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded">
    <i class="fas fa-edit"></i>
</a>

        <!-- Spacer antara tombol -->
        <button class="px-2 py-1"></button>

        <!-- Tombol Delete -->
        <button type="button" class="px-2 py-1 px-4 text-white bg-red-500 hover:bg-red-400  border-b-4 border-red-700 hover:border-red-500 rounded"
            onclick="deleteConfirmation('{{ $user->id }}', '{{ $user->name }}')">
            <i class="fas fa-times"></i>
        </button>
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
                        url: "pengguna/delete/" + npm,
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