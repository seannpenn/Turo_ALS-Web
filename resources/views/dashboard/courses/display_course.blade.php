@extends('main')
@extends('dashboard/courses/create')
@extends('modalslug')

@section('modal-content')
    <span id="modalContent"> Deleting this course would also remove all of its contents. Are you sure you want to proceed?</span>
@stop

@section('modal-title')
    Delete Course
@stop

@section('css-style')
    .layout{
        padding: 20px;
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
        margin: 0 auto;
        display: flex;
        flex-grow: 1;
        flex-direction: row;
        justify-content:left;
        gap: 15px;
        <!-- background-color: #2196F3; -->
        padding: 20px; 
        
    }
    .action{
        position: absolute;
        bottom: 0px;
        right: 20px;
    }
    .action-delete{
        position: absolute;
    bottom: 0px;
    right: 50px;
    }
    .header{
        display:flex;
        margin: 30 auto;
        width: 800px;
        border: 1 solid;
    }
    .empty-course{
        text-align:center;
        margin: 250 auto;
        justify-content:center;
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
        width: 125px;
        padding: 2px;
        line-height:30px;
        background-color:orange;
        color: white;
        border: 0;
        border-radius: 5px;
        
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
    
    <div class="d-flex justify-content-center">
        @if(count($ownedCourses) != 0)
                        
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            @foreach($ownedCourses as $course)
                                <div class="col">
                                    <div class="card h-100">
                                    <img src="..." class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$course['course_title']}}</h5>
                                        <p class="card-text">{{$course['course_description']}}</p>
                                    </div>
                                    </div>
                                    <div class="action">
                                        <td class="icons"><a href="{{route('course.showInfo', $course['course_id'])}}" title="View Course"><img src="{{ asset('images/add.png') }}" alt=""></a></td>
                                    </div>
                                    <div class="action-delete" style="margin:2px;">
                                        <td class="icons"><a href ="{{ route('course.delete', $course['course_id']) }}" title="Delete Course"><img src="{{ asset('images/delete.png') }}" onclick="return confirm('Are you sure you want to delete this course?');"></a></td>
                                    </div>
                                </div>
                            @endforeach
                        </div>
        @else
            <div class="empty-course">
                <h1>You dont have any courses posted.</h1>
            </div>
        @endif    
    </div>

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


