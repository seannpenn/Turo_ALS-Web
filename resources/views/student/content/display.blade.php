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
        background-color: orange;
        color: white;
        cursor: pointer;
        padding: 5px;
        width: 280px;
        text-align: center;
        outline: none;
        font-size: 15px;
        border: 1px solid orange;
        height: 70px;
        <!-- border-radius: 5px; -->
        
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
@include('navbar/navbar_inside', ['courseId' => request()->route('courseid'), 'topiccontentid' => request()->route('topiccontentid')])
<div class="d-flex justify-content-center" style="margin-top: 30px;">
    <div class="d-flex flex-row mb-3" style="max-height: 730px; width: 350px; overflow-y: scroll;">
        <div class="w-100 p-3">
            <table>
            @foreach($courseCollection as $course)
            @section('course_id')
            {{$course->course_id}}
            @stop
            @foreach($course->coursecontent as $module)

            <tr>
                <button type="button" class="collapsible" content-title="{{$module->content_title}}" value="{{$module->content_id}}">
                    <b>{{$module->content_title}}</b>
                </button>
            </tr>
            
            <tr>
                <div class="content">
                    @foreach($module->topic as $topic)
                    
                    <div class="topic" topic-id="{{$topic->topic_id}}" topic-title="{{$topic->topic_title}}" onclick="getTopicId({{$topic->topic_id}})">
                        <label for="">
                            {{$topic->topic_title}}
                        </label>
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
                
<div class="d-inline p-2 text-bg align-items-center">
    <div class="control-area" id="control-area">
        {{request()->route('id')}}
    </div>
    
    <div class="view-topic" id="view-topic"></div>
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
        var getTopicContent = '/student/course/' + "{{request()->route('courseid')}}" +  '/topiccontent/'+ contentId;
        e.preventDefault();
        
        $.ajax({
            type: "GET",
            url: getTopicContent,
            dataType: 'json',
            
            success: function(data){
                if(data[0].type == 'html'){
                    view.innerHTML = `<h1> ${data[0].topic_content_title} </h1><hr>`;
                    view.innerHTML += `<div class="text-content">
                    <div class="col-auto">
                            <div class="card-body">
                                <br>
                                <div class="form-group">
                                    ${data[0].html}
                                </div>
                            </div>
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
                }

                else if(data[0].type == 'quiz'){
                    view.innerHTML = `<h1> ${data[0].topic_content_title} </h1><hr>`;
                    view.innerHTML += `<div class="container text-center" style=" margin: 200px auto;">
                    <div class="row">
                        <div class="col align-self-center">
                            <h1>View this quiz in the quiz tab</h1>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col align-self-center">
                            <button id="goToQuiz" type="submit" class="btn btn-warning">Go to Quiz</button>
                        </div>
                    </div>
                    `;
                    $('#goToQuiz').click(function(){
                        var quizId = data[0].link;
                        var goToQuizRoute = '/student/course/' + "{{request()->route('courseid')}}" +  '/quiz/'+ quizId;
                        window.location.href = goToQuizRoute;
                    });

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
                            <embed src="${asset}" height="700" width="940"/>
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

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            const contentTitle = this.getAttribute("content-title");
            
            view.innerHTML = `<h2 style="margin-left:20px;"> ${contentTitle}</h2>
            <hr>
            `;
            
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            
            if (content.style.display === "block") {
                content.style.display = "none";
            } 
            else {
                content.style.display = "block";
            }
        });
    }

    const topic = document.getElementsByClassName("topic");
    for (z = 0; z < topic.length; z++) {
        topic[z].addEventListener("click", function() {
            topicId = this.getAttribute("topic-id");
            topicTitle = this.getAttribute("topic-title");
            view.innerHTML = `<h2 style="margin-left:20px;"> ${topicId}</h2>
            <hr><br><br>
            `;
            view.innerHTML += `<h2 style="margin-left:20px;"> ${topicTitle}</h2>
            `;
            
            var topiccontent = this.nextElementSibling;
            if (topiccontent.style.display === "block") {
                topiccontent.style.display = "none";
            } 
            else {
                topiccontent.style.display = "block";
            }
        });
    }
</script>
@stop