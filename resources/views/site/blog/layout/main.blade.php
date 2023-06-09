<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta charset="utf-8">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <script src="{{  asset('front/js/jquery.min.js') }}"></script>
        <script src="{{  asset('front/js/browser.min.js') }}"></script>
        <script src="{{  asset('front/js/breakpoints.min.js') }}"></script>
        <script src="{{  asset('front/js/tools/ic.min.js') }}"></script>
        @yield('js')

        <link rel="stylesheet" href="{{ asset('front/css/fontawesome-all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front/css/main.css') }}">
        @yield('css')
    </head>
    <body>
        <!-- Wrapper -->
        <div id="wrapper" class="wrap">
            <div id="main">
                <div id="modal-wrapper"></div>
                <div class="inner">
                    @include('site.blog.header')
                    <!-- Banner -->
                    @yield('banner_content')

                    @yield('content')
                </div>
            </div>
            @include('site.blog.side')
        </div>

        <script src="{{  asset('front/js/util.js') }}"></script>
        <script src="{{  asset('front/js/main.js') }}"></script>
        @yield('footerJS')
    </body>
</html>
