<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Eirehome</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- Sumernote --}}
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/plugins/summernote/summernote-bs4.min.css') }}">
    {{-- Chart.js --}}
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/plugins/chart.js/Chart.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/custom.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('backend.admin.layout.partials.nav')
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @include('backend.admin.layout.partials.sidebar')
        <!-- Content Wrapper. Contains page content -->
        @yield('main-content')
        <!-- /.content-wrapper -->
        @include('backend.admin.layout.partials.footer')

    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('backend/admin/assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- Summernote --}}
    <script src="{{ asset('backend/admin/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/admin/assets/js/adminlte.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    {{-- Chart.js --}}
    <script src="{{ asset('backend/admin/assets/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('backend/admin/assets/js/demo.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.toast').toast('show');
        });
    </script>

    @yield('custom-js')
</body>

</html>
