<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- site config meta-->
        @foreach ($site_config as $config)
            @if($config->config_name == 'Site_Name') 
                <title>{{ $pageTitle .' - '. $config->config_value }}</title>
                <meta property="og:site_name" content="{{ $config->config_value }}" /> <!-- website name -->
            @endif
            @if($config->config_name == 'Site_Meta_Description') 
                <meta name="description" content="{{ $config->config_value }}">
            @endif
            @if($config->config_name == 'Site_Meta_Keywords') 
                <meta name="keywords" content="{{ $config->config_value }}">
            @endif
            @if($config->config_name == 'Site_Meta') 
                {!! $config->config_value !!}
            @endif 
            @if($config->config_name == 'Site_Custom_Style') 
                {!! $config->config_value !!}
            @endif 
        @endforeach

        <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
        <meta property="og:site" content="https://www.naturethrive.in" /> <!-- website link -->
        <meta property="og:title" content="@yield('og_title', '')"/> <!-- title shown in the actual shared post -->
        <meta property="og:description" content="@yield('og_description', '')" /> <!-- description shown in the actual shared post -->
        <meta property="og:image" content="@yield('og_image', '')" /> <!-- image link, make sure it's jpg -->
        <meta property="og:url" content="@yield('og_url', '')" /> <!-- where do you want your post to link to -->
        <meta property="og:type" content="website">
        
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <!-- Favicons -->
        <link href="{{ asset('site_asset/img/favicon.png') }}" rel="icon">
        <link href="{{ asset('site_asset/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ asset('site_asset/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('site_asset/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('site_asset/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('site_asset/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('site_asset/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

        <!-- Main CSS File -->
        <link href="{{ asset('site_asset/css/main.css') }}" rel="stylesheet">
        @stack('styles')  {{-- This will include styles when pushed --}}
        <!-- =======================================================
        * Template Name: eNno
        * Template URL: https://bootstrapmade.com/enno-free-simple-bootstrap-template/
        * Updated: Aug 07 2024 with Bootstrap v5.3.3
        * Author: BootstrapMade.com
        * License: https://bootstrapmade.com/license/
        ======================================================== -->
    </head>

    <body class="sarter-page-page" data-baseurl="{{ url('/') }}" data-contacturl="{{ route('contact.save') }}">
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="site_asset/img/logo.png" alt=""> -->
            <h1 class="sitename">MyDspace</h1>
        </a>

        @include('layouts.mainmenu')

        </div>
    </header>

    <main class="main">
        {{ $slot }}
    </main>

    <footer id="footer" class="footer">
        {{ $footer ?? '' }}
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- jQuery -->
    <script src="{{ asset('site_asset/vendor/jquery/jquery.min.js') }}"></script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('site_asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('site_asset/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('site_asset/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('site_asset/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('site_asset/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('site_asset/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('site_asset/vendor/swiper/swiper-bundle.min.js') }}"></script>

    
    @foreach ($site_config as $config)
        @if($config->config_name == 'Site_Custom_Scripts' && $config->config_value != '') 
            <!-- Site Custom Scripts -->
            {!! $config->config_value !!}
        @endif 
    @endforeach
    
    <!-- Main JS File -->
    <script src="{{ asset('site_asset/js/main.js') }}" ></script>
    @stack('scripts') {{-- This will include scripts when pushed --}}


    </body>
</html>
