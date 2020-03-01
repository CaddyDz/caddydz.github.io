<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.85">
    <meta name="description" content="">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <!-- Icons & favicons -->
    <link rel="apple-touch-icon" href="{{ secure_asset('img/apple-icon-touch.png') }}">
    <link rel="icon" href="{{ secure_asset('/img/logo.jpg') }}">
    <!--[if IE]>
        <link rel="shortcut icon" href="/img/logo.jpg">
    <![endif]-->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Caddy') }}</title>

    <!-- Fonts -->
    @env('production')
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,800" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css">
    @else
    {{-- Include fonts installed via npm --}}
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet">
    @endenv
    <!-- SCRIPTS -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ secure_asset('assets/styles/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" class="color-switcher" href="assets/styles/css/app.css">

    <!-- Theme Options -->
    <link rel="stylesheet" href="assets/styles/css/theme-options.css">

    @env('production')
    <!-- Modernizr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"
        integrity="sha256-zyXsGPIj9MUc4RKKQuZEzcIkTYj4nRpRRA2dvlH07+g=" crossorigin="anonymous"></script>
    @else
    {{-- Include Modernizr from npm --}}
    @endenv
</head>

<body class="index parallax-bg">
    <div id="app">
        <div id="site-content">
            <navigation-component id-prop="app-header"></navigation-component>
            @yield('content')
            @include('layouts.footer')
        </div>
        <!-- TOOLS/UTILITIES -->
        <!-- Loading Spinner -->
        <loading-spinner-component></loading-spinner-component>

        <!-- Fixed header -->
        <div class="fixed-header-container" id="fixed-header">
            <navigation-component id-prop=""></navigation-component>
        </div>

        <!-- Control Panel Nav Trigger -->
        <control-panel-nav-trigger-component></control-panel-nav-trigger-component>

        <!-- Sidebar Nav Trigger -->
        <sidebar-trigger-component></sidebar-trigger-component>

        <!-- Control Panel Nav -->
        <nav class="cp-nav-container" id="cp-nav">
            <search-component></search-component>
        </nav>

        <!-- Flyout Nav -->
        {{-- Only for mobile devices --}}
        <nav class="flyout-nav-container" id="flyout-nav"></nav>

        <!-- Scroll-to-top Icon-->
        <scroll-top-component></scroll-top-component>

        <!-- Main Search -->
        <search-component></search-component>

        <!-- Site Overlay -->
        <div class="site-overlay invisible" id="site-overlay"></div>

        <theme-component></theme-component>
    </div>

    @env('production')
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Raphael for livicons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"
        integrity="sha256-Gk+dzc4kV2rqAZMkyy3gcfW6Xd66BhGYjVWa/FjPu+s=" crossorigin="anonymous"></script>
    @endenv

    <!-- LivIcons -->
    <script src="assets/js/livicons-custom.min.js"></script>

    <!--Plugins -->
    <script src="assets/js/owl-carousel.min.js"></script>
    <script src="assets/js/magnific-popup.min.js"></script>
    <!-- Theme Options -->
    <!-- Cookie (for theme color-switcher) -->
    <script src="assets/js/cookie.js"></script>
    <!--[if IE 9]>     <script>$('.theme-options').hide();</script> <![endif]-->
    <!--[if gt IE 9]>  <script src="assets/js/theme-options.js"></script> <![endif]-->
    <!--[if !IE]><!-->
    <script src="assets/js/theme-options.js"></script>
    <!--<![endif]-->

    <!-- General -->
    <script src="assets/js/app.js"></script>
    <script src="assets/js/homepage.js"></script>
    <script src="assets/js/earth-slider.js"></script>

    @env('production')
    <!-- Google Map -->
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9kOt-o-2NU7_pcjkGIj4f8cKPw_xinco"></script>
    <script src="assets/js/google-map.js"></script>
    @endenv
</body>

</html>
