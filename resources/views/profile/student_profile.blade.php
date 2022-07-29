@extends('main')

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
        This is student profile page.
    </div>

@stop