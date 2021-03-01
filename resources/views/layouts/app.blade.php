<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('page-title', 'DeliveBoo')</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- FontAwesome CDN -->
        <script src="https://kit.fontawesome.com/43febffcb7.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <!-- header (logo && nav bar) -->
        @include('partials.guest.header')

        <main class="py-4">
            @yield('content')
        </main>

        @include('partials.guest.footer')

        @yield('script')
    </body>

</html>
