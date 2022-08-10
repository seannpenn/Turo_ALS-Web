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
        margin: 0 auto;
        justify-content:center;
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
        margin: 0 auto;
        justify-content:center;
        height:600px;   
        width: 1000px;
        <!-- align-items: center; -->
        
    }
    .modules{
        width:1000px;
        height:600px;
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

@section('main-content')
    @include('dashboard.courses.create_course')
    @include('navbar/navbar_inside')

    <div class="layout">
    <a href="{{route('course.all')}}">
            < Back to courses
        </a>
        <div class="course-header">
            @foreach($chosenCourse as $course)
            
                <div class="card" id="card" style="width: 300px; height: 90px; margin: 5px;" class="btn btn-primary" data-bs-toggle="modal">
                    <div class="card-body">
                        
                        <h5 class="card-title">{{$course->course_title}}</h5>
                        <p class="card-text">{{$course->course_description}}</p>
                    
                    </div>

                    <div class="action" style="margin:2px;">
                        <td class="icons"><a title="Update Course"><img src="{{ asset('images/edit.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#courseUpdateModal"></a></td>
                        <td class="icons"><a title="Delete Course"><img src="{{ asset('images/delete.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></a></td>
                    </div>
                    
                </div>
                <p>
                <br>
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

            <div class="upper-left-header">
                <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#moduleModal" data-bs-whatever="@fat">Create Module</button>
            </div>
        </div>
        <hr>
    
        <div class="layout-bottom">
                @if($chosenCourse[0]->coursecontent->count() != 0)
                    <h4>Modules</h4>
                @else
                    <h4>Add modules....</h4>
                @endif
                <div class="modules">

                        @foreach($chosenCourse as $course)
                            @foreach($course->coursecontent as $content)
                                <a href="{{route('content.view', $content->content_id)}}" style="text-decoration:none; color:black;" id="module" title="Click to view module">
                                
                                    <div class="card" role="button" style="margin:5px;" id="moduleCard" >

                                        <div class="card-body">
                                        <h5>{{$content->content_id}}</h5>
                                            <h5>{{$content->content_title}}</h5>
                                            <h9>{{$content->content_description}}</h9>
                                                                
                                        </div>

                                        <div class="action" style="margin:2px;">
                                            <td class="icons"><a href="{{ route('content.delete',$content->content_id) }}" title="Delete Module"><img src="{{ asset('images/delete.png') }}" onclick="return confirm('Are you sure you want to delete this module?');"></a></td>
                                        </div>   
                                    </div>

                                </a>
                            @endforeach
                        @endforeach
                </div>
        </div>
    </div>
        
@stop


@section('script-area')

    
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
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
    
@stop

<script>
    
</script>
