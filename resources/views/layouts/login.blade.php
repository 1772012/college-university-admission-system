<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">
    <meta content="{{ csrf_token() }}" name="csrf-token">

    <title>@yield('web-title', 'Title')</title>

    {{-- Icons --}}
    <link href="{{ asset('assets/images/logo-lpka-white.png') }}" rel="icon">

    {{-- Styles --}}
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('themes/sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('themes/sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/sweetalert/css/sweetalert.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/ion-icons/ion-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/icheck/icheck.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/dropzone/css/dropzone.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/tempusdominus/css/tempusdominus.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/apex-charts/dist/apexcharts.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/color-wheel/css/color-wheel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/redwolfer/css/custom.min.css') }}" rel="stylesheet">
    @stack('styles')

    {{-- Pre scripts --}}
    <script src="{{ asset('assets/vendors/sweetalert/js/sweetalert.min.js') }}"></script>
    @stack('pre-scripts')

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        @yield('content')

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    {{-- Vendor JS files --}}
    <script src="{{ asset('themes/sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('themes/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('themes/sb-admin-2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('themes/sb-admin-2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/sb-admin-2/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('themes/sb-admin-2/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('themes/sb-admin-2/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/font-awesome/js/all.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/dropzone/js/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/tempusdominus/js/tempusdominus.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apex-charts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/color-wheel/js/color-wheel.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/redwolfer/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/sweet-modal/js/sweet-modal.min.js') }}"></script>
    @stack('scripts')

</body>

</html>
