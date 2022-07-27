@extends('main')

@extends('dashboard/courses/createCourse_modal')
@extends('modalslug')

@section('modal-content')
    <span id="modalContent"> Deleting this course would also remove all of its contents. Are you sure you want to proceed?</span>
@stop

@section('modal-title')
    Delete Course
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
    .action{
        position: absolute;
    bottom: 0px;
    right: 0px;
    }
    .action-delete{
        position: absolute;
    bottom: 0px;
    right: 30px;
    }
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

@section('right-side-nav')
    <a class="nav-link" style="color: white;" href="{{route('user.logout')}}">{{Auth::user()->username}}</a>
     <a class="nav-link" style="color: white;" href="{{route('user.logout')}}">Logout</a>
@stop

@section('left-side-nav-inside')
    <li class="nav-item">
        <!-- <a class="nav-link active" aria-current="page" href="{{route('users.all')}}">Create Course</a> -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">Create Course</button>
        <button type="button" class="btn btn-primary"><a class="nav-link active" aria-current="page" href="{{route('course.all')}}">View Courses</a></button>
        <button type="button" class="btn btn-primary"><a class="nav-link active" aria-current="page" href="">Student's list</a></button>

    </li>
@stop

@section('main-content')
@include('dashboard.courses.create_course')
@include('navbar/navbar_inside')
        <div class="course-area">
            @if(count($ownedCourses) != 0)
            @foreach($ownedCourses as $course)
                <div class="card" id="card" style="width: 18rem; height: 180px; margin: 5px;" class="btn btn-primary" data-bs-toggle="modal">
                    <div class="card-body" style="display: flex;">
                        <div class="card-content">
                            <!-- <h1>{{$course['course_id']}}</h1> -->
                            <h5 class="card-title">{{$course['course_title']}}</h5>
                            <p class="card-text">{{$course['course_description']}}</p>
                        </div>
                        
                        <div class="action">
                            <td class="icons"><a href="{{route('course.showInfo', $course['course_id'])}}" title="View Course"><img src="{{ asset('images/add.png') }}" alt=""></a></td>
                        </div>
                        <div class="action-delete" style="margin:2px;">
                            <td class="icons"><a title="Delete Course"><img src="{{ asset('images/delete.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></a></td>

                            <!-- <td class="icons"><a href="{{ route('course.delete',$course['course_id']) }}" title="Delete Module"><img src="{{ asset('images/delete.png') }}" alt=""></a></td> -->
                        </div>
                    </div>
                </div>

                @section('script-area')
                    let confirmTask = document.getElementById('confirmTask');
                    confirmTask.addEventListener('click',()=>{
                        window.location.href = "{{ route('course.delete', $course['course_id']) }}";
                    }); 
                @stop

            @endforeach
            
            @else
                <h1>You dont have any courses posted.</h1>
            @endif
        </div>

@stop


