<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- addons css --}}
    <link rel="stylesheet" href="{{ asset('css/part/component.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/part/var.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    @yield('css')
</head>

<body>
    @yield('navbar')
    <div id="app">
        <main class="container-content">
            @yield('content')
        </main>
    </div>
    @yield('footer')
    @yield('script')

</body>

</html>
