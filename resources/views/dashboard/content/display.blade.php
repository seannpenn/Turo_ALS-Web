@extends('main')
@extends('dashboard/courses/create')
@extends('dashboard/module/create')
@extends('dashboard/courses/update_course_modal')
@extends('modalslug')
@extends('dashboard/modals/createTopic_modal')
@include('dashboard/topic_content/add-html')
@include('dashboard/topic_content/add-file')
@include('dashboard/topic_content/add-quiz')
@include('dashboard/content/update_topic_modal')
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
        margin: 5px;
        background-color: white;
        color: orange;
        padding: 5px;
        width: 280px;
        text-align: left;
        outline: none;
        font-size: 15px;
        border: 0.5px lightgray;
        border-radius: 5px;
        height: 70px;
        transition: transform 250ms;
    }
    .collapsible:hover{
        cursor:pointer;
        transform: translateY(-4px);
        box-shadow: 0 1px 5px rgb(0 0 0 / 0.2);
    }
    .collapsible:focus {
        border-bottom: 2px solid orange;
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
        width: 500px;
        font-size: 15px;
        padding: 10px 18px;
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
        height: 80px;
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
        width: 61em;
        height: 720px;
        padding: 5px;
        overflow-x:hidden;
        overflow-y: scroll;
    }
    .topic-content-list {
        width: 500px;
        font-size: 15px;
        padding: 0 18px;
        display: none;
        overflow: hidden;
        text-align: left;
        gap: 3;
    }
    .topic-content{
        margin-top: 10px;
        background-color: white;
        font-size: 10px;
        width: 225px;
        height: 75px;
        border: 1px solid white;
        border-radius: 5px;
        border-bottom: 0.5px solid lightgray;
        padding: 10px;
        margin-left: 20px;
        justify-content:start;
        text-align: left;
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
    #panel {
        padding: 50px;
        display: none;
    }
@stop

@section('main-content')
    @include('navbar/navbar_inside', ['courseId' => request()->route('courseid'), 'topiccontentid' => request()->route('topiccontentid')  ])
        <div class="col" style=" margin: 0 auto; width: 70%; padding: 10px; border-radius: 10px;">
            

            <div class="d-flex justify-content-start" style="width:1350px;">
                <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#moduleModal" data-bs-whatever="@fat">Create Module</button>
            </div>
            <div class="d-flex justify-content-center">
                <div class="d-flex flex-row mb-3" style="max-height: 710px; width: 30%; overflow-y: scroll;overflow-x: hidden;">
                    <div class="w-100 p-3">
                        <table>
                            @foreach($courseCollection as $course)
                                @section('course_id')
                                    {{$course->course_id}}
                                @stop
                                    @foreach($course->coursecontent as $module)
                                            <tr>
                                                <button type="button"  class="shadow-sm p-3 bg-body rounded collapsible" id="collapsible" data-topic-value="{{$module->content_id}}" value="{{$module->content_title}}"><b>{{$module->content_title}}</b>
                                                    <!-- <a href="" onclick="return confirm('Are you sure you want to delete this content?')"><img src="{{ asset('images/delete.png') }}" alt=""></a> -->
                                                </button>
                                                <!-- For topic create modal  -->
                                            </tr>   
                                            <tr>
                                                <div class="content">
                                                    @foreach($module->topic as $topic)
                                                        <button class="topic position-relative shadow-sm p-3 mb-1 bg-body" data-value="{{$topic->topic_id}}" data-title="{{$topic->topic_title}}" data-description="{{$topic->topic_description}}" onclick="getTopicId({{$topic->topic_id}})">
                                                            <label for="">
                                                                {{$topic->topic_title}}
                                                            </label>
                                                            <div class="position-absolute top-0 start-100 translate-middle">
                                                                <a href="{{route('topic.delete', $topic->topic_id)}}" onclick="return confirm('Are you sure you want to delete this topic?\nDeleting this topic will also delete all of its content.')"><img class="rounded-circle" src="{{ asset('images/close.png') }}" alt="" style="background-color: lightgray;"></a>
                                                            </div>
                                                        </button>
                                                        <div class="topic-content-list g-2">
                                                            @foreach($topic->topiccontent as $topiccontent)
                                                                    <button class="topic-content position-relative shadow-sm mb-1 bg-body " id="topic-content" onclick="getTopicContentId({{$topiccontent->topic_content_id}})">
                                                                        <!-- <div class="position-absolute top-0 start-100 translate-middle">
                                                                            <a href="{{route('topic.delete', $topic->topic_id)}}" onclick="return confirm('Are you sure you want to delete this topic?\nDeleting this topic will also delete all of its content.')"><img class="rounded-circle" src="{{ asset('images/close.png') }}" alt="" style="background-color: lightgray;"></a>
                                                                        </div> -->
                                                                        
                                                                        @if($topiccontent->type == 'html')
                                                                            <img src="{{ asset('images/text.jpg') }}" alt=""> 
                                                                        @elseif($topiccontent->type == 'quiz')
                                                                            <img src="{{ asset('images/link.png') }}" alt="">
                                                                        @else
                                                                            <img src="{{ asset('images/pdf.png') }}" alt="">
                                                                        @endif
                                                                        {{$topiccontent->topic_content_title}}
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
                <div class="d-inline p-1 text-bg align-items-center">
                    <div class="control-area" id="control-area"></div>
                        <div class="view-topic" id="view-topic">
                            <div class="container text-center" style=" margin: 250px auto;">
                                <div class="row">
                                    <div class="col align-self-center">
                                        @foreach($errors->get('error') as $errorMessage )
                                            <span><h5 style="color: red">{{ $errorMessage }}</h5></span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
    <script type="text/javascript">

        // const toast = new bootstrap.Toast(toastLiveExample)
        // toast.show()

        var y;
        var contentId, topicId;
        var view = document.getElementById("view-topic");
        var control = document.getElementById("control-area");
        
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
                view.innerHTML =`
                    <div class="container text-center" style=" margin: 250px auto;">
                        <div class="row">
                            <div class="col align-self-center">
                                <div class="spinner-grow" role="status" style="color:orange;">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                `;
                
                $.ajax({
                    type: "GET",
                    url: routeURL,
                    dataType: 'json',
                    success: function(data){
                        if(data[0].type == 'html'){
                            console.log(routeUpdate);
                            control.innerHTML = `
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <a href="/teacher/course/content/topic/content/${data[0].topic_content_id}/delete"><button type="button" id="topicUpdate" class="btn" style="background-color:orange;color: white;">Delete Topic Content</button></a>
                                            </div>
                            `;
                            view.innerHTML = `<div class="text-content">
                                                    <div class="col-auto">
                                                        <form id="myForm" action="/teacher/course/content/topic/content/${data[0].topic_content_id}/update" method="post">
                                                            <div class="card-body">
                                                                    {{csrf_field()}}
                                                                        <div class="mb-3">
                                                                            <label for="recipient-name" class="col-form-label">Topic Title</label>
                                                                            <input type="text" name="topic_content_title" class="form-control" id="topic_content_title" value="${data[0].topic_content_title}">
                                                                            <input type="text" name="type" class="form-control" id="type" value="html" hidden>
                                                                            <input type="text" name="topic_id" class="form-control" id="topic_id" value="${data[0].topic_id}" hidden>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <textarea class="form-control mt-5" name="html" class="html" id="editor" onclick="alert('Hello')" rows="20"></textarea>
                                                                        </div>
                                                            </div>
                                                            <br>
                                                            <div class="modal-footer">  
                                                                <button type="submit" id="update" class="btn btn" style="background-color:orange;color: white;">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <br><br>
                                                </div>

                                                `;
                                                $("#editor").val(data[0].html);
                                        // $("#editor").change(function handleChange(event) {
                                        //     console.log(event.target);
                                        //         var editor = this.value;
                                        //         console.log(editor);
                                        //     console.log(event.target.value);
                                        // });

                                        
                                            // $("myForm").submit(function (event) {

                                            //     var formData = {
                                            //         topic_id: $('#topic_id').val(),
                                            //         topic_content_id: $('#topic_content_title').val(),
                                            //         topic_content_title: $('#type').val(),
                                            //         type: $(".html").val(),
                                            //     };

                                            //     $.ajax({
                                            //     type: "POST",
                                            //     url: routeUpdate,
                                            //     data: formData,
                                            //     dataType: 'json',
                                            //     success: function(response){
                                            //         alert('Update done.');
                                            //         console.log(response);
                                            //     },
                                            //     error: function(data){
                                            //         console.log(data);
                                            //     },

                                            // });

                                        // $("#update").click(function(e){
                                        //     const form = getElementById('myForm');

                                        //     $('#myForm').submit(function() {
                                        //         // get all the inputs into an array.
                                        //         var $inputs = $('#myForm :input');

                                        //         // not sure if you wanted this, but I thought I'd add it.
                                        //         // get an associative array of just the values.
                                        //         var values = {};
                                        //         $inputs.each(function() {
                                        //             values[this.name] = $(this).val();
                                        //             console.log(values[this.name]);
                                        //         });
                                                
                                        //     });
                                        // });
                                        // $("#update").click(function(e){
                                        //     $.ajaxSetup({
                                        //         headers: {
                                        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                        //         }
                                        //     });
                                            
                                                
                                        //     $.ajax({
                                        //         type: "post",
                                        //         url: routeUpdate,
                                        //         data:{
                                        //             topic_id: topicId, 
                                        //             topic_content_id: contentId, 
                                        //             topic_content_title: topicContentTitle,
                                        //             type: type, 
                                        //             html: editor,
                                        //         },
                                        //         dataType: 'json',
                                        //         success: function(response){
                                        //             alert('Update done.');
                                        //             console.log(response);
                                        //         },
                                        //         error: function(data){
                                        //             console.log(data);
                                        //         }
                                        //     });
                                        //     event.preventDefault();
                                        // });

                                        ClassicEditor
                                            .create( document.querySelector( '#editor' ) )
                                            .then( editor => {
                                                console.log( editor );
                                            } )
                                                
                                            .catch( error => {
                                                console.error( error );
                                            } );
                                    
                        }
                        else if(data[0].type == 'quiz'){ //ok

                            var route = "{{route('quiz.edit', [":courseid" ,":id"])}}";
                            route = route.replace(':courseid', "{{request()->route('courseid')}}");
                            route = route.replace(':id', data[0].quiz_link); 

                            control.innerHTML = `
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <a href="/teacher/course/content/topic/content/${data[0].topic_content_id}/delete"><button type="button" id="topicUpdate" class="btn" style="background-color:orange; color: white;">Delete Topic Content</button></a>
                                            </div>
                            `;

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
                                    <a href="${route}"><button type="submit" class="btn btn" style="background-color:orange; color: white;">Go to Quiz</button></a>
                                    </div>
                                </div>
                            </div>
                            `;

                            
                        }
                        else{
                            control.innerHTML = `
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <a href="/teacher/course/content/topic/content/${data[0].topic_content_id}/delete"><button type="button" id="topicUpdate" class="btn" style="background-color:orange; color: white;">Delete Topic Content</button></a>
                                            </div>
                            `;
                            view.style.overflow = "scroll";
                            view.innerHTML = `
                            <div class="container text-center" >
                                <embed src="${data[1]}" height="700" width="940"/>
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
            
            $("#first").click(function(){
            $("#panel").toggle(200);
            
        });
        
        var i;
        const coll = document.getElementsByClassName("collapsible");
        const topic = document.getElementsByClassName("topic");
        for (i = 0; i < coll.length; i++) {
            $(coll[i]).click(function(){
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
                control.innerHTML =``;
                view.innerHTML = ``;
                view.innerHTML = `
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button 
                                            type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#topicCreate{{request()->route('contentid')}}">Add Topic
                                        </button>
                                    </div>
                                    <h2 style="margin-left:20px;"> ${this.value} ${contentid}</h2>
                                    <hr>
                `;
                view.style.overflow = "hidden";
                

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
                topicDescription= this.getAttribute("data-description");
                state = 'http://{{Request::getHttpHost()}}/teacher/course/' + '{{request()->route('courseid')}}/topic/' + topicId;
                if('{{Request::url()}}' !== state)
                {
                    // history.replaceState(null, null, state);
                    // location.reload();
                    
                }
        
                view.style.overflow = "hidden";
                view.innerHTML = ``;
                control.innerHTML = ``;
                view.innerHTML = `
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button 
                                            type="button" id="topicUpdate" class="create-button" data-bs-toggle="modal" 
                                            data-bs-whatever="@fat" data-bs-target="#topicUpdateModal">Edit topic
                                        </button>
                                            
                                        <button 
                                                type="button" id="topicChoices" class="create-button btn-sm dropdown-toggle" 
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="10,20">Add Resource
                                        </button>
                                        <div class="btn-group">
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" id="html-choice-button" href="#" data-bs-target="#html-create" data-bs-toggle="modal" data-bs-dismiss="modal">HTML Document</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" id="file-choice-button" href="#" data-bs-target="#file-create" data-bs-toggle="modal" data-bs-dismiss="modal">File</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" id="quiz-choice-button" href="#" data-bs-target="#quiz-link" data-bs-toggle="modal" data-bs-dismiss="modal">Quiz</a>
                                                </li>
                                                
                                            </ul>
                                        </div>

                                    </div>
                                    <h2 style="margin-left:20px;">${topicTitle} ${topicId}</h2>
                                    <hr>
                `;

                // update topic modal
                $('#topicUpdate').click(function(e){
                    $("#topic_id").val(topicId);
                    $("#topic_title").val(topicTitle);
                    $("#topic_description").text(topicDescription);
                });

                // assigning of topic id to adding of resources
                $('#html-choice-button').click(function(e){
                    $("#html_topic_id").val(topicId);
                });
                $('#file-choice-button').click(function(e){
                    $("#file_topic_id").val(topicId);
                });

                // get all course quizzes for quiz display
                $(document).ready(function () {
                    $('#quiz-choice-button').click(function(e){
                        var getQuizRoute = "{{ route('quiz.all', ":courseid") }}";
                        getQuizRoute = getQuizRoute.replace(':courseid', '{{request()->route('courseid')}}');
                            $.ajax({
                                    type: "GET",
                                    url: getQuizRoute,
                                    dataType: 'json',
                                    success: function(data){
                                        console.log(data);
                                        var listQuizzes = document.getElementById("list-quizzes");
                                        listQuizzes.innerHTML = ``;
                                        var a;
                                        for(a=0;a<data.length; a++){
                                            listQuizzes.innerHTML += `
                                            <form action="{{route('topicContent.create')}}" method="post">
                                            {{ csrf_field() }}
                                                    <div>
                                                        <input type="text" class="form-control" name="type" id="recipient-name" value="quiz" hidden>
                                                        <input type="text" name="topic_content_title" class="form-control" value="${data[a].quiz_title}" hidden>
                                                        <input type="text" name="quiz_link" class="form-control" value="${data[a].quiz_id}" hidden>
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

        ClassicEditor
        .create( document.querySelector( '#editor1' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
@stop