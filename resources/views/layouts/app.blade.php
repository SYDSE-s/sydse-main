<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PUS') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div id="app">

        <main class="container-lg container-content mt-3 mb-5 mb-sm-0 mt-sm-0">
            @yield('content')
        </main>

        <footer class="footer fixed-bottom">
            <div class="fs-6">Code crafted by Ahmad Kamaludin</div>
        </footer>
    </div>

    @yield('script')
</body>

</html>
