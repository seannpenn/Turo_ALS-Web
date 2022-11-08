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
    <link rel="stylesheet" href="{{ asset('js/bootstrap.js') }}">
    <link href ="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
    <!-- <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->

    <!-- temporary -->
    <!-- <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script> -->

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script> -->
    @yield('import-scripts')
    
    <script>

        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );

        
    </script>
    <style>
        @yield('css-style')
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