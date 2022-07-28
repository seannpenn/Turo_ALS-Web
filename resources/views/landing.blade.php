@extends('main')


@section('right-side-nav')
     <a class="nav-link" style="color: black;" href="{{ route('s-login') }}">Login</a>
@stop

@section('css-style')
        .main-content {


            padding-top: 100px;
            position:absolute;
            width:100%;
            <!-- height: calc(100% - 56px); -->
            margin:  auto;
            display: flex;
            flex-direction: column;
        }

        .main-content h1{
            letter-spacing: 10px;
            width: 500px;
            margin-top:50px;
            font-family: 'Montserrat';
            font-size: 60px;
            colo
        }
        .header{
            margin: 0 auto;
            text-align:center;
        }
        .center{
            margin-top: 40px;
            
            text-align:center;
        }
        .enroll{
            height: 80px;
            width: 400px;
            background-color:orange;
            border-radius: 15px;
            border-color: orange;
        }
@stop 

@section('guest-content')
    
        <div class="main-content">

            <div class="header">
                <h1>Welcome to </h1><h2 style="font-size: 80px; color: orange;">TURO</h2>
                <p>In collaboration with DepEd</p>
            </div>
            
            <div class="center">
                <button type="submit" id="contentCreate" class="enroll"><a class="nav-link" style="color: white;" href="{{route('student.registration')}}"><b>Enroll now for free!</b></a></button>
                <br>
                <br>
                <h6>Already enrolled? <a style=" text-decoration:none; color: orange;" href="{{route('s-login')}}">Login </a>here</h6>
            </div>
        </div> 
@stop
    
    

