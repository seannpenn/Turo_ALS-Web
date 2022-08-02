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
    }
    img{
        height: 20px;
        width: 20px; 
        
    } 
    img:hover{
        cursor:pointer;
    }
    .card{
        width: 750px;
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

    .created-module{
        display: flex;
        height: 50%; 
        overflow-y: auto;  
        padding: 5px; 
    }
    .course-header{
        width: 700px;
        display: flex;
        align-items: center;
    
    }
    .module-content-area{
        left:0;
        margin: 5px;
        width:100%;
        
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
        height:500px;
        display:flex;
        <!-- align-items: center; -->
        
    }
    .modules{
        width:800px;
        overflow-y:auto;
    }
    #topic-form{
        border: 2px solid black;
        padding: 20px;
        
        width:50%;
        height: auto;
        
    }
    
@stop

@section('left-side-nav-inside')
    <li class="nav-item">
        
    </li>
@stop

@section('left-side-nav')
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('teacher.home')}}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('users.all')}}">Manage Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('users.all')}}">Profile</a>
    </li>
@stop

@section('right-side-nav')
    <a class="nav-link" style="color: black;" href="{{route('user.logout')}}">{{Auth::user()->username}}</a>
     <a class="nav-link" style="color: black;" href="{{route('user.logout')}}">Logout</a>
@stop


@section('main-content')
    @include('dashboard.courses.create_course')
    @include('navbar/navbar_inside')

    <div class="layout">
        <div class="course-header">
            @foreach($chosenCourse as $course)
            
                <div class="card" id="card" style="width: 300px; height: 90px; margin: 5px;" class="btn btn-primary" data-bs-toggle="modal">
                    <div class="card-body">
                        
                        <h5 class="card-title">{{$course['course_title']}}</h5>
                        <p class="card-text">{{$course['course_description']}}</p>
                    
                    </div>

                    <div class="action" style="margin:2px;">
                        <td class="icons"><a title="Delete Course"><img src="{{ asset('images/delete.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></a></td>
                    </div>
                    
                </div>
                <p>
                <br>
    
                
            @endforeach

            
            <form class="form-area" style="width: 300px; text-align: center; padding: 20px;" action="{{route('content.create')}}" method="post">
            <h4>Create module</h4>
            {{ csrf_field() }}
                        <input type="course_id" name="course_id" value="{{$course['course_id']}}" hidden>
                <div>
                    <label class="visually-hidden" for="content_title">Content title</label>
                    <input type="text" class="form-control" name="content_title" id="specificSizeInputName" placeholder="Module title">
                </div>
                <div>
                    <label class="visually-hidden" for="Module Description">Module Description</label>
                    <div class="input-group">
                    <textarea class="form-control" name="content_description" id="exampleFormControlTextarea1" rows="3" placeholder="Module Description"></textarea>
                    </div>
                </div>
                
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
        
        @if(count($courseContent) != 0)
            <h4>Modules</h4>
        @else
            <h4>Add modules....</h4>
        @endif
            
        <div class="layout-bottom">

                <div class="modules">
                    @foreach($courseContent as $content)
                    <a href="{{route('content.view', $content['content_id'])}}" style="text-decoration:none; color:black;" id="module" title="Click to view module">
                        
                    
                        <div class="card" role="button" style="margin:5px;" id="moduleCard" >

                            <div class="card-body">
                            <h5>{{$content['content_id']}}</h5>
                                <h5>{{$content['content_title']}}</h5>
                                <h9>{{$content['content_description']}}</h9>
                                                    
                            </div>

                            <div class="action-delete" style="margin:2px;">
                                <td class="icons"><a href="{{ route('content.delete',$content['content_id']) }}" title="Delete Module"><img src="{{ asset('images/delete.png') }}" alt=""></a></td>
                            </div>
                            <div class="action" style="margin:2px;">
                                <div class="icons" onclick="showTopicInput( {{$content['content_id']}}); getModuleId({{$content['content_id']}});"><a  title="Add topic"><img src="{{ asset('images/add.png') }}" alt="" ></a></div>
                            </div>
                            
                        </div>

                    </a>

                    @endforeach
                </div>
                <div id="topic-form" class="d-none">
                        <div class="icons" onclick="showTopicInput()"><a  title="Close form"><img src="{{ asset('images/close.png') }}" alt="" ></a></div>
                        <h4>Add contents for Module</h4>
                        <form action="{{route('topic.create')}}" method="post">
                        {{ csrf_field() }}
                                <input type="text" id="ModuleId" name="content_id" class="form-control" placeholder="Title" aria-label="Title" value="" hidden>
                                <div class="col">
                                    <input type="text" name="topic_title" class="form-control" placeholder="Title" aria-label="Title" value="">
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <textarea class="form-control" name="topic_description" id="exampleFormControlTextarea1" placeholder="Description" rows="3" columns="8"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-4" id="selectType">
                                    <label class="visually-hidden" for="specificSizeSelect">Preference</label>
                                    <select class="form-select" id="specificSizeSelect" name="topic_type" onchange="showInput(this)">
                                    <option selected>Type</option>
                                    <option value="text">Text</option>
                                    <option value="file">File</option>
                                    <option value="quiz">Quiz</option>
                                    <option value="media">Media</option>
                                    </select>
                                </div>

                                <div class="content-type">
                                    <div id="text" class="d-none">
                                    <div class="container">
        
                                    </div>
                                    <div id="quiz" class="d-none" style="width: 500px; bakcground-color:yellow;">
                                        <div class="form-content">
                                            <form class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="inputEmail4" class="form-label">Quiz title</label>
                                                    <input type="email" class="form-control" name="quiz_title" id="inputEmail4">
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary">Create Quiz</button>
                                                </div>
                                            </form>
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
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mx-auto">
                                        <button type="submit" class="btn btn-primary btn-lg" type="button">add</button>
                                </div>
                        </form>
                </div>
        </div>
    </div>
        
@stop


@section('script-area')

    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>


        let confirmTask = document.getElementById('confirmTask');
        confirmTask.addEventListener('click',()=>{
            window.location.href = "{{ route('course.delete', $courseId) }}";
        });  

    function showTopicInput(id){
        if(document.getElementById('topic-form').classList.contains('d-none')){
            document.getElementById('topic-form').classList.remove('d-none');
        }
        else{
            document.getElementById('topic-form').classList.add('d-none');
        }
        document.getElementById('ModuleId').value = id;
        console.log(id);
    }

   function getModuleId(id){
        return id;
   }

    function showInput(answer){
        console.log(answer.value)

        if(answer.value == 'text'){
            document.getElementById('text').classList.remove('d-none');
            document.getElementById('file').classList.add('d-none');
            document.getElementById('quiz').classList.add('d-none');
            document.getElementById('media').classList.add('d-none');
        }
        else if(answer.value == 'file'){
            document.getElementById('file').classList.remove('d-none');
            document.getElementById('quiz').classList.add('d-none');
            document.getElementById('text').classList.add('d-none');
            document.getElementById('media').classList.add('d-none');
        }
        else if(answer.value == 'media'){
            document.getElementById('media').classList.remove('d-none');
            document.getElementById('quiz').classList.add('d-none');
            document.getElementById('text').classList.add('d-none');
            document.getElementById('file').classList.add('d-none');
        }
        else if(answer.value == 'quiz'){
            document.getElementById('quiz').classList.remove('d-none');
            document.getElementById('media').classList.add('d-none');
            document.getElementById('text').classList.add('d-none');
            document.getElementById('file').classList.add('d-none');
        }
        else{
            document.getElementById('media').classList.add('d-none');
            document.getElementById('quiz').classList.add('d-none');
            document.getElementById('text').classList.add('d-none');
            document.getElementById('file').classList.add('d-none');
        }

    }

    
@stop

<script>
    
</script>
