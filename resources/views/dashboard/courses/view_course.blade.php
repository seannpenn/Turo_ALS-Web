@extends('main')
@extends('dashboard/courses/createCourse_modal')
@extends('dashboard/courses/createCourseContent_modal')

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
    .title{
        display:flex;
    }
    .form-area{
        width:500px;
    }
@stop

@section('left-side-nav-inside')
    <li class="nav-item">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">Create Course</button>
        <button type="button" class="btn btn-primary"><a class="nav-link active" aria-current="page" href="{{route('course.all')}}">View Courses</a></button>

    </li>
@stop

@section('main-content')
    @include('dashboard.courses.create_course')

    <td class="icons"><a href="{{route('course.all')}}" title="View Course">back</a></td>

        <div class="course-header">
            @foreach($chosenCourse as $course)
                <div class="card" id="card" style="width: 18rem; height: 180px; margin: 5px;" class="btn btn-primary" data-bs-toggle="modal">
                    <div class="card-body">
                        <h1>{{$course['course_id']}}</h1>
                        <h5 class="card-title">{{$course['course_title']}}</h5>
                        <p class="card-text">{{$course['course_description']}}</p>
                    </div>
                </div>

                <!-- <div class="title">
                    <div class="header">
                        <h1>{{$course['course_title']}}</h1>
                        <h5>{{$course['course_description']}}</h5>
                    </div>
                    <div class="action">
                        <td class="icons"><a href="{{ route('course.delete',$course['course_id']) }}" title="Delete Student Entry"><img src="{{ asset('images/delete.png') }}" alt=""></a></td>
                    </div>
                </div> -->
                <br>
                <h2>Add Course Modules</h2>

                    <div class="form-area">
                        <form class="row gy-2 gx-3 align-items-center" action="{{route('content.create')}}" method="post">
                        {{ csrf_field() }}
                            <input type="course_id" name="course_id" value="{{$course['course_id']}}" hidden>
                                <div class="row">
                                    <div class="mb-3">
                                        <input type="text" name="content_title" class="form-control" id="exampleFormControlInput1" placeholder="Module title">
                                    </div>

                                    <div class="mb-3">

                                        <textarea class="form-control" name="content_description" id="exampleFormControlTextarea1" rows="3" placeholder="Module Description"></textarea>
                                    </div>
                                    <!-- <div class="col">
                                        <input type="text" class="form-control" placeholder="Title" aria-label="Title">
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" columns="8"></textarea>
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-sm-4">
                                        <label class="visually-hidden" for="specificSizeSelect">Preference</label>
                                        <select class="form-select" id="specificSizeSelect" onchange="showInput(this)">
                                        <option selected>Type</option>
                                        <option value="text">Text</option>
                                        <option value="file">File</option>
                                        <option value="media">Media</option>
                                        </select>
                                    </div> -->
                                </div>
                                <!-- <div class="content-type">
                                    <div id="text" class="d-none">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                            <label for="floatingTextarea2">Comments</label>
                                        </div>
                                    </div>
                                    <div id="file" class="d-none">
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                            <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Button</button>
                                        </div>
                                    </div>
                                    <div id="media" class="d-none">
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                            <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Button</button>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mx-auto">
                                    <button type="submit" class="btn btn-primary btn-lg" type="button">add</button>
                                </div>
                            </form>
                </div>
                
            @endforeach
        </div>
        <div class="created-course">
            @foreach($courseContent as $content)
                <div class="card w-75">
                    <div class="card-body">
                        <h5 class="card-title">{{$content['content_title']}}</h5>
                        <p class="card-text">{{$content['content_description']}}</p>
                        <a href="#" class="btn btn-primary">Button</a>
                    </div>
                </div>
            @endforeach
        </div>
    

@stop

@section('script-area')
    function showInput(answer){
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
        else{
            document.getElementById('media').classList.remove('d-none');
            document.getElementById('text').classList.add('d-none');
            document.getElementById('file').classList.add('d-none');
        }

    }
@stop
