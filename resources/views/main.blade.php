<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <script src= "{{ asset('js/bootstrap.js') }}" ></script>
</head>
    <style>
        @yield('css-style');
    </style>
<body>
    @include('navbar.navbar')
    @guest
        @yield('guest-content')
    @endguest

    @auth
        @yield('main-content')
    @endauth
        
    
</body>
</html>