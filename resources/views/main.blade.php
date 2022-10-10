<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Turo</title>
    <link rel = "icon" href = 
        "{{ asset('images/logo.png') }}" 
        type = "image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link href ="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="{!! url('assets/tinymce/js/tinymce.min.js') !!}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @yield('import-scripts')
    
    <script>

        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
        @yield('script-area')
        
    </script>
    <style>
        @yield('css-style');
        *{
            font-family: 'Montserrat';
        }
    </style>
</head>
    
<body>
    @include('navbar.navbar')
    @guest
        @yield('guest-content')
        @yield('main-content')
        <!-- <div class="floating-container">
                <div class="floating-button">?</div>
                <div class="element-container">
                    <a href="google.com"> 
                        <span class="float-element tooltip-left">
                        <i class="material-icons">phone
                        </i>
                        </span>
                    </a>

                    <a href="www.gmail.com">
                        <span class="float-element">
                            <i class="material-icons">email
                            </i>
                        </span>
                    </a>    
                    <a href="www.messenger.com">
                        <span class="float-element">
                            <i class="material-icons">chat</i>
                        </span>
                    </a>
                    
                </div>
            </div> -->
    @endguest

    @auth
        @yield('main-content')
        
    @endauth
        
    
</body>
</html>