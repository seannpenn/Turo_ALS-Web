@extends('main')

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
    @include('navbar/navbar_inside', ['courseId' => request()->route('courseid'), 'topiccontentid' => '' ])

    <div class="layout">
        <a href="{{route('student.course')}}">
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
        </div>
        <hr>
        <div class="layout-bottom">
            <div class="modules">
                @if($chosenCourse[0]->coursecontent->count() != 0)
                <h4>Modules</h4>
                
                @else
                <h4>No Modules Available</h4>
                @endif

                @foreach($chosenCourse as $course)
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach($course->coursecontent as $content)
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <a href="{{ route('student.student_viewcontent', $course['course_id'] ) }}">
                                    <h5 class="card-title">{{$content['content_title']}}</h5>
                                </a>
                                <p class="card-text">{{$content['content_description']}}</p>
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

