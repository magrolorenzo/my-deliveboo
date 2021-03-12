<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title', 'DeliveBoo')</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;500;600;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- FontAwesome CDN -->
    <script src="https://kit.fontawesome.com/43febffcb7.js" crossorigin="anonymous"></script>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>

    <!-- header (logo && nav bar) -->
    @include('partials.guest.header')

    <main id="guest-main">
        <div id="loader-wrapper">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        @yield('content')
    </main>

    <!-- footer -->
    @include('partials.guest.footer')
    
    @yield('script')

    <script type="text/javascript" async>
        window.addEventListener("load", function(event) {
            console.log("Tutte le risorse hanno terminato il caricamento!");
            // document.getElementsByTagName('body').classList.add("loaded");
            document.getElementById('guest-main').classList.add("loaded");
        });
    </script>

</body>

</html>
