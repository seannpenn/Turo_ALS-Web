@extends('main')
@extends('dashboard/courses/createCourse_modal')
@extends('dashboard/courses/create_module_modal')
@extends('dashboard/courses/update_course_modal')
@extends('modalslug')
@extends('dashboard/modals/createTopic_modal')
@extends('dashboard/topic_content/choices_modal')
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
        
        display: flex;
        align-items: center;
        width: 700px;
    
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
        display: flex;
        align-items: stretch;
        width: 100%;
        
    }
    .modules{
        width: 330px;
        height:575px;
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
    .collapsible {
        margin: 10px;
        background-color: white;
        color: orange;
        cursor: pointer;
        padding: 5px;
        width: 280px;
        text-align: left;
        outline: none;
        font-size: 15px;
        border: 1px solid orange;
        border-radius: 5px;
    }
    .collapsible:hover {
        background-color: lightgrey;
    }
    .content {
        margin-bottom: 10px;
        font-size: 15px;
        padding: 0 18px;
        display: none;
        overflow: hidden;
        text-align: justify;
    }
    .topic{
        width: 255px;
        border: 1px solid orange;
        border-radius: 5px;
        margin: 10px; 
        padding: 5px;
        margin-left: 15px;
    }
    .topic:hover{
        background-color: lightgrey;
        cursor:pointer;
    }
    .view-topic{
        display: none;
    }
    .topic-content-list {
        margin-bottom: 10px;
        font-size: 15px;
        padding: 0 18px;
        display: none;
        overflow: hidden;
        text-align: left;
    }
    .topic-content{
        font-size: 10px;
        width: 235px;
        border: 1px solid orange;
        border-radius: 5px;
        margin: 10px; 
        padding: 10px;
        margin-left: 15px;
        justify-content:start;
    }
    .topic-content:hover{
        cursor: pointer;
        background-color: lightgrey;
    }
    .add-icon{
        
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
                        
                        <h6 class="card-title">{{$course->course_title}}</h6>
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
                
                <div class="modules">
                    @if($chosenCourse[0]->coursecontent->count() != 0)
                        <h4>Modules</h4>
                    @else
                        <h4>Add modules....</h4>
                    @endif
                    <table>
                        @foreach($chosenCourse as $course)
                            @foreach($course->coursecontent as $content)
                            
                                    <tr>
                                        @section('content-id')
                                            {{$content->content_id}}
                                        @stop
                                        <button type="button" class="collapsible" ><b>{{$content->content_title}}</b>
                                            <a  title="View Course" data-bs-toggle="modal" data-bs-target="#topicCreate" data-bs-whatever="@fat" style="display: flex; margin-left: 250px; right: 0;"><img src="{{ asset('images/add.png') }}" alt=""></a>                                           
                                        </button>
                                        
                                    </tr>

                                    <tr>
                                        <div class="content">
                                                @foreach($content->topic as $topic)
                                                    
                                                        <div class="topic">
                                                            <label for="">
                                                                {{$topic->topic_title}}
                                                            </label>
                                                            <div class="icon" style="display: flex; margin-left: 200px; right: 0;">
                                                                <a  title="Add Topic Content" data-bs-toggle="modal" data-bs-target="#topicChoices" data-bs-whatever="@fat"><img src="{{ asset('images/add.png') }}" alt=""></a>                                                                                    
                                                                <a  title="Delete Topic Content" data-bs-toggle="modal" data-bs-target="#topicChoices" data-bs-whatever="@fat"><img src="{{ asset('images/delete.png') }}" alt=""></a>                                                                                    
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="topic-content-list">
                                                            @foreach($topic->topiccontent as $topiccontent)
                                                            <a href="{{ route('topicContent.view', $topiccontent->topic_content_id) }}" style="text-decoration:none; color:black;">
                                                                <div class="topic-content">
                                                                    @if($topiccontent->type == 'html')
                                                                        <img src="{{ asset('images/text.jpg') }}" alt=""> 
                                                                    @elseif($topiccontent->type == 'quiz')
                                                                        <img src="{{ asset('images/link.png') }}" alt="">
                                                                    @else
                                                                        <img src="{{ asset('images/pdf.png') }}" alt="">
                                                                    @endif
                                                                    <p>{{$topiccontent->topic_content_title}}</p>
                                                                    
                                                                    <div class="icon" style="display: flex; margin-left: 200px; right: 0;">
                                                                        <a href="{{route('topicContent.delete', $topiccontent->topic_content_id)}}" onclick="return confirm('Are you sure you want to delete this content?')"><img src="{{ asset('images/delete.png') }}" alt=""></a>                                                                                    
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            @endforeach
                                                        </div>
                                                    
                                                    @section('html_create')
                                                        {{ route('html.create', $topic->topic_id) }}
                                                    @stop
                                                    @section('file_create')
                                                        {{ route('file.create', $topic->topic_id) }}
                                                    @stop
                                                    @section('link_create')
                                                        {{ route('link.create', $topic->topic_id) }}
                                                    @stop
                                                @endforeach
                                        </div>
                                        
                                    </tr>

                            @endforeach
                        @endforeach
                    </table>
                </div>
                <div class="view-topic" id="view-topic">
                
                    @include('dashboard.courses.view_topictest')
                </div>
        </div>
    </div>

    <script>
        var i;
        var z;
        var coll = document.getElementsByClassName("collapsible");
        var topic = document.getElementsByClassName("topic");
        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                content.style.display = "none";
                } else {
                content.style.display = "block";
                }
            });
        }
        for (z = 0; z < topic.length; z++) {
            topic[z].addEventListener("click", function() {
                this.classList.toggle("active");
                var topiccontent = this.nextElementSibling;
                if (topiccontent.style.display === "block") {
                    topiccontent.style.display = "none";
                } else {
                    topiccontent.style.display = "block";
                }
            });
        }


        var x;
        var topic = document.getElementsByClassName("topic");
        var viewTopic = document.getElementsByClassName("view-topic");  
        function load_main_content(){
            
                for (x = 0; x < topic.length; x++) {
                    topic[x].addEventListener("click", function() {
                        var content = document.getElementById("view-topic");
                        content.style.display = "block";
                        
                    });
                    
                }
        }
    </script>

    
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
