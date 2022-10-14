@extends('main')

@section('css-style')
    #courseRow{
        width: 50%;
        height:50;
        margin: auto;
    }
    .card-body{
        background-color: orange;
        border-radius: 0px 0px 10px 10px;
    }
    h3{
        color: black;
    }
    .card{
        border-radius: 10px;
    }
    .announcementBox{
        background-color: #ffebd2;
        margin-left: 25%;
        margin-right: 25%;
        margin-bottom: 50px;
        text-align: center;
        height: auto;
        padding: 30px;
        border-radius: 5px;
    }
@stop

@section('main-content')
@include('navbar/navbar_inside')

    @if(!empty($courseCollection))
    <div class="announcementBox" style="margin-top: 30px;">
        Announcements here
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-1" id="courseRow">
        @foreach($courseCollection as $course)
        <a href="{{route('student.student_viewmodule', $course['course_id'])}}">
        <div class="card" style="width: 18rem;">
            <img src=".../assets/images/IMG_20220511_175528.jpg" class="card-img-top">
                <div class="card-body" style="color: black;">
                    <h3 class="card-title">{{$course['course_title']}}</h3>
                    <p class="card-text">{{$course['course_description']}}</p>
                </div>
        </div>
        @endforeach
    </div>
    @else
        <h1> Courses Unavailable.</h1>
    @endif
@stop

