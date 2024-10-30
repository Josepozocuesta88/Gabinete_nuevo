<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="description"
        content="Creada en 1985, Repostería Flory´s distribuye en toda Andalucía una amplia gama de productos de Pastelería, Granel tradicional, Granel envuelto, Aperitivos y Productos integral sin azúcar.">
    <meta name="keywords" content="florys, respoteria, baena, dulces">
    <meta name="Author" content="gabinetetic.com">
    <meta name="copyright" content="gabinetetic.com">
    <meta name="Robots" content="all">
    <meta name="Distribution" content="Global">
    <meta name="Revisit-After" content="30 days">
    <meta name="Rating" content="General">
    <title>Redes y Componentes | Puente Genil (Córdoba)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Coderthemes" name="author" />

    <!-- ajax cart update qty -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset(config('app.favicon')) }}">



    <!-- Datatables css -->
    <link href="{{asset('vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"
        type="text/css" />
    <link href="{{asset('vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet"
        type="text/css" />
    <link href="{{asset('vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet"
        type="text/css" />
    <link href="{{asset('vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css')}}" rel="stylesheet"
        type="text/css" />

    <!-- Theme Config Js -->
    <script src="{{asset('js/hyper-config.js')}}"></script>

    <!-- App css -->
    <link href="{{asset('css/app-saas.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Iconos -->
    <link href="{{asset('css/icons.css') }}" rel="stylesheet" type="text/css" />
    <!-- Css personalizado -->
    <link href="{{asset('build/assets/app-7f9c8fa3.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{asset('css/css.css') }}" rel="stylesheet" type="text/css" />

    <!-- vite(['resources/sass/app.scss']) -->
    @stack('header')
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">

        @include('layouts.navbar')
        <div class="fotobackground">
            <div class="content-page @if(!auth::user()) ms-0 @endif">
                <x-success-alert />
                <x-error-alert />
                @yield('content')

            </div>
            <!-- content -->

            <!-- Footer Start -->
            @include('layouts.footer')
            <!-- end Footer -->

        </div>

    </div>
    <!-- Vendor js -->
    <script src="{{asset('js/vendor.min.js')}}"></script>

    <!-- Fullcalendar js -->
    <script src="{{asset('vendor/fullcalendar/main.min.js')}}"></script>
    <!-- Daterangepicker js -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- daterangepicker
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> -->

    <!-- Datatables js -->
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>

    <!-- new -->

    <!-- Charts js -->
    <script src="{{ asset('vendor/chart.js/chart.min.js ')}}"></script>
    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js ')}}"></script>
    <!-- Vector Map js -->
    <script src="{{ asset('vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
    </script>



    <!-- /// scripts a los que se le llama en diferentes paginas con stack (se encuentran en cada blade especifico) /// -->

    @stack('scripts')
    <!-- Analytics Dashboard App js -->
    <!-- cart -->
    <script src="{{ asset('js/Ajax/cart.js') }}"></script>
    <!-- historico -->
    <script src="{{ asset('js/scrollPositionSaver.js') }}"></script>
    <!-- continuar comprando y modal zoom de article details-->
    <!-- checkbox ordenacion de productos -->
    <!-- documentos (ajax) -->
    <!-- favoritos (ajax) -->

    <!-- /////////////////// /////////////////// -->
    <!-- App js -->
    <script src="{{ asset('js/app.min.js') }}"></script>

</body>

</html>