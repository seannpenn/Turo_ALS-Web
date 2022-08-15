@extends('main')

@section('css-style')
    .layout{
        margin: 20px auto;
        padding: 20px;
        width: 500px;
        justify-content:center;
    }
    .quiz{
        text-align:center;
        justfiy-content:center;
    }
    .quiz-select{
        margin: 10px;
        background-color: white;
        color: orange;
        cursor: pointer;
        padding: 5px;
        width: 400px;
        text-align: left;
        outline: none;
        font-size: 25px;
        border: 1px solid orange;
        border-radius: 5px;
    }
    .quiz-select:hover{
        background-color: lightgray;
    }
@stop


@section('main-content')
    <div class="layout">
        <h2>Quizzes</h2>
        @if($quizCollection->count() != 0)
            <div class="quiz">
                <form action="{{route('topicContent.create')}}" method="post">
                {{ csrf_field() }}
                    @foreach($quizCollection as $quiz)
                        <input type="text" class="form-control" name="type" id="recipient-name" value="quiz" hidden>
                        <input type="text" name="topic_id" class="form-control" value="{{$topic_id}}" hidden>
                        <input type="text" name="topic_content_title" class="form-control" value="{{$quiz->quiz_title}}" hidden>
                        <input type="text" name="link" class="form-control" value="{{ $quiz->quiz_id }}" hidden>
                        <button type="submit" class="quiz-select">
                            {{ $quiz->quiz_id }}
                            {{ $quiz->quiz_title }}
                        </button>
                    @endforeach
                </form>
            </div>
        @else
            <h2>No created quizes..</h2>
        @endif
    </div>
@stop