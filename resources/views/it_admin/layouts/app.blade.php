<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'ATK CPS') }}</title>

    {{-- FavIcon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('css/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('css/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('css/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="dist/css/adminlte.min.css"> --}}
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('css/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('css/summernote/summernote-bs4.min.css') }}">
    <!-- custom -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    {{-- bi icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    {{-- Toastr --}}
    <link rel="stylesheet" href="{{ asset('css/toastr/toastr.min.css') }}">
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('it_admin.layouts.navbar')

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="{{ asset('images/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">ATKCPS</span>
            </a>

            @include('it_admin.layouts.navigation')
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        @include('it_admin.layouts.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    @vite('resources/js/app.js')
    <!-- jQuery -->
    {{-- <script src="{{ asset('js/jquery/jquery.min.js') }}"></script> --}}
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    {{-- <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script> --}}
    <!-- Bootstrap 4 -->
    <script src="{{ asset('js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}" defer></script>
    <!-- ChartJS -->
    <script src="{{ asset('js/chart.js/Chart.min.js') }}" defer></script>
    <!-- Sparkline -->
    <script src="{{ asset('js/sparklines/sparkline.js') }}" defer></script>
    <!-- JQVMap -->
    <script src="{{ asset('js/jqvmap/jquery.vmap.min.js') }}" defer></script>
    <script src="{{ asset('js/jqvmap/maps/jquery.vmap.usa.js') }}" defer></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('js/jquery-knob/jquery.knob.min.js') }}" defer></script>
    <!-- daterangepicker -->
    <script src="{{ asset('js/moment/moment.min.js') }}" defer></script>
    <script src="{{ asset('js/daterangepicker/daterangepicker.js') }}" defer></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('js/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}" defer></script>
    <!-- Summernote -->
    <script src="{{ asset('js/summernote/summernote-bs4.min.js') }}" defer></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('js/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}" defer></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/demo/adminlte.js') }}" defer></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('js/demo/demo.js') }}" defer></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('js/demo/pages/dashboard.js') }}" defer></script>
    {{-- Toastr --}}
    <script src="{{ asset('js/toastr/toastr.min.js') }}"></script>
    @yield('scripts')
</body>

</html>
