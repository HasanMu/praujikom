<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="codepixer">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.jss/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
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
    <script>
        var $no = 0;
        setInterval(() => {
            var ifConnected = window.navigator.onLine;
            if (ifConnected) {
                // $no = 0;
                if($no > 0) {
                    // console.log('Connection available');
                    iziToast.success({
                        transitionIn: 'flipInX',
                        transitionOut: 'bounceInDown',
                        transitionInMobile: 'flipInX',
                        transitionOutMobile: 'bounceInDown',
                        title: 'Bagus!',
                        message: 'Kamu terhubung kembali!',
                        position: 'bottomLeft'
                    });
                    $no = 0
                } else {
                    $no = 0;
                }

            } else {
                // console.log('Connection not available');
                // console.log($no);

                if ($no === 0) {
                    iziToast.error({
                        timeout: 4000,
                        transitionIn: 'fadeInRight',
                        transitionOut: 'fadeInDown',
                        transitionInMobile: 'fadeInRight',
                        transitionOutMobile: 'bounceInDown',
                        title: 'Ups! ',
                        message: 'Koneksi internetmu hilang!',
                        position: 'bottomLeft'
                    });
                    setTimeout(() => {
                        iziToast.warning({
                            timeout: 4500,
                            title: 'Tunggu,',
                            message: 'Menyambungkan kembali!',
                            position: 'bottomLeft'
                        });
                    }, 3500);
                    $no += 1;
                    // console.log($no+" ==");
                } else {
                    $no += 1;
                    if ($no >= 10) {
                        $no = 0
                    }
                }
                // console.log($no);
            }
        }, 3000);

    </script>
    @stack('js')
</body>

</html>
