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
                
<div class="d-inline p-2 text-bg-dark align-items-center">
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
        var routeURL = '{{Request::getRequestUri()}}' + '/view/' + contentId;
        e.preventDefault();
        
        $.ajax({
            type: "GET",
            url: routeURL,
            dataType: 'json',
            
            success: function(data){
                if(data[0].type == 'html'){
                    view.innerHTML = `<h1> ${data[0].topic_content_title} </h1><hr>`;
                    view.innerHTML += `<div class="text-content">
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
                }

                else if(data[0].type == 'quiz'){
                    view.innerHTML = `<h1> ${data[0].topic_content_title} </h1><hr>`;
                    view.innerHTML += `<div class="container text-center" style=" margin: 200px auto;">
                    <div class="row">
                        <div class="col align-self-center">
                            <h1>View and edit this quiz in the quiz tab</h1>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col align-self-center">
                            <a href=""><button type="submit" class="btn btn-warning">Go to Quiz</button></a>
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
        
        view.innerHTML = `<h2 style="margin-left:20px;"> ${this.value}</h2>
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

for (z = 0; z < topic.length; z++) {
    topic[z].addEventListener("click", function() {
        dataValue = this.getAttribute("data-value");
        
        view.innerHTML = `<h2 style="margin-left:20px;"> ${this.value}</h2>
        <hr>
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