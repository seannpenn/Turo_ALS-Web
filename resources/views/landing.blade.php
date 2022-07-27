@extends('main')


@section('right-side-nav')
     <a class="nav-link" style="color: white;" href="{{ route('s-login') }}">Login</a>
@stop

@section('css-style')
    
        .main-content {
            margin: 0 auto;
            width: 500px;
            height: 300px;
            border: 1 solid;
            text-align:center;
        }
        h2{
            text-align:center;
        }
        button{
            text-align:center;
        }
        label {
            display: inline-block;
            width: 200px;
        }
        input {
            margin-bottom: 10px;
            font-size: 1.5rem;
        }
        select {
            width: 200px;
            text-overflow: ellipsis;
            margin-bottom: 10px;
        }
@stop 

@section('guest-content')
    
        <section class="main-content">
                <h2>Welcome to Turo!!!</h2> 
                <br>
                <button type="submit" id="contentCreate" class="btn btn-primary"><a class="nav-link" style="color: white;" href="{{route('student.registration')}}">Enroll now for free!</a></button>

                <br>
                Already enrolled? <a class="nav-link"  href="{{route('s-login')}}">Login</a>here

        </section>
        

@stop
    
    

