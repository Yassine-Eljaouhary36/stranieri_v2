<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Consua - Consulting Business Template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ========== Page Title ========== -->
    <title>Consua - Consulting Business Template</title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{asset('/img/favicon.png')}}" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('css/elegant-icons.css')}}" rel="stylesheet">
    <link href="{{asset('css/flaticon-set.css')}}" rel="stylesheet">
    <link href="{{asset('css/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{asset('css/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/validnavs.css')}}" rel="stylesheet">
    <link href="{{asset('css/helper.css')}}" rel="stylesheet">
    <link href="{{asset('css/unit-test.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    @stack('styles')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    {{-- <script src="https://kit.fontawesome.com/ab2018bbfb.js" crossorigin="anonymous"></script> --}}
    <!-- ========== End Stylesheet ========== -->

</head>

<body>

    @include('layouts.preloader')
    @include('layouts.top-bar')
    @include('layouts.navbar')

        @yield('content')

    <x-partials.alert />
    @include('layouts.footer')
    <!-- jQuery Frameworks
    ============================================= -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/jquery.appear.js')}}"></script>
    <script src="{{asset('js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('js/modernizr.custom.13711.js')}}"></script>
    <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('js/wow.min.js')}}"></script>
    <script src="{{asset('js/progress-bar.min.js')}}"></script>
    <script src="{{asset('js/circle-progress.js')}}"></script>
    <script src="{{asset('js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('js/count-to.js')}}"></script>
    <script src="{{asset('js/jquery.scrolla.min.js')}}"></script>
    <script src="{{asset('js/YTPlayer.min.js')}}"></script>
    <script src="{{asset('js/TweenMax.min.js')}}"></script>
    <script src="{{asset('js/rangeSlider.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/validnavs.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    @stack('scripts')
</body>
</html>