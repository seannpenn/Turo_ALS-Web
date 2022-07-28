<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src= "{{ asset('js/bootstrap.js') }}" ></script>
    @yield('import-scripts')
    <script>
        @yield('script-area')
    </script>
    <style>
        @yield('css-style');
    </style>
</head>
    
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