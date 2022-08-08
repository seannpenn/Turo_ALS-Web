@extends('main')
<!--//for outer navbar//-->
@section('right-side-nav')
    <a class="nav-link" style="color: black;" href="{{route('user.logout')}}">{{Auth::user()->username}}</a>
     <a class="nav-link" style="color: black;" href="{{route('user.logout')}}">Logout</a>
@stop



@section('main-content')
    
    
    <div class="layout">
        
        <div class="message">
            @if(Auth::user()->student->status != 'approved')
                <h2>Your enrollment is pending for approval.</h2>
                
                <h4>Please wait for a confimation.</h4>
                <img src="{{ asset('images/loading.gif') }}" alt="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            @else
                <h1>Your enrollment application is approved.</h1>
                <h4>Your Learning Reference number(LRN) is {{Auth::user()->student->LRN}}</h4>
                <p>Install the mobile application to access your courses.</p>
                <p>Enter your login credentials and enjoy learning.</p>
            @endif
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