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
        justify-content:center;
        height: auto; 
        display: grid;
        grid-template-columns: 300px 300px 300px 300px 300px 300px;
        gap: 10px;
        <!-- background-color: #2196F3; -->
        padding: 20px; 
        
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
    .header{
        margin: 30 auto;
        width: 500px;
        border: 1 solid;
    }
    .empty-course{
        justify-content:center;
        margin: 300 auto;
        width: 700px;
        border: 1 solid;
    }
    .upper-left-header{
        margin: 20px;
        
    }
    nav{
        box-shadow: 0px 0px 0px 0px;
    }
    .create-button{
        width: 150px;
        line-height:50px;
        background-color:orange;
        color: white;
        border: 0;
        border-radius: 10px;
        
    }
    .create-button:hover{
        background-color:orange;
        color: white;
        border: 0;
        border-radius: 10px;
        font-size: 18px;
        
    }
@stop

@section('left-side-nav')
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('teacher.home')}}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('students.all')}}">Manage Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="">Profile</a>
    </li>
@stop

@section('right-side-nav')
    <a class="nav-link" style="color: black;" href="{{route('user.logout')}}">{{Auth::user()->username}}</a>
     <a class="nav-link" style="color: black;" href="{{route('user.logout')}}">Logout</a>
@stop

@section('main-content')
@include('dashboard.courses.create_course')
@include('navbar/navbar_inside')

        @if(session('message'))
            <div class="altert alert-success">{{ session('message') }}</div>
        @endif

    <div class="upper-left-header">
        <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">Create Course</button>
    </div>
    @if(count($ownedCourses) != 0)
        <div class="course-area">
            @foreach($ownedCourses as $course)
                    <div class="card" id="card" style="width: 300px; height: 200;" class="btn btn-primary" data-bs-toggle="modal">
                        <div class="card-body">
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
             
        </div>
    @else
        <div class="empty-course">
            <h1>You dont have any courses posted.</h1>
        </div>
    @endif

@stop

@section('script-area')

    function displayCourses(answer){
        console.log(answer.value)

        if(answer.value == 'text'){
            document.getElementById('text').classList.remove('d-none');
            document.getElementById('file').classList.add('d-none');
            document.getElementById('media').classList.add('d-none');
        }
        else if(answer.value == 'file'){
            document.getElementById('file').classList.remove('d-none');
            document.getElementById('text').classList.add('d-none');
            document.getElementById('media').classList.add('d-none');
        }
        else if(answer.value == 'media'){
            document.getElementById('media').classList.remove('d-none');
            document.getElementById('text').classList.add('d-none');
            document.getElementById('file').classList.add('d-none');
        }
        else{
            document.getElementById('media').classList.add('d-none');
            document.getElementById('text').classList.add('d-none');
            document.getElementById('file').classList.add('d-none');
        }

    }
@stop


