@extends('main')
<!--//for outer navbar//-->
@section('right-side-nav')
    <a class="nav-link" style="color: black;" href="{{route('user.logout')}}">{{Auth::user()->username}}</a>
     <a class="nav-link" style="color: black;" href="{{route('user.logout')}}">Logout</a>
@stop

@section('left-side-nav')
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('student.home')}}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('student.profile')}}">Profile</a>
    </li>
@stop



@section('main-content')
    
    
    <div class="layout">
        <div class="message">
            <h2>Your enrollment is pending for approval.</h2>
            {{Auth::user()->username}}
            <h4>Please wait for a confimation.</h4>
            <img src="{{ asset('images/loading.gif') }}" alt="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        </div>
    </div>
    

@stop

@section('css-style')
    .layout{
        
        border: 1 solid;
        height:94vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .message{
        text-align:center;
    }
    h2{
    }
@stop