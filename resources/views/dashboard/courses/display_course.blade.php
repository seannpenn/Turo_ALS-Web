@extends('main')
@extends('dashboard/courses/createCourse_modal')
@extends('modalslug')

@section('modal-content')
    <span id="modalContent"> Deleting this course would also remove all of its contents. Are you sure you want to proceed?</span>
@stop

@section('modal-title')
    Delete Course
@stop
@section('option')
    @foreach($programs as $program)
        <option value="{{ $program['prog_id'] }}" selected>{{ $program['prog_fname'] }}</option>
    @endforeach
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
        display:flex;
        margin: 30 auto;
        width: 800px;
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

@section('main-content')
@include('dashboard.courses.create_course')
@include('navbar/navbar_inside')

        @if(session('message'))
            <div class="altert alert-success">{{ session('message') }}</div>
        @endif

    <div class="upper-left-header">
        <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">Create Course</button>
        <!-- <div class="header">
            <label class="col-sm-3 col-form-label">Show courses for: </label>
            <select class="courseCategory" aria-label="Default select example" name="courseCategory" id="courseCategory" onchange="getId(this)">
                @yield('option')
            </select>
        </div> -->
    </div>
    

    
    @if(count($ownedCourses) != 0)
        <div class="course-area">
            @foreach($ownedCourses as $course)
                
                    <div class="card" id="card" style="width: 300px; height: 200;" class="btn btn-primary" data-bs-toggle="modal" >
                        <div class="card-body">
                            <div class="card-content" >
                                <h1>{{$course['course_id']}}</h1>
                                <h5 class="card-title">{{$course['course_title']}}</h5>
                                <p class="card-text">{{$course['course_description']}}</p>
                            </div>
                            
                            <div class="action">
                                <td class="icons"><a href="{{route('course.showInfo', $course['course_id'])}}" title="View Course"><img src="{{ asset('images/add.png') }}" alt=""></a></td>
                            </div>
                            <div class="action-delete" style="margin:2px;">
                                <td class="icons"><a href ="{{ route('course.delete', $course['course_id']) }}" title="Delete Course"><img src="{{ asset('images/delete.png') }}" onclick="return confirm('Are you sure you want to delete this course?');"></a></td>
                            </div>
                        </div>
                    </div>
                
                    
            @endforeach
             
        </div>
    @else
        <div class="empty-course">
            <h1>You dont have any courses posted.</h1>
        </div>
    @endif

@stop

<script>
    let id;
    console.log(id);
    function getId($id){
        id = $id.value;
        alert($id.value);
    }

    function returnId(){
        return id;
    }
    
</script>


