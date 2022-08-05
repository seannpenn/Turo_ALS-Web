@extends('main')
@extends('dashboard/courses/createCourse_modal')
@extends('dashboard/courses/create_module_modal')
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
        width: 750px;
    }
    .card:hover{
        cursor:pointer;
        border-color: orange;
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
    .upper-left-header{
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
        <a class="nav-link active" aria-current="page" href="{{route('students.all')}}">Manage Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="">Profile</a>
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
                        <td class="icons"><a title="Update Course"><img src="{{ asset('images/edit.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#courseUpdateModal"></a></td>
                        <td class="icons"><a title="Delete Course"><img src="{{ asset('images/delete.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></a></td>
                    </div>
                    
                </div>
                <p>
                <br>
                @section('form-action-update')
                    {{route('course.update', $course['course_id'])}}
                @stop
                @section('title-value'){{$course['course_title']}}@stop
                @section('description-value'){{$course['course_description']}}@stop
                @section('course_id')
                    {{$course['course_id']}}
                @stop
                
            @endforeach

            <div class="upper-left-header">
                <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#moduleModal" data-bs-whatever="@fat">Create Module</button>
            </div>
        </div>
        <hr>
        @if(count($courseContent) != 0)
            <h4>Modules</h4>
        @else
            <h4>Add modules....</h4>
        @endif
            
        <div class="layout-bottom">

                <div class="modules">
                    <div class="main-module"></div>
                    @foreach($courseContent as $content)
                    <a href="{{route('content.view', $content['content_id'])}}" style="text-decoration:none; color:black;" id="module" title="Click to view module">
                        
                    
                        <div class="card" role="button" style="margin:5px;" id="moduleCard" >

                            <div class="card-body">
                            <h5>{{$content['content_id']}}</h5>
                                <h5>{{$content['content_title']}}</h5>
                                <h9>{{$content['content_description']}}</h9>
                                                    
                            </div>

                            <div class="action" style="margin:2px;">
                                <td class="icons"><a href="{{ route('content.delete',$content['content_id']) }}" title="Delete Module"><img src="{{ asset('images/delete.png') }}" alt=""></a></td>
                            </div>   
                        </div>

                    </a>

                    @endforeach
                </div>
        </div>
    </div>
        
@stop


@section('script-area')

    
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    


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
