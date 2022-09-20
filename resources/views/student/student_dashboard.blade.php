@extends('main')

@section('css-style')
    #courseRow{
        width: 50%;
        height:50;
        margin: auto;
    }
    .card-body{
        background-color: orange;
        border-radius: 10px;
    }
    h3{
        color: black;
    }
@stop

@section('main-content')
    @if(!empty($courseCollection))
    <div class="row row-cols-1 row-cols-md-3 g-1" id="courseRow">
        @foreach($courseCollection as $course)
        <button type="submit"><a href="{{route('student.student_coursecontent', $course['course_id'])}}">
        <div class="card-body" style="color: black;">
            <h3 class="card-title">{{$course['course_title']}}</h3>
            <p class="card-text">{{$course['course_description']}}</p>
        </div>
        </a>
        </button>
    @endforeach
    </div>
    @else
        <h1> Courses Unavailable.</h1>
    @endif
@stop