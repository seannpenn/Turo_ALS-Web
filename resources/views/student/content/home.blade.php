@extends('main')
@extends('dashboard/courses/update_course_modal')
@extends('modalslug')

@section('modal-content')
    <span id="modalContent"> Deleting this course would also remove all of its contents. Are you sure you want to proceed?</span>
@stop

@section('modal-title')
    Delete Course
@stop

@section('css-style')
    .layout{
        max-width: 1200px;
        margin: 0 auto;
    }
    img{
        height: 20px;
        width: 20px;  
    } 
    img:hover{
        cursor:pointer;
    }
    .card{
        
        transition: transform 250ms;
    }
    .card:hover{
        cursor:pointer;
        transform: translateY(-5px);
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
    }
    .course-header{
    
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
    .layout-bottom{
        max-width: 1200px;
        <!-- display: flex;
        align-items: stretch;
        width: 100%; -->
        
    }
    .modules{
        margin: 0 auto;
        
        padding: 10px;
        
        border-radius: 10px;
    }
    .create-button{
        width: 150px;
        line-height:50px;
        background-color:orange;
        color: white;
        border: 0;
        border-radius: 10px;
        margin:10px;
        
    }
    .create-button:hover{
        background-color:white;
        color: orange;
        border: 2px solid orange;
    }

    .view-topic{
        display: none;
    }
    .header{
        height: 200px;
        border-bottom: 2px solid orange;
        <!-- margin:15px; -->
    }
@stop

@section('main-content')
    @include('navbar/navbar_inside', ['courseId' =>  request()->route('courseid'), 'topiccontentid' => '' ])
        
        <div class="layout">
            <div class="upper-area">
                <div class="shadow-sm mb-3 p-5 bg-body header">
                @foreach($chosenCourse as $course)
                    <div class = "justify-content-left" style="margin: 0">
                        <h1>{{$course->course_title}}</h1>
                        <p>{{$course->course_description}}</p>
                    </div>
                @endforeach
                </div>
            </div>
            <div class="layout-bottom">
                    <nav aria-label="breadcrumb" >
                        <ol class="breadcrumb" style="background-color:white;">
                            <li class="breadcrumb-item"><a href="{{route('course.all')}}">Courses</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Home</li>
                        </ol>
                    </nav>
                    
                        <div class="row text-left">
                            <div class="col-md-8">
                                <h3>Modules</h3>
                            </div>
                        </div>
                    <div class="row">
                            <div class="col-md-8 shadow-sm p-3 mb-5 bg-body rounded">
                                <div class="row row-cols-2 g-3">
                                    @foreach($chosenCourse as $course)
                                        @foreach($course->coursecontent as $content)
                                            <div class="col">
                                                <div class="card h-100">
                                                    <svg style="border-bottom: 2px solid black;" class="bd-placeholder-img card-img-top" width="100%" height="100" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" focusable="false">
                                                        <title>Placeholder</title><rect width="100%" height="100%" fill="#FFFFFF"></rect><text x="39%" y="50%" fill="orange" dy=".3em">Image cap</text>
                                                    </svg>
                                                    <div class="card-body">
                                                        <a href="{{ route('student.contentDisplay', $course['course_id'] ) }}">
                                                            <h5 class="card-title">{{$content['content_title']}}</h5>
                                                        </a>
                                                        <p class="card-text">{{$content['content_description']}}</p>
                                                    </div>
                                                </div>
                                            </div> 
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>

                        <div class="col-6 col-md-4">
                            <div class="shadow-sm p-3 mb-5 bg-body rounded">
                                <div class="container text-left shadow-none p-3 mb-5 bg-light rounded">
                                    <ol class="list-group list-group-numbered">
                                        <h2>Teacher profile</h2>
                                        <svg class="bd-placeholder-img rounded-circle" width="75" height="75" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Completely round image: 75x75" preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <title>Completely round image</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="22%" y="50%" fill="#dee2e6" dy=".3em">75x75</text></svg>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row shadow-none p-3 mb-5 bg-light rounded">
                        <div class="row shadow-none p-3 mb-5 bg-light rounded" style="margin-top: 10px;">
                            <div class="container text-left" >
                                <ol class="list-group list-group-numbered">
                                    <div class="justify-content-left">
                                        <h2>Announcements for this course</h2>
                                    </div>
                                    
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                        <div class="fw-bold">No classes on Monday</div>
                                            As declared by the Department of Education, all ALS blablablabla
                                            <p>{{now()->toDateTimeString()}}</p>
                                            
                                        </div>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

    
@stop

