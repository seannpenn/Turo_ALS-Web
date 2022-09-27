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
    
    #create-button{
        transition: transform 250ms;
    }
    #create-button:hover{
        cursor:pointer;
        transform: translateY(-5px);
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
    }
    

@stop

@section('main-content')
@include('dashboard.courses.create_course')
@include('navbar/navbar_inside', ['courseId' =>  request()->route('courseid'), 'topiccontentid' => request()->route('topiccontentid') ])

        @if(session('message'))
            
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                {{ session('message') }}
                </div>
            </div>
        @endif

    <div class="upper-left-header">
        <!-- <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">Create Course</button> -->
        <!-- <div class="header">
            <label class="col-sm-3 col-form-label">Show courses for: </label>
            <select class="courseCategory" aria-label="Default select example" name="courseCategory" id="courseCategory" onchange="getId(this)">
                @yield('option')
            </select>
        </div> -->
    </div>
    
    <div class="justify-content-center" style="width: 1000px; background-color: yellow; margin: 0 auto; padding: 5px;">
                        
        @if(count($ownedCourses) != 0)
                        <div class="row row-cols-1 row-cols-md-3 g-2">
                                <div class="col">
                                    <div class="card" style="border: none;">
                                        <div class="card text-center" id="create-button" >
                                            <div class="card-body">
                                                <a title="Add course" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat"><img style="width: 100px; height: 100px; margin: 50px auto;" src="{{ asset('images/add-icon.png') }}" alt="" ></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @foreach($ownedCourses as $course)
                                
                                <div class="col">
                                    <div class="card">
                                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                                        <div class="card-body" style="height: 15em;">
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


