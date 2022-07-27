@extends('main')
@extends('dashboard/courses/createCourse_modal')
@extends('dashboard/courses/createCourseContent_modal')

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
    img{
        height: 30px;
        width: 30px; 
    } 
    .card:hover{
        cursor:pointer;
    }
    .course-area{
        height: 86%; 
        width:325px; 
        overflow-y: auto;  
        padding: 5px; 
    }
@stop

@section('left-side-nav-inside')
    <li class="nav-item">
        <!-- <a class="nav-link active" aria-current="page" href="{{route('users.all')}}">Create Course</a> -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">Create Course</button>
        <button type="button" class="btn btn-primary"><a class="nav-link active" aria-current="page" href="{{route('course.all')}}">View Courses</a></button>

    </li>
@stop

@section('main-content')
@include('dashboard.courses.create_course')
        <div class="course-area">
            @foreach($ownedCourses as $course)
                <div class="card" id="card" style="width: 18rem; height: 180px; margin: 5px;" class="btn btn-primary" data-bs-toggle="modal">
                    <div class="card-body">
                        <h1>{{$course['course_id']}}</h1>
                        <h5 class="card-title">{{$course['course_title']}}</h5>
                        <p class="card-text">{{$course['course_description']}}</p>
                        <td class="icons"><a href="{{route('course.showInfo', $course['course_id'])}}" title="Edit Course"><img src="{{ asset('images/edit.png') }}" alt=""></a></td>
                    </div>
                </div>
            @endforeach
        </div>
@stop

@section('script-area')

    function clickCard(){
        window.location.href = "{{route('course.showInfo', $course['course_id'])}}";
    }
    let courseCard = document.getElementById('{{$course['course_id']}}')
    courseCard.addEventListener('click',()=>{
        
    });
@stop
