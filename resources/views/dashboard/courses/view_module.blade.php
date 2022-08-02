@extends('main')

@section('left-side-nav')
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('teacher.home')}}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('users.all')}}">Manage Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('users.all')}}">Profile</a>
    </li>
@stop

@section('right-side-nav')
    <a class="nav-link" style="color: black;" href="{{route('user.logout')}}">{{Auth::user()->username}}</a>
     <a class="nav-link" style="color: black;" href="{{route('user.logout')}}">Logout</a>
@stop

@section('css-style')
    img{
        height: 20px;
        width: 20px; 
    } 
    .module-header{
        padding:20px;
        display: flex;
        align-items: center;
    
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
    .module-header-form{
        height:200px;
        justify-content:center;
        width: 800px;
        display:flex;
       
    }
    .module-content{
        padding: 20px;
       width: 500px;
       overflow-y: auto;
        
    }
    .card{
        height: 100px;
    }
    
    
@stop

@section('main-content')

@include('navbar/navbar_inside')
    <a href="{{route('course.showInfo', $selectedModule[0]['course_id'])}}">
        < Back to courses
    </a>
        <div class="module-header">
            @foreach($selectedModule as $module)
                <div class="card" role="button" href="#multiCollapseExample1" style="width: 450px; height: 200px; margin: 5px;">
                    <div class="card-body">
                        <h5>{{$module['content_title']}}</h5>
                        <h9>{{$module['content_description']}}</h9>
                                                                    
                    </div>
                    <div class="action" style="margin:2px;">
                        <td class="icons"><a title="Delete Module"><img src="{{ asset('images/delete.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></a></td>
                    </div>
                </div>
            
            <div class="module-header-form">

                <form class="row gy-1 gx-4 align-items-center" action="{{route('topic.create')}}" method="post">
                {{ csrf_field() }}
                <input type="course_id" name="content_id" value="{{$module['content_id']}}" hidden>
                    <div class="col-auto">
                        <label class="visually-hidden" for="autoSizingInput">Topic Title</label>
                        <input id="titleInput" type="text" name="topic_title" class="form-control" placeholder="Topic Title">
                    </div>
                    <div class="col-auto">
                        <label class="visually-hidden" for="autoSizingInputGroup">Topic Description</label>
                        <div class="input-group">
                        <textarea type="text" name="topic_description" class="form-control" id="autoSizingInputGroup" placeholder="Topic Description"></textarea>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                        <select class="form-select" id="autoSizingSelect" name="topic_type" onchange="showInput(this)">
                        <option selected>Type</option>
                        <option value="text">Text</option>
                        <option value="file">File</option>
                        <option value="quiz">Quiz</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div id="text" class="d-none">
                        <div class="row">
                            <div class="col-md-7 offset-3 mt-4">
                                <div class="card-body">
                                    <form method="post" action="" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <textarea class="ckeditor form-control" name="wysiwyg-editor"></textarea>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="file" class="d-none" style="width: 700px;">
                        <div class="input-group">
                            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>
                    </div>
                    <div id="quiz" class="d-none" style="width: 500px; bakcground-color:yellow;">
                        <div class="form-content">
                            <form action ="{{ route('quiz.create') }}" method="post" class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Quiz title</label>
                                    <input type="text" class="form-control" name="quiz_title" id="inputEmail4">
                                </div>
                            </form>
                        </div>
                    </div>
                </form>

            </div>
            @endforeach

                
        </div>
        <br>
        <hr>
        
        <div class="module-content">
        @if(count($courseContentTopic) != 0)
            <h3>Topics</h3>
        @else
            <h3>Add Topics....</h3>
        @endif

            @foreach($courseContentTopic as $topic)
                <a href="{{route('topic.view', [$topic['content_id'], $topic['topic_id'] ])}}" style="text-decoration:none; color:black;" id="module" title="Click to view module">
                    <div class="card" role="button" style="margin:5px;" id="moduleCard" >
                        <div class="card-body">
                            <h5>{{$topic['topic_title']}}</h5>
                            <h9>{{$topic['topic_type']}}</h9>                          
                        </div> 
                        <div class="action-delete" style="margin:2px;">
                            <td class="icons"><a href="{{ route('topic.delete', [$topic['content_id'], $topic['topic_id']]  ) }}" title="Delete Topic"><img src="{{ asset('images/delete.png') }}" alt=""></a></td>
                        </div>
                    </div>
                </a>
            @endforeach
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