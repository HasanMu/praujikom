<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') &mdash; Muslim Society</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/stisla220/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/stisla220/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    @yield('css')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/stisla220/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/stisla220/assets/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            @include('layouts.be.navbar')

            @include('layouts.be.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('header')</h1>
                    </div>

                    <div class="section-body">
                        @yield('content')
                    </div>
                </section>
            </div>

            @if (Request::segment(2) == 'users')
                @include('admin.users/modal')
            @endif

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2020 <div class="bullet"></div> Muslim Society
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/stisla220/assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/stisla220/assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/stisla220/assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/stisla220/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/stisla220/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/stisla220/assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/stisla220/assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    @stack('js')

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/stisla220/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/stisla220/assets/js/custom.js') }}"></script>
</body>

</html>
