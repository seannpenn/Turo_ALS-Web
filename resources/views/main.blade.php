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
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>

    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
      integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
      crossorigin="anonymous"
    ></script>

    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>

    
    <link href ="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    
    {{-- <script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script> --}}
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script> --}}

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

    <!-- temporary -->
    {{-- <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    @yield('import-scripts')
    
    
    
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

    <script>
        let editor;
            ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( newEditor => {
                editor = newEditor;
            } )
            .catch( error => {
                console.error( error );
            } );
        $(document).ready(function(){
             @yield('content-style') 
        
            $(window).on('load', 
                // getAllQuizzes()
                // surprise(),
                // validateAssignment()
            );

            function surprise() {
                (function loop() {
                    var now = new Date();
                        // console.log(now.getHours());
                        // console.log(now.getMinutes());
                    // if (now.getHours() === 15 && now.getMinutes() === 35) {
                    //     alert('Quiz is Closed');
                    // }
                    $.ajax({
                        type: "get",
                        url: "{{route('quiz.getAll')}}",
                        dataType: "json",
                        success: function (response) {

                            var now = new Date();
                            for(x in response){
                                var date = new Date(response[x].end_date);
                                var time = "15:30:00";
                                var trimTime = time.split(":");
                                
                                // console.log(date.getMonth());
                                // console.log(date.getDay());
                                // console.log(trimTime[0]);

                                if (date.getMonth() === 10 && date.getDay() === 6) {
                                    if(trimTime[0] === "15" && trimTime[1] === "30"){
                                        console.log("Quiz is now closed"); // execute inactive quiz function
                                    }
                                }
                            }
                        },
                        error: function(response){
                            console.log(response);
                        }
                    });
                    now = new Date();                  // allow for time passing
                    var delay = 60000 - (now % 60000); // exact ms to next minute interval
                    setTimeout(loop, delay);
                })();
            }
            function validateAssignment() {
                (function loop() {
                    var now = new Date();
                        // console.log(now.getHours());
                        // console.log(now.getMinutes());
                    // if (now.getHours() === 15 && now.getMinutes() === 35) {
                    //     alert('Quiz is Closed');
                    // }
                    $.ajax({
                            type: "get",
                            url: "{{route('assignment.getAll')}}",
                            dataType: "json",
                        success: function (response) {
                            console.log(response)
                            var now = new Date();
                            for(x in response){
                                console.log(response[x]);
                                var date = new Date(response[x].end_date);
                                var time = "15:30:00";
                                var trimTime = time.split(":");

                                if (date.getMonth() === 10 && date.getDay() === 6) {
                                    if(trimTime[0] === "15" && trimTime[1] === "30"){
                                        console.log("Assignment is now closed"); // execute inactive quiz function
                                    }
                                }
                            }
                        },
                        error: function(response){
                            console.log(response);
                        }
                    }, 1000);
                    now = new Date();                  // allow for time passing
                    var delay = 60000 - (now % 60000); // exact ms to next minute interval
                    setTimeout(loop, 1000);
                })();
            }
        });
    </script>
</html>