@extends('main')
@extends('dashboard/courses/create')
@extends('dashboard/module/create')
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
        padding: 10px;
    }
    img{
        height: 20px;
        width: 20px; 
        
    } 
    img:hover{
        cursor:pointer;
    }

    .layout-bottom{
        justify-content: center;
        display: flex;
        align-items: stretch;
        
    }
    .modules{
        width: 350px;
        height: 730px;
        overflow-y: scroll;
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
        line-height:30px;
        background-color:orange;
        color: white;
        border: 2px solid orange;
        border-radius: 5px;
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
        border: 1px solid black;
        border-radius: 5px;
        height: 70px;
    }
    
    .collapsible:hover {
        background-color: lightgrey;
    }
    .collapsible:focus {
        border: 2px solid orange;
    }
    .courseContent {
        margin-bottom: 10px;
        font-size: 15px;
        padding: 0 18px;
        display: none;
        overflow: hidden;
        text-align: justify;
    }
    .content {
        font-size: 15px;
        padding: 0 18px;
        display: none;
        overflow: hidden;
        text-align: justify;
    }
    .module{
        width: 258px;
        height: 70px;
        border: 1px solid orange;
        border-radius: 5px;
        margin: 10px; 
        padding: 5px;
        margin-left: 15px;
    }
    .module:hover{
        background-color: lightgrey;
        cursor:pointer;
    }
    .topic{
        background-color: white;
        text-align: left;
        width: 250px;
        border: 2px solid white;
        border-bottom: 2px solid lightgray;
        border-radius: 5px;
        padding: 5px;
        margin: 5px;
        margin-left: 20px;
    }
    .topic:hover{
        cursor:pointer;
        border: 2px solid lightgray;
        border-radius: 5px;
    }
    .topic:focus {
        border: 2px solid orange;
    }
    .view-topic{
        width: 1000px;
        height: 730px;
        padding-left: 10px;
    }
    .topic-content-list {
        
        font-size: 15px;
        padding: 0 18px;
        display: none;
        overflow: hidden;
        text-align: left;
    }
    .topic-content{
        font-size: 10px;
        width: 220px;
        border: 1px solid white;
        border-radius: 5px;
        border-bottom: 0.5px solid lightgray;
        padding: 10px;
        margin-left: 30px;
        justify-content:start;
    }
    .topic-content:hover{
        border: 1px solid orange;
        cursor: pointer;
    }
    .topic-content:focus {
        border: 2px solid orange;
    }
    .content-area{
        height: 730px;
    }
    .control-area{
        justify-content: center;
    }
    
@stop

@section('main-content')
    @include('dashboard.courses.create_course')
    @include('navbar/navbar_inside', ['courseId' => Request::getRequestUri()[strlen(Request::getRequestUri())-9] ])
    <div class="layout">
        <div class="layout-bottom">   
            <div class="side-bar">
                
                <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#moduleModal" data-bs-whatever="@fat">Create Module</button>

                <div class="modules">
                    <table>
                        @foreach($courseCollection as $course)
                            @section('course_id')
                                {{$course->course_id}}
                            @stop
                                @foreach($course->coursecontent as $module)
                                        <tr>
                                            <button type="button" class="collapsible" value="{{$module->content_title}}"><b>{{$module->content_title}}</b></button>
                                            <!-- For topic create modal  -->
                                            @section('content-id')
                                                {{$module->content_id}}
                                            @stop
                                        </tr>
                                        <tr>
                                            <div class="content">

                                                @foreach($module->topic as $topic)
                                                    <button class="topic" value="{{$topic->topic_title}}">
                                                        <label for="">
                                                            {{$topic->topic_title}}
                                                        </label>
                                                        <div class="icon" style="display: flex; margin-left: 190px; right: 0;">
                                                            <a  title="Delete Topic Content" data-bs-toggle="modal" data-bs-target="#topicChoices" data-bs-whatever="@fat"><img src="{{ asset('images/delete.png') }}" alt=""></a>                                                                                    
                                                        </div>
                                                        @section('html_create')
                                                            {{route('html.create', $topic->topic_id)}}
                                                        @stop
                                                        @section('file_create')
                                                            {{route('file.create', $topic->topic_id)}}
                                                        @stop
                                                        @section('link_create')
                                                            {{route('link.create', $topic->topic_id)}}
                                                        @stop
                                                    </button>
                                                    <div class="topic-content-list">
                                                        @foreach($topic->topiccontent as $topiccontent)
                                                                <div class="topic-content" id="topic-content" onclick="getId({{$topiccontent->topic_content_id}})">
                                                                    @if($topiccontent->type == 'html')
                                                                        <img src="{{ asset('images/text.jpg') }}" alt=""> 
                                                                    @elseif($topiccontent->type == 'quiz')
                                                                        <img src="{{ asset('images/link.png') }}" alt="">
                                                                    @else
                                                                        <img src="{{ asset('images/pdf.png') }}" alt="">
                                                                    @endif
                                                                    {{$topiccontent->topic_content_title}}
                                                                    
                                                                    <div class="icon" style="display: flex; margin-left: 180px; right: 0;">
                                                                        <a href="{{route('topicContent.delete', $topiccontent->topic_content_id)}}" onclick="return confirm('Are you sure you want to delete this content?')"><img src="{{ asset('images/delete.png') }}" alt=""></a>                                                                                    
                                                                    </div>
                                                                </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </tr>
                                @endforeach
                        @endforeach
                    </table>
                </div>
            </div>

                <div class="content-area">
                    <div class="control-area" id="control-area">
                        {{request()->route('id')}}
                    </div>
                    <div class="view-topic" id="view-topic">
                        
                    </div>
                </div>
                
        </div>
    </div>

    <script>
        

        var y;
        var topicContentId = document.getElementById("topic-content").value;
        var contentId;
        var view = document.getElementById("view-topic");
        var control = document.getElementById("control-area");
        var editor = document.getElementById("editor");

        function getId(id){
            contentId = id;
        }
        $(document).ready(function() {
        3
        $("#editor").Editor();                   
        4
        });
            $(".topic-content").click(function(e){
                var routeURL = '{{Request::getRequestUri()}}' + '/view/' + contentId;
                var route = "{{route('topicContent.view', [ ":id", ":contentId" ])}}";
                var routeUpdate = "{{route('topicContent.view', [ ":id", ":contentId" ])}}";
                route = route.replace(':id', '{{request()->route('id')}}');
                route = route.replace(':contentId', contentId);
                history.pushState(null, null, route);


                $.ajax({
                    type: "GET",
                    url: routeURL,
                    dataType: 'json',
                    success: function(data){
                        ClassicEditor
                        console.log(routeURL);
                        if(data[0].type == 'html'){
                            view.innerHTML = `<h1> ${data[0].topic_content_title} </h1><hr>`;
                            view.innerHTML += `${data[0].html}`;
                        }
                        else if(data[0].type == 'quiz'){
                            view.innerHTML = `<h1> ${data[0].topic_content_title} </h1><hr>`;
                            view.innerHTML = `
                                <h1>View and edit this quiz in the quiz tab</h1>
                                    
                                <div class="col-auto">
                                    <a href=""><button type="submit" class="btn btn-primary">Go to Quiz</button></a>
                                </div>
                            `;
                        }
                        console.log(data); 
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            });
        
        var i;
        const coll = document.getElementsByClassName("collapsible");
        const topic = document.getElementsByClassName("topic");
        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                control.innerHTML = `<div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button 
                                            type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#topicCreate" 
                                            data-bs-whatever="@fat">Create Topic
                                        </button>
                                    </div>

                `;
                view.innerHTML = `<h2 style="margin-left:20px;"> ${this.value}</h2>
                                    <hr>
                `;
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
                
                control.innerHTML = `<div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button 
                                            type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#topicChoices" 
                                            data-bs-whatever="@fat">Create Resource
                                        </button>
                                    </div>
                `;

                view.innerHTML = `<h2 style="margin-left:20px;"> ${this.value}</h2>
                                    <hr>
                `;
                var topiccontent = this.nextElementSibling;
                if (topiccontent.style.display === "block") {
                    topiccontent.style.display = "none";
                } else {
                    topiccontent.style.display = "block";
                }
            });
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