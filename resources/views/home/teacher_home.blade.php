@extends('main')
@extends('dashboard/courses/createCourse_modal')
@section('main-content')
    @include('navbar.navbar_inside')
    @include('dashboard.courses.create_course')
    Announcements from Deped....

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