@extends('main')
@extends('courses/createCourse_modal')
<!--//for outer navbar//-->
@section('right-side-nav')
    <a class="nav-link" style="color: white;" href="{{route('user.logout')}}">{{Auth::user()->username}}</a>
     <a class="nav-link" style="color: white;" href="{{route('user.logout')}}">Logout</a>
@stop

@section('left-side-nav')
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('users.all')}}">Manage Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('users.all')}}">Profile</a>
    </li>
@stop

<!--//for inner navbar//-->

@section('left-side-nav-inside')
    <li class="nav-item">
        <!-- <a class="nav-link active" aria-current="page" href="{{route('users.all')}}">Create Course</a> -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">Create Course</button>
    </li>
@stop

<!--//for inner navbar//-->

@section('main-content')
    @include('navbar.navbar_inside')
    
    @include('dashboard.create_course')
    
    
@stop