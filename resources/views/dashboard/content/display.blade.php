@extends('main')
@extends('dashboard/courses/create')
@extends('dashboard/module/create')
@extends('dashboard/courses/update_course_modal')
@extends('modalslug')
@extends('dashboard/modals/createTopic_modal')
@extends('dashboard/topic_content/choices_modal')
@include('dashboard/topic_content/chooseQuiz')

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
        height:20px;
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
        line-height:35px;
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
        height: 740px;
        padding: 10px;
        overflow:hidden;
        overflow-y: scroll;
    }
    .topic-content-list {
        
        font-size: 15px;
        padding: 0 18px;
        display: none;
        overflow: hidden;
        text-align: left;
    }
    .topic-content{
        background-color: white;
        font-size: 10px;
        width: 225px;
        border: 1px solid white;
        border-radius: 5px;
        border-bottom: 0.5px solid lightgray;
        padding: 10px;
        margin-left: 20px;
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
    .quiz-select{
        padding: 10px;
        border-radius: 5px;
        border:none;
        border-bottom: 0.5px solid lightgray;
        width: 100%;
        height: 75px;
        background-color: white;
        text-align: left;
        gap:0;
    }
    .quiz-select:hover{
        background-color: lightgrey;
    }
@stop

@section('main-content')
    @include('dashboard.courses.create_course')
    @include('navbar/navbar_inside', ['courseId' => request()->route('courseid'), 'topiccontentid' => request()->route('topiccontentid')  ])
            <div class="d-flex justify-content-start" style="width: 1350px; margin: 0 auto;">
                <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#moduleModal" data-bs-whatever="@fat">Create Module</button>
            </div>
                                            
            <div class="d-flex justify-content-center">
                <div class="d-flex flex-row mb-3" style="max-height: 730px; width: 350px; overflow-y: scroll;">
                    <div class="w-100 p-3">
                        <table>
                            @foreach($courseCollection as $course)
                                @section('course_id')
                                    {{$course->course_id}}
                                @stop
                                    @foreach($course->coursecontent as $module)
                                            <tr>
                                            <button type="button" class="collapsible" id="collapsible" data-topic-value="{{$module->content_id}}" value="{{$module->content_title}}"><b>{{$module->content_title}}</b>
                                            </button>
                                                <!-- For topic create modal  -->
                                            </tr>   
                                            <tr>
                                                <div class="content">
                                                    @foreach($module->topic as $topic)
                                                        <button class="topic" data-value="{{$topic->topic_id}}" data-title="{{$topic->topic_title}}" onclick="getTopicId({{$topic->topic_id}})">
                                                            <label for="">
                                                                {{$topic->topic_title}}
                                                            </label>
                                                            <div class="icon" style="display: flex; margin-left: 210px; right: 0;">
                                                                <a href="{{route('topic.delete', $topic->topic_id)}}" onclick="return confirm('Are you sure you want to delete this topic?')"><img src="{{ asset('images/delete.png') }}" alt=""></a>                                                                                    
                                                            </div>
                                                        </button>
                                                        <div class="topic-content-list">
                                                            @foreach($topic->topiccontent as $topiccontent)
                                                                    <button class="topic-content" id="topic-content" onclick="getTopicContentId({{$topiccontent->topic_content_id}})">
                                                                        @if($topiccontent->type == 'html')
                                                                            <img src="{{ asset('images/text.jpg') }}" alt=""> 
                                                                        @elseif($topiccontent->type == 'quiz')
                                                                            <img src="{{ asset('images/link.png') }}" alt="">
                                                                        @else
                                                                            <img src="{{ asset('images/pdf.png') }}" alt="">
                                                                        @endif
                                                                        {{$topiccontent->topic_content_title}}
                                                                        <div class="icon" style="display: flex; margin-left: 180px; right: 0;">
                                                                        <a href="{{route('topicContent.delete', $topiccontent->topic_content_id)}}" onclick="return confirm('Are you sure you want to delete this content? {{$topiccontent->topic_content_id}}')"><img src="{{ asset('images/delete.png') }}" alt=""></a>                                                                                    
                                                                        </div>
                                                                    </button>
                                                                    
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
                <div class="d-inline p-1 text-bg-dark align-items-center">
                    <div class="control-area" id="control-area"></div>
                    <div class="view-topic" id="view-topic">
                    
                    </div>
                </div>
            </div>
            
    <script type="text/javascript">

        var y;
        var contentId, topicId;
        var view = document.getElementById("view-topic");
        var control = document.getElementById("control-area");
        var editor = document.getElementById("editor");
        
        function getTopicContentId(id){
            topicContentId = id;
        }
        function getTopicId(id){
            topicId = id;
        }
        
            $(".topic-content").click(function(e){
                var routeURL = '/teacher/course/' + '{{request()->route('courseid')}}' +  '/topiccontent/'+ topicContentId;
                var routeUpdate = "{{ route('topicContent.update', ":contentId") }}";
                routeUpdate = routeUpdate.replace(':contentId', topicContentId);
                // history.pushState(null, null, '/course/' + '{{request()->route('courseid')}}' +  '/topiccontent/'+ topicContentId);
                // view content
                e.preventDefault();

                $.ajax({
                    type: "GET",
                    url: routeURL,
                    dataType: 'json',
                    success: function(data){
                        if(data[0].type == 'html'){
                            console.log(routeUpdate);
                            control.innerHTML = ``;
                            
                            view.innerHTML = `<div class="text-content" >
                                                    <div class="col-auto">
                                                        <form>
                                                            <div class="card-body">
                                                                    {{csrf_field()}}
                                                                        <div class="mb-3">
                                                                            <label for="recipient-name" class="col-form-label">Topic Title</label>
                                                                            <input type="text" name="topic_content_title" class="form-control" id="topic_content_title" value="${data[0].topic_content_title}">
                                                                            <input type="text" name="type" class="form-control" id="type" value="html" hidden>
                                                                            <input type="text" name="topic_id" class="form-control" id="topic_id" value="${data[0].topic_id}" hidden>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <textarea class="form-control mt-5" name="html" id="editor" rows="20">${data[0].html}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                
                                                            </div>
                                                            <div class="modal-footer">  
                                                                <button type="submit" id="update" class="btn btn-warning">Update</button>
                                                            </div>
                                                        </form>
                                                    <br><br>
                                                    
                                                </div>
                                                `;

                                                
                                    $("#update").click(function(e){
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                            }
                                        });
                                        
                                            var topicId = $('#topic_id').val();
                                            var topicContentTitle = $('#topic_content_title').val();
                                            var type = $('#type').val();
                                            var editor = $('#editor').val();
                                        $.ajax({
                                                topic_id: topicId, 
                                                topic_content_id: contentId, 
                                                topic_content_title: topicContentTitle,
                                                type: type, 
                                                html: editor,
                                            dataType: 'json',
                                            success: function(response){
                                                alert('Update done.');
                                                console.log(response);
                                            },
                                            error: function(data){
                                                console.log(data);
                                            }
                                        });
                                    });
                        }
                        else if(data[0].type == 'quiz'){ //ok

                            var route = "{{route('quiz.edit', [":courseid" ,":id"])}}";
                            route = route.replace(':courseid', {{request()->route('courseid')}});
                            route = route.replace(':id', data[0].link); 
                            control.innerHTML = ``;
                            view.style.overflow = "scroll";
                            view.innerHTML = `
                            <div class="container text-center" style=" margin: 250px auto;">
                                <div class="row">
                                    <div class="col align-self-center">
                                        <h1>View and edit this quiz in the quiz tab</h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col align-self-center">
                                    <a href="${route}"><button type="submit" class="btn btn-warning">Go to Quiz</button></a>
                                    </div>
                                </div>
                            </div>
                            `;
                        }
                        else{
                            var asset = "{{ asset(":fileDirectory") }}";
                            asset = asset.replace(':fileDirectory', data[1]);
                            console.log(asset);
                            console.log(data[1]);
                            control.innerHTML = ``;
                            view.style.overflow = "scroll";
                            view.innerHTML = `
                            <div class="container text-center" >
                                <embed src="${asset}" height="700" width="950"/>
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
                contentid = this.getAttribute("data-topic-value");
                state = 'http://{{Request::getHttpHost()}}/teacher/course/' + '{{request()->route('courseid')}}/content/' + contentid;
                if('{{Request::url()}}' !== state)
                {
                    // history.replaceState("object or string", "Title", state);
                    // location.reload();
                }

                var routeTopicCreate = "{{route('topic.create', ":contentId")}}";
                var routeCreateTopic = "http://localhost:8000/teacher/course/content/" + contentid +"/topic";

                routeTopicCreate = routeTopicCreate.replace(':contentId', contentid);
                
                control.innerHTML = `
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button 
                                            type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#topicCreate{{request()->route('contentid')}}">Create Topic
                                        </button>
                                    </div>
                                    <h2 style="margin-left:20px;"> ${this.value} ${contentid}</h2>
                                    <hr>
                `;
                view.style.overflow = "hidden";
                view.innerHTML = ``;

                $('.create-button').click(function(e){
                        $("#content_id").val(contentid);
                });
                
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                console.log(content);
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
                
            });
        }
        for (z = 0; z < topic.length; z++) {
            topic[z].addEventListener("click", function() {
                
                topicId = this.getAttribute("data-value");
                topicTitle = this.getAttribute("data-title");
                state = 'http://{{Request::getHttpHost()}}/teacher/course/' + '{{request()->route('courseid')}}/topic/' + topicId;
                if('{{Request::url()}}' !== state)
                {
                    // history.replaceState(null, null, state);
                    // location.reload();
                    
                }
        
                view.style.overflow = "hidden";
                view.innerHTML = ``;
                
                control.innerHTML = `
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button 
                                            type="button" id="topicChoices" class="create-button" data-bs-toggle="modal" 
                                            data-bs-whatever="@fat" data-bs-target="#topicChoices">Create Resource
                                        </button>
                                    </div>
                                    <h2 style="margin-left:20px;">${topicTitle} ${topicId}</h2>
                                    <hr>
                `;

                // assigning of topic id to adding of resources
                $('#html-choice-button').click(function(e){
                    $("#html_topic_id").val(topicId);
                });
                $('#file-choice-button').click(function(e){
                    $("#file_topic_id").val(topicId);
                });

                // get all course quizzes for quiz display
                $(document).ready(function () {
                    $('#quiz-choice-button').one('click',function(e){
                        var getQuizRoute = "{{ route('quiz.all', ":courseid") }}";
                        getQuizRoute = getQuizRoute.replace(':courseid', '{{request()->route('courseid')}}');
                            $.ajax({
                                    type: "GET",
                                    url: getQuizRoute,
                                    dataType: 'json',
                                    success: function(data){
                                        console.log(data);
                                        var listQuizzes = document.getElementById("list-quizzes");
                                        var a;
                                        for(a=0;a<data.length; a++){
                                            listQuizzes.innerHTML += `
                                            <form action="{{route('topicContent.create')}}" method="post">
                                            {{ csrf_field() }}
                                                    <div>
                                                        <input type="text" class="form-control" name="type" id="recipient-name" value="quiz" hidden>
                                                        <input type="text" name="topic_content_title" class="form-control" value="${data[a].quiz_title}" hidden>
                                                        <input type="text" name="link" class="form-control" value="${data[a].quiz_id}" hidden>
                                                        <input type="text" name="topic_id" class="form-control" value="${topicId}" hidden>
                                                        <button class="quiz-select" type="submit">${data[a].quiz_title} - ${data[a].quiz_title}</button>
                                                        
                                                    </div>
                                            </form>`;
                                        }
                                    },
                                    error: function(data){
                                        console.log(getQuizRoute);
                                        console.log('hello');
                                        console.log(data);
                                    }
                            
                            });
                    });
                });
                
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