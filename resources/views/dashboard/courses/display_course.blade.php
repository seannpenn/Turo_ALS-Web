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
        transform: translateY(-1px);
        box-shadow: 0 1px 5px rgb(0 0 0 / 0.2);
    }
    

@stop

@section('main-content')
@include('dashboard.courses.create_course')
@include('navbar/navbar_inside', ['courseId' =>  request()->route('courseid'), 'topiccontentid' => request()->route('topiccontentid') ])

    <div class="justify-content-center" style="width: 500px; margin: 0 auto;">
        @if(session('message'))
            <div class="alert alert-success align-items-center" role="alert" style="margin: 0 auto;">
                <div class="d-flex justify-content-between">
                    <div></div>
                    <div>
                        {{ session('message') }}
                    </div>
                    <div>
                        <button type="button" class="btn-close btn-close-black me-2 m-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                
            </div>
        @endif
    </div>
    <div class="justify-content-center" style="width: 1000px; margin: 0 auto; padding: 5px;">
        @if(count($ownedCourses) != 0)
                        <div class="row row-cols-1 row-cols-md-3 g-2">
                                <div class="col">
                                    <div class="card" style="border: none;">
                                        <a title="Add course" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">
                                            <div class="card text-center" id="create-button" style="border: none;">
                                                <div class="card-body">
                                                    <img style="width: 100px; height: 100px; margin: 50px auto;" src="{{ asset('images/add-icon.png') }}" alt="" >
                                                </div>
                                            </div>
                                        </a>
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
</script>


