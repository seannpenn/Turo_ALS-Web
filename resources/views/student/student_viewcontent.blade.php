@extends('main')

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
        height: 670px;
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
                                        <button type="button" class="collapsible" data-topic-value="{{$module->content_id}}" value="{{$module->content_id}}">
                                            <b>{{$module->content_title}}</b>
                                        </button>
                                    </tr>
                                    <tr>
                                                <div class="content">
                                                    @foreach($module->topic as $topic)
                                                        <div class="topic" data-value="{{$topic->topic_id}}" value="{{$topic->topic_title}}" onclick="getTopicId({{$topic->topic_id}})">
                                                            <label for="">
                                                                {{$topic->topic_title}}
                                                            </label>
                                                            <div class="icon" style="display: flex; margin-left: 210px; right: 0;">
                                                                <a href="{{route('topic.delete', $topic->topic_id)}}" onclick="return confirm('Are you sure you want to delete this topic?')"><img src="{{ asset('images/delete.png') }}" alt=""></a>                                                                                    
                                                            </div>
                                                        </div>
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
                <div class="d-inline p-2 text-bg-dark align-items-center">
                    <div class="control-area" id="control-area">
                        {{request()->route('id')}}
                    </div>

                    <div class="view-topic" id="view-topic">
                        
                    </div>
                </div>
            </div>
           
    <script type="text/javascript">
        var y;
        var topicContentId = document.getElementById("topic-content").value;
        var contentId, topicId;
        var view = document.getElementById("view-topic");
        var control = document.getElementById("control-area");
        var editor = document.getElementById("editor");
        
        function getId(id){
            contentId = id;
        }
        function getTopicId(id){
            topicId = id;
        }
        
        $(document).ready(function () {

            $(".topic-content").click(function(e){
                var routeURL = '{{Request::getRequestUri()}}' + '/view/' + contentId;
                var routeUpdate = "{{ route('topicContent.update', ":contentId") }}";
                routeUpdate = routeUpdate.replace(':contentId', contentId);
                // history.pushState(null, null, route);
                // view content
                e.preventDefault();

                $.ajax({
                    type: "GET",
                    url: routeURL,
                    dataType: 'json',
                    success: function(data){
                        if(data[0].type == 'html'){
                            console.log(routeUpdate);
                            view.innerHTML = `<h1> ${data[0].topic_content_title} </h1><hr>`;
                            view.innerHTML += `<div class="text-content" >
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
                                                                            <textarea class="form-control mt-5" name="html" id="editor" rows="20" >${data[0].html}</textarea>
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
                            ClassicEditor
                                .create( document.querySelector( '#editor' ) )
                                .then( editor => {
                                    console.log( editor );
                                } )
                                .catch( error => {
                                    console.error( error );
                                } );

                                $("#update").click(function(e){
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                            var topicId = $('#topic_id').val();
                                            var topicContentTitle = $('#topic_content_title').val();
                                            var type = $('#type').val();
                                            var editor = $('#editor').val();
                                        
                                        $.ajax({
                                            url: routeUpdate,
                                            type: 'POST',
                                            data: {
                                                topic_id: topicId, 
                                                topic_content_id: contentId, 
                                                topic_content_title: topicContentTitle,
                                                type: type, 
                                                html: editor,
                                            },
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
                        else if(data[0].type == 'quiz'){

                            var route = "{{route('quiz.edit', ":id")}}";
                            route = route.replace(':id', data[0].link);

                            view.innerHTML = `<h1> ${data[0].topic_content_title} </h1><hr>`;
                            view.innerHTML += `
                            <div class="container text-center" style=" margin: 200px auto;">
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
                        console.log(data); 
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            });
        });
            

        
        var i;
        const coll = document.getElementsByClassName("collapsible");
        const topic = document.getElementsByClassName("topic");
        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                const dataValue = this.getAttribute("data-topic-value");
                var contentId = coll.value;
                var routeTopicCreate = "{{route('topic.create', ":contentId")}}";
                var routeCreateTopic = "http://localhost:8000/teacher/course/content/" + dataValue +"/topic";

                routeTopicCreate = routeTopicCreate.replace(':contentId', dataValue);

                view.innerHTML = `<h2 style="margin-left:20px;"> ${this.value}</h2>
                                    <hr>
                `;
                
                control.innerHTML = `@section('topic_id') (${dataValue}) @stop
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button 
                                            type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#topicCreate" data-contentId="5"
                                            data-bs-whatever="@fat">Create Topic
                                        </button>
                                    </div>
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
                dataValue = this.getAttribute("data-value");
                var routeHtml = "{{route('html.create', ":id")}}";
                var routeFile = "{{route('file.create', ":id")}}";
                var routeLink = "{{route('link.create', ":id")}}";
                routeHtml = routeHtml.replace(':id', dataValue);
                routeFile = routeFile.replace(':id', dataValue);
                routeLink = routeLink.replace(':id', dataValue);
                var contentChoices = "{{ route('topicContent.choices', [":courseid", ":topicid", ":contentid"] )}}";
                contentChoices = contentChoices.replace(':contentid', dataValue);
                contentChoices = contentChoices.replace(':courseid', dataValue);
                contentChoices = contentChoices.replace(':topicid', dataValue);
                console.log(routeHtml);
                console.log(routeFile);
                console.log(routeLink);

                control.innerHTML = `
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                                   
                                        <button 
                                            type="button" id="create-button" class="create-button" data-bs-toggle="modal" 
                                            data-bs-whatever="@fat" value="${dataValue}">Create Resource 
                                        </button>
                                    </div>
                `;
                var resourceButton = document.getElementById("create-button");
                resourceButton.addEventListener("click", function() {
                    window.location.href = contentChoices;
                });
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