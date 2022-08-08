@extends('main')
@extends('dashboard/modals/createquiz_modal')
@extends('dashboard/modals/createtext_modal')
@extends('dashboard/modals/uploadfile_modal')
@extends('dashboard/courses/update_module_modal')

@extends('modalslug')

@section('modal-content')
    <span id="modalContent"> Are you sure you want to delete this topic?</span>
@stop
@section('content-id-quiz'){{$selectedModule[0]->content_id}}@stop
@section('content-id-file'){{$selectedModule[0]->content_id}}@stop
@section('content-id-text'){{$selectedModule[0]->content_id}}@stop


@section('css-style')
    .layout{
        padding: 20px;
    }
    img{
        height: 30px;
        width: 30px; 
    } 
    .module-header{
        margin: 0 auto;
        justify-content:center;
        text-align:center;
        padding: 20px;
        width: 1000px;
    }
    .action{
        position: absolute;
        bottom: 0px;
        right: 0px;
    }
    .action-delete{
        position: absolute;
        bottom: 0px;
        right: 0px;
    }
    .topic-form-content{
        border: 2px solid black;
        padding: 20px;
        
        width:50%;
        height: auto;
        
    }
    
    .module-content{
        margin: 0 auto;
        justify-content:center;
        width: 1000px;
    }
    .module-list{
        margin: 0 auto;
        justify-content:center;
        width: 1000px;
        height:450px;
        overflow-y: auto;
    }
    .card{
        height: 100px;
    }
    .card:hover{
        cursor:pointer;
        border-color: orange;
    }
    .upper-left-header{
        
    }
    .create-button{
        width: 150px;
        line-height:50px;
        background-color:white;
        color: orange;
        border: 2px solid orange;
        border-radius: 10px;
        margin:10px;
        
    }
    .create-button:hover{
        
        background-color:orange;
        color: white;
        
    }
    
@stop

@section('main-content')
@include('navbar/navbar_inside')

    <div class="layout">
        <a href="{{route('course.showInfo', $selectedModule[0]->course_id)}}">
            < Back to course
        </a>
        <div class="module-header">
            
            <div class="d-flex justify-content-center">
                @foreach($selectedModule as $module)
                    <div class="card" role="button" href="#multiCollapseExample1" style="width: 500px; height: 100px;">
                        <div class="card-body">
                            <h5>{{$module->content_title}}</h5>
                            <h9>{{$module->content_description}}</h9>
                                                                        
                        </div>
                        <div class="action" style="margin:2px;">
                            <td class="icons"><a title="Update Module"><img src="{{ asset('images/edit.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#moduleUpdateModal"></a></td>
                            <td class="icons"><a title="Delete Module"><img src="{{ asset('images/delete.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></a></td>
                        </div>
                    </div>
                
                    @section('module-action-update')
                        {{route('content.update', $module->course_id)}}
                    @stop
                    @section('content-title'){{$module->content_title}}@stop
                    @section('content-description'){{$module->content_description}}@stop
                
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                <div class="upper-left-header">
                    <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#quizModal" data-bs-whatever="@fat">Create Quiz</button>
                    <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#textModal" data-bs-whatever="@fat">Create Text</button>
                    <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#fileModal" data-bs-whatever="@fat">Upload file </button>

                </div>
            </div>
        </div>
        <hr>
            
        <div class="module-content">
            @if($selectedModule[0]->topic->count() != 0)
                <h3>Topics</h3>
            @else
                <h3>Add Topics....</h3>
            @endif

            <div class="module-list">
                @foreach($selectedModule[0]->topic as $topic)
                    <a href="{{route('topic.view', $topic->topic_id)}}" style="text-decoration:none; color:black;" id="module" title="Click to view topic">
                        <div class="card" role="button" style="margin:5px;" id="moduleCard" >
                            <div class="card-body">
                            
                                <h5>{{$topic->topic_title}}</h5>
                                
                                @if($topic->topic_type == 'text')
                                    <img src="{{ asset('images/text.jpg') }}">
                                @elseif($topic->topic_type == 'quiz')
                                    <img src="{{ asset('images/quiz.png') }}">
                                @else
                                    <img src="{{ asset('images/pdf.png') }}">
                                @endif                        
                            </div> 
                            <div class="action-delete" style="margin:2px;">
                                <td class="icons"><a title="Delete Topic"><img src="{{ asset('images/delete.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></a></td>
                            </div>
                        </div>
                    </a>
                    @section('script-area')
                        let confirmTask = document.getElementById('confirmTask');
                        confirmTask.addEventListener('click',()=>{
                            window.location.href = "{{route('topic.delete', $topic->topic_id)}}";
                        }); 
                    @stop
                @endforeach
            </div>
        </div>
    </div>
@stop

@section('script-area')

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
@stop