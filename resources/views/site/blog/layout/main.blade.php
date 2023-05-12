<!DOCTYPE html>
<html>
    <head>
        <title>{$common.title_of_page}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

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

        <link rel="stylesheet" href="{{ 'front/css/fontawesome-all.min.css' }}">
        <link rel="stylesheet" href="{{ 'front/css/main.css' }}">
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
                    <section id="banner">
                        @yield('banner_content')
                    </section>

                    @yield('banner')
                </div>
            </div>
            @include('site.blog.side')
        </div>

        <script src="{{  asset('front/js/util.js') }}"></script>
        <script src="{{  asset('front/js/main.js') }}"></script>
        <script>
            $('.tags').on('click', 'span', function (e) {
                if (!e.target.dataset.tag) return 1;
                console.log(e.target);
                ic.defaults.ajaxUrl = '/site/ajax';
                ic.happyAjax(
                    { op: 'tag', tag: e.target.dataset },
                    function (res) {
                        if (res.hasOwnProperty('status') && res.status == 1) {
                            window.location.reload(false);
                        }

                    }
                );
            });

            function fnLogout() {
                ic.defaults.ajaxUrl = '/site/ajax';
                ic.defaults.async = false;
                ic.happyAjax({ op: 'logout' },
                    function (res) {
                        if (res.hasOwnProperty('status') && res.status == 1) {
                            window.location.reload(false);
                        } else {
                            console.log('Error: ', res);
                        }
                    },
                    function (res) {
                        console.log('Response error: ', res);
                    }
                );
            }
        </script>
        @yield('footerJS')
    </body>
</html>
