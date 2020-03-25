<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Author Meta -->
    <meta name="author" content="Muslim Society">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
        CSS
        ============================================= -->
    <link href="{{ asset('assets/fe/robotics/js/select2-4.0.13/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/fe/robotics/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/robotics/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/robotics/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/robotics/assets/css/template.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/fe/robotics/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/robotics/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/robotics/css/hexagons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/robotics/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/robotics/css/owl.carousel.css') }}">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/stisla220/assets/modules/izitoast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fe/robotics/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/stisla220/assets/modules/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziModal.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/zoom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-fe.css') }}">

</head>

<body>
    <div id="app">
        @yield('navbar')

        @yield('content')

        <!-- start footer Area -->
        @include('layouts.fe.footer')
        <!-- End footer Area -->
    </div>

    <script src="{{ asset('assets/fe/robotics/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
    <script src="{{ asset('assets/fe/robotics/js/vendor/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
    <script src="{{ asset('assets/fe/robotics/js/easing.min.js') }}"></script>
    <script src="{{ asset('assets/fe/robotics/js/hoverIntent.js') }}"></script>
    <script src="{{ asset('assets/fe/robotics/js/superfish.min.js') }}"></script>
    <script src="{{ asset('assets/fe/robotics/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/fe/robotics/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/fe/robotics/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/fe/robotics/js/hexagons.min.js') }}"></script>
    <script src="{{ asset('assets/fe/robotics/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/fe/robotics/js/jquery.counterup.min.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('assets/stisla220/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>
    <script src="{{ asset('assets/fe/robotics/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/fe/robotics/js/mail-script.js') }}"></script>
    <script src="{{ asset('assets/fe/robotics/js/main.js') }}"></script>
    <script src="{{ asset('assets/fe/robotics/js/select2-4.0.13/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/iziModal.min.js') }}"></script>
    <script src="{{ asset('js/checkConnection.js') }}"></script>
    @stack('js')
</body>

</html>
