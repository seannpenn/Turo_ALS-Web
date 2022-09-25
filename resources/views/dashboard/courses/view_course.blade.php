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
        padding: 20px;
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
        display: flex;
        align-items: stretch;
        width: 100%;
        
    }
    .modules{
        margin: 0 auto;
        width: 645px;
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
    @include('dashboard.courses.create_course')
    @include('navbar/navbar_inside', ['courseId' =>  request()->route('courseid'), 'topiccontentid' => '' ])

    <div class="layout">
        <a href="{{route('course.all')}}">
                < Back to courses
                
        </a>
        <div class="course-header">
            @foreach($chosenCourse as $course)
            <div class = "d-flex justify-content-center">
                <div class="card " id="card" style="width: 300px; height: 90px; margin: 5px;" class="btn btn-primary" data-bs-toggle="modal">
                    <div class="card-body">
                        
                        <h6 class="card-title">{{$course->course_title}}</h6>
                        <p class="card-text">{{$course->course_description}}</p>
                    
                    </div>

                    <div class="action" style="margin:2px;">
                        <td class="icons"><a title="Update Course"><img src="{{ asset('images/edit.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#courseUpdateModal"></a></td>
                        <td class="icons"><a title="Delete Course"><img src="{{ asset('images/delete.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></a></td>
                    </div>
                    
                </div>
            </div>
                <p>
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

            <!-- <div class="upper-left-header">
                <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#moduleModal" data-bs-whatever="@fat">Create Module</button>
            </div> -->
        </div>
        <hr>

        <div class="layout-bottom">
                
                <div class="modules">
                    @if($chosenCourse[0]->coursecontent->count() != 0)
                        <h4>Modules</h4>
                    @else
                        <h4>Add modules....</h4>
                    @endif
                        @foreach($chosenCourse as $course)
                                
                                    <div class="row row-cols-1 row-cols-md-2 g-4">
                                        @foreach($course->coursecontent as $content)
                                            <div class="col">
                                                <div class="card h-100">
                                                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                                                    <div class="card-body">
                                                        <a href="{{ route('course.displayAll', $course['course_id'] ) }}">
                                                            <h5 class="card-title">{{$content['content_title']}}</h5>
                                                        </a>
                                                        <p class="card-text">{{$content['content_description']}}</p>
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                            
                                                        </div>
                                                        <h6>5 of 5</h6>
                                                    </div>
                                                </div>
                                            </div> 
                                        @endforeach
                                    </div>
                                
                        @endforeach
                </div>

        </div>
    </div>

    
@stop

