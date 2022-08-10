@extends('main')

@section('css-style')
    .layout{
        padding: 20px;
        justify-content:center;
        text-align:center;
    }
    .topic-content{
        margin-top: 320px;
        border: 1 solid;
    }
    .text-content{
        margin: 0 auto;
        justify-content: center;
        width: 1000px;
        border: 1 solid;
        text-align:left;
    }
    a{
        text-decoration: none;
        font-color: black;
    }
    
@stop

@section('main-content')
@include('navbar/navbar_inside')
<a href="{{route('content.view', $selectedTopic->content_id)}}">< Back to module</a>
    <div class="layout">
        @if($selectedTopic->topic_type == 'quiz')
            
            <div class="topic-content">
                <h1>View and edit this quiz in the quiz tab</h1>
                    
                <div class="col-auto">
                    <a href="{{ route('quiz.edit', $selectedTopic->selectedquiz->quiz_id) }}"><button type="submit" class="btn btn-primary">Go to Quiz</button></a>
                </div>
            </div>
            
            
        @elseif ($selectedTopic->topic_type == 'text')
            <div class="text-content">
                <div class="col-auto">
                <div class="card-body">
                <form method="post" action="{{route('topic.create')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Topic Title</label>
                    <input type="text" name="topic_title" class="form-control" id="recipient-name" value="{{$selectedTopic->topic_title}}">
                    <input type="text" name="content_id" class="form-control" value="@yield('content-id-text')" hidden>

                    <input type="text" name="topic_type" class="form-control" value="text" hidden>
                </div>
                    <div class="form-group">
                        <textarea class="form-control mt-5" name="text_content" id="editor" rows="20" >{!! $selectedTopic->text_content !!}</textarea>
                    </div>
                    <div class="modal-footer">  
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
                    
                </div>
            </div>

        @else
            <div class="pdf-content">
                <embed src="{{ asset('storage/files/'.$selectedTopic->file_name) }}" height="750" width="1500" />
            </div>
        @endif
    </div>
@stop