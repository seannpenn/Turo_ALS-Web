@extends('main')
@extends('dashboard/courses/update_course_modal')
@extends('modalslug')
@extends('dashboard/module/create')
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
    
@stop

@section('main-content')
    @include('navbar/navbar_inside', ['courseId' =>  request()->route('courseid'), 'topiccontentid' => '' ])

    <div class="layout">
            <div class="d-flex flex-column mb-3">
                <div class="shadow-sm mb-3 p-5 bg-body rounded header">
                    @foreach($chosenCourse as $course)
                        <div class = "d-flex justify-content-center">
                            <div class="card" data-bs-toggle="modal" style="width: 1200px;">
                                <div class="card-body">
                                    
                                    <h2 class="card-title">{{$course->course_title}}</h2>
                                    <p class="card-text">{{$course->course_description}}</p>
                                
                                </div>
                                <div class="action" style="margin:2px;">
                                    <td class="icons"><a title="Update Course"><img src="{{ asset('images/edit.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#courseUpdateModal"></a></td>
                                    <td class="icons"><a title="Delete Course"><img src="{{ asset('images/delete.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></a></td>
                                </div>
                                
                            </div>
                        </div>

                        @section('form-action-update')
                            {{route('course.update', $course->course_id)}}
                        @stop
                        @section('title-value'){{$course->course_title}}@stop
                        @section('description-value'){{$course->course_description}}@stop
                        @section('course_id')
                            {{$course->course_id}}
                        @stop

                        @section('script-area')
                            let confirmTask = document.getElementById('confirmTask');
                            confirmTask.addEventListener('click',()=>{
                                window.location.href = "{{ route('course.delete', $course->course_id) }}";
                            });  
                        @stop
                        
                    @endforeach
                </div>
            </div>
                <div class="modules">
                    <div class="row shadow-sm p-3 mb-2 bg-body rounded">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb" style="background-color:white;">
                                <li class="breadcrumb-item"><a href="{{route('course.all')}}">Courses</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Home</li>
                            </ol>
                        </nav>
                        <div class="row text-left">
                            <div class="col-md-8">
                            @if($chosenCourse[0]->coursecontent->count() != 0)
                                <div class="d-flex flex-row mb-3">
                                <div class="p-2"><h3>Modules</h3></div>
                                <div class="p-2">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#moduleModal" data-bs-whatever="@fat" style="background-color: orange; border-color:orange;">Create Module</button>
                                </div>
                            </div>
                            @else
                            <h4>Add modules....
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#moduleModal" data-bs-whatever="@fat" style="background-color: orange; border-color:orange;">Create Module</button>
                            </h4>
                            @endif
                            </div>
                        </div>
                        <div class="col" style="width:fit-content;">
                            
                        </div>
                        <div class="col-md-15" style="height: 500px;">
                        
                            <div class="row row-cols-3 g-3">
                                
                                @foreach($chosenCourse as $course)
                                    @foreach($course->coursecontent as $content)
                                        <div class="col">
                                            <div class="card h-100">
                                            <svg class="bd-placeholder-img card-img-top" width="100%" height="100" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
                                                <title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="44%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                                            </svg>
                                                <div class="card-body">
                                                    <a href="{{ route('course.displayAll', $course['course_id'] ) }}">
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

                        <!-- <div class="col-6 col-md-4">
                            <div class="shadow-sm p-3 mb-5 bg-body rounded">
                                <div class="container text-left shadow-none p-3 mb-5 bg-light rounded">
                                    <ol class="list-group list-group-numbered">
                                        <h2>Teacher profile</h2>
                                        <svg class="bd-placeholder-img rounded-circle" width="75" height="75" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Completely round image: 75x75" preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <title>Completely round image</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="22%" y="50%" fill="#dee2e6" dy=".3em">75x75</text></svg>
                                        
                                    </ol>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
    </div>

    
@stop

