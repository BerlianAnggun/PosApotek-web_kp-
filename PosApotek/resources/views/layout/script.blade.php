<!-- plugin for charts  -->
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}" async></script>
  <!-- plugin for scrollbar  -->
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}" async></script>
  <!-- github button -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- main script file  -->
  <script src="{{ asset('assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5') }}" async></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- CDN untuk jQuery dan DataTables CSS/JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table-data').DataTable();
    });
</script>
<!-- Jika menggunakan CDN -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
<!-- SweetAlert2 CDN -->


<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        time: 3000,
    })
    @if(Session::has('message'))
    var type = "{{Session::get('alert-type')}}";
    switch (type) {
        case 'info':
            Toast.fire({
                type: 'info',
                title: "{{Session::get('message')}}"
            })
            break;
        case 'success':
            Toast.fire({
                type: 'success',
                title: "{{Session::get('message')}}"
            })
            break;
        case 'warning':
            Toast.fire({
                type: 'warning',
                title: "{{Session::get('message')}}"
            })
            break;
        case 'error':
            Toast.fire({
                type: 'error',
                title: "{{Session::get('message')}}"
            })
            break;
        case 'dialog_error':
            Toast.fire({
                type: 'error',
                title: "{{Session::get('message')}}",
                timer: 3000
            })
            break;
    }
    @endif

    @if($errors -> any())
    @foreach($errors -> all() as $error)
    Swal.fire({
        type: 'error',
        title: "Ooops",
        text: "{{ $error }}",
    })
    @endforeach
    @endif
    let baseurl = "<?=url('/')?>";
    let fullURL = "<?=url()->full()?>";
    </script>
     <script>
    
    @if(session('warning'))
            Swal.fire({
                title: 'Peringatan!',
                text: "{{ session('warning') }}",
                icon: 'warning',
                timer: 3000
            })
        @endif
        @if($errors->any())
            @php
                $message = '';
                foreach($errors->all() as $error)
                {
                    $message .= $error."<br/>";
                }
            @endphp
            Swal.fire({
                title: 'kesalahan',
                html: "{!! $message !!}",
                icon: 'error',
            })
        @endif

    @if(session('status'))
            Swal.fire({
                title: 'Selamat!',
                text: "{{ session('status') }}",
                icon: 'Success',
                timer: 3000
            })
        @endif
        @if($errors->any())
            @php
                $message = '';
                foreach($errors->all() as $error)
                {
                    $message .= $error."<br/>";
                }
            @endphp
            Swal.fire({
                title: 'kesalahan',
                html: "{!! $message !!}",
                icon: 'error',
            })
        @endif
        
    </script>
        @yield('js')