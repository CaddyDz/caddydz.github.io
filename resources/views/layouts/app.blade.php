<!DOCTYPE html>
<!--[if IE 8]>     <html class="no-js ie ie8 lte9 lte8"> <![endif]-->
<!--[if IE 9]>     <html class="no-js ie ie9 lte9"> <![endif]-->
<!--[if gt IE 9]>  <html class="no-js"> <![endif]-->
<!--[if !IE]><!-->
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--<![endif]-->

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
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    @else
        {{-- Include fonts installed via npm --}}
        <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" >
    @endenv

    <!-- Styles -->
    <link href="{{ secure_asset('assets/styles/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" class="color-switcher" href="assets/styles/css/app.css">

    <!-- Theme Options -->
    <link rel="stylesheet" href="assets/styles/css/theme-options.css">

    @env('production')
        <!-- Modernizr -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js" integrity="sha256-zyXsGPIj9MUc4RKKQuZEzcIkTYj4nRpRRA2dvlH07+g=" crossorigin="anonymous"></script>
    @else
        {{-- Include Modernizr from npm --}}
    @endenv
</head>

<body class="index parallax-bg">
    <div id="app">
        <div id="site-content">
            @include('layouts.navigation')
            @yield('content')
            @include('layouts.footer')
        </div>
        <!-- TOOLS/UTILITIES -->
        <!-- Loading Spinner -->
        <div class="loading-wrapper active">
            <div class="spinner"></div>
        </div>
    
        <!-- Fixed header -->
        <div class="fixed-header-container" id="fixed-header"></div>
    
        <!-- Control Panel Nav Trigger -->
        <div class="icon-lrg nav-trigger cp-trigger" id="cp-trigger">
            <i class="fa fa-bars"></i>
        </div>
            
        <!-- Flyout Nav Trigger -->
        <span class="icon-lrg nav-trigger flyout-trigger" id="flyout-trigger">
            <i class="fa fa-bars"></i>
        </span>

        <!-- Control Panel Nav -->
        <nav class="cp-nav-container" id="cp-nav"></nav>

        <!-- Flyout Nav -->
        <nav class="flyout-nav-container" id="flyout-nav"></nav>

        <!-- Scroll-to-top Icon-->
        <a class="icon-lrg-border scroll-top" href="#site-content">
            <i class="fa fa-angle-up"></i>
        </a>

        <!-- Main Search -->
        <search-component></search-component>
            
        <!-- Site Overlay -->
        <div class="site-overlay invisible" id="site-overlay"></div>
    
        {{-- Theme Options --}}
        <div class="theme-options">
            <i class="fa fa-cog options-trigger hover-bg-brand-1 brand-1-active"></i>
            <div class="options-content">
                <h3>@lang('View Options')</h3>
                {{-- <div class="row bp0 page-type">
                    <div class="span-6">
                        <a href="{{ route('home') }}" class="button brand-1-active round full-width">
                            @lang('All in one')
                        </a>
                    </div>
                    <div class="span-6">
                        <a href="{{ route('index') }}" class="button round brand-1-active full-width active">
                            @lang('Multi-Page')
                        </a>
                    </div>
                </div> --}}
                <section class="theme-option">
                    <h4>@lang('Fixed Header')</h4>
                    <p>@lang('Toggle to enable the fixed header').</p>
                    <div class="input-toggle">
                        <input type="checkbox" id="fixed-header-toggle" name="fixed-header-toggle" />
                        <label for="fixed-header-toggle"></label>
                    </div>
                </section>
                <section class="theme-option">
                    <h4>@lang('HTML Logo')</h4>
                    <p>@lang('Toggle to enable HTML logo instead of image').</p>
                    <div class="input-toggle">
                        <input type="checkbox" id="html-logo" name="html-logo" checked />
                        <label for="html-logo"></label>
                    </div>
                </section>
                {{-- <section class="theme-option">
                    <h4 class="hidden">@lang('Theme Colors')</h4>
                    <div class="theme-colors">
                        <a href="assets/styles/css/app.css" class="theme-color"></a>
                        <a href="assets/styles/css/app-green.css" class="theme-color"></a>
                        <a href="assets/styles/css/app-pink.css" class="theme-color"></a>
                        <a href="assets/styles/css/app-red.css" class="theme-color"></a>
                        <a href="assets/styles/css/app-grey.css" class="theme-color"></a>
                    </div>
                </section> --}}
            </div>
        </div>
    </div>
    

    <!-- SCRIPTS -->
    <script src="{{ mix('js/app.js') }}"></script>
    @env('production')
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <!-- Raphael for livicons -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js" integrity="sha256-Gk+dzc4kV2rqAZMkyy3gcfW6Xd66BhGYjVWa/FjPu+s=" crossorigin="anonymous"></script>
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
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9kOt-o-2NU7_pcjkGIj4f8cKPw_xinco"></script>
        <script src="assets/js/google-map.js"></script>
    @endenv
</body>

</html>
