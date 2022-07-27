@extends('main')
<!--//for outer navbar//-->
@section('right-side-nav')
    <a class="nav-link" style="color: white;" href="{{route('user.logout')}}">{{Auth::user()->username}}</a>
     <a class="nav-link" style="color: white;" href="{{route('user.logout')}}">Logout</a>
@stop

@section('left-side-nav')
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('users.all')}}">Profile</a>
    </li>
@stop



@section('main-content')
    
    This is home for students
    <h1>Your LRN is 123. Input this in your mobile application to view your courses</h1>

@stop

@section('css-style')
    .layout{
        display: flex;
        flex-grow: 1;
        flex-direction: row;
    }
    .course-content-area{
        display: flex;
        flex-grow: 1;
        flex-direction: column;
    }
@stop