@extends('main')

@section('css-style')
    .layout{
        max-width: 1200px;
        margin: 0 auto;
    }
    table{
        margin: 0 auto;
    }
    img{
        height: 20px;
        width: 20px; 
    } 
@stop
@section('main-content')
@include('navbar/navbar_inside', ['courseId' => request()->route('courseid'), 'topiccontentid' => request()->route('topiccontentid')])
    <div class="layout">
        <h1>Quiz</h1>
        <div class="container text-center p-4">
            <div class="col align-self-center">
                @if($chosenQuiz->count() != 0)
                    @foreach($chosenQuiz as $quiz)
                        <h1>{{$quiz->quiz_id}}</h1>
                        <h3>{{$quiz->quiz_title}}</h3>

                        <button type="button" class="btn btn-warning">Take Quiz!</button>
                    @endforeach
                @endif
            </div>
        </div>
    </div>  
@stop