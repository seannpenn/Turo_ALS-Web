@extends('main')
@extends('dashboard/courses/createCourse_modal')
<!--//for outer navbar//-->
@section('right-side-nav')
    <a class="nav-link" style="color: white;" href="{{route('user.logout')}}">{{Auth::user()->username}}</a>
     <a class="nav-link" style="color: white;" href="{{route('user.logout')}}">Logout</a>
@stop

@section('left-side-nav')
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('teacher.home')}}">Home</a>
    </li>
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
        <button type="button" class="btn btn-primary"><a class="nav-link active" aria-current="page" href="{{route('course.all')}}">View Courses</a></button>

    </li>
@stop

<!--//for inner navbar//-->

@section('main-content')
    @include('navbar.navbar_inside')
    @include('dashboard.courses.create_course')
    This is home

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