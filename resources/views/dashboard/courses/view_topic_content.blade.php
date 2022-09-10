@extends('content_view_layout')

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
<!-- <a href="{{route('course.showInfo', $selectedTopicContent->topic_id)}}">< Back to module</a> -->
    <div class="layout">
        @if($selectedTopicContent->type == 'quiz')
            
            <div class="topic-content">
                <h1>View and edit this quiz in the quiz tab</h1>
                    
                <div class="col-auto">
                    <a href="{{ route('quiz.edit', $selectedTopicContent->link) }}"><button type="submit" class="btn btn-primary">Go to Quiz</button></a>
                </div>
            </div>
            
            
        @elseif ($selectedTopicContent->type == 'html')
            <div class="text-content">
                <div class="col-auto">
                <div class="card-body">
                <form method="post" action="{{route('topicContent.update', $selectedTopicContent->topic_content_id)}}" >
                {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Topic Title</label>
                        <input type="text" name="topic_content_title" class="form-control" id="recipient-name" value="{{$selectedTopicContent->topic_content_title}}">
                        <input type="text" name="type" class="form-control" id="recipient-name" value="html" hidden>
                        <input type="text" name="topic_id" class="form-control" id="recipient-name" value="{{$selectedTopicContent->topic_id}}" hidden>
                    </div>
                        <div class="form-group">
                            <textarea class="form-control mt-5" name="html" id="editor" rows="20" >{!! $selectedTopicContent->html !!}</textarea>
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
                <embed src="{{ asset('storage/files/'.$selectedTopicContent->file) }}" height="750" width="1500" />
            </div>
        @endif
    </div>
@stop