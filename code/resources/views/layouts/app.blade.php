<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login to ProTech IT Zone</title>


    @yield('registercss')
    @yield('logincss')

</head>
<body>
    <div id="app">

        <main class="">
            @yield('content')
        </main>
    </div>


    @yield('registerjs')
    @yield('loginjs')
</body>
</html>
