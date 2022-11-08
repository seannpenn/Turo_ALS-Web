@extends('main')

@section('css-style')
    .layout{
        max-width: 1200px;
        margin: 0 auto;
    }
    .container{
        max-width: 1500px;
    }
@stop

@section('main-content')
@include('navbar/navbar_inside', ['courseId' => request()->route('courseid'), 'topiccontentid' => request()->route('topiccontentid')])
    <div class="layout">
        <div class="col align-self-center">
            <div class="container text-center p-4 rounded" style="width: 600px;">
                <h1>Quiz Result</h1>
                <!-- {{$QuizAnswers}} -->
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                {{$chosenQuiz->quiz_title}}
                            </div>
                            <div class="col-md-6">
                                @foreach($chosenQuiz->quizAttempt as $attempt)
                                    <h6 style="float: right;">
                                        <span class="badge text-bg-success" >
                                            Score : {{$attempt->quizSummary->total_score}} point/s
                                        </span>
                                    </h6>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                            @foreach($quizAttempt->quiz->question as $index => $question)
                                        <div class="card mb-3">
                                            <div class="card ">
                                                <div class="card-header">{{$index+1}}.) {{  $question->question }}  
                                                <div class="float-end">{{$question->points}} point/s</div>
                                                    
                                                    
                                                </div>
                                                <div class="card-body">
                                                    @foreach($question->option as $option)
                                                            <div class="form-check">
                                                                @if($question->type != 2)
                                                                    @if($question->type == 1)
                                                                        @foreach($question->answer as $answer)
                                                                            @if($answer->option_id == $option->option_id)
                                                                                @if($answer->isCorrect)
                                                                                    <div class="alert-warning" style="background-color: lightgreen;">
                                                                                        <input class="form-check-input" type="radio" checked disabled>
                                                                                        <label class="form-check-label" for="{{$question->question_id}}">
                                                                                            {{ $option->option }} 
                                                                                        </label>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="alert-warning" style="background-color: #FFCCCB;">
                                                                                        <input class="form-check-input" type="radio" checked disabled>
                                                                                        <label class="form-check-label" for="{{$question->question_id}}">
                                                                                            {{ $option->option }} 
                                                                                        </label>
                                                                                    </div>
                                                                                @endif
                                                                            @else
                                                                                @if($option->isCorrect)
                                                                                    <div class="alert-warning" style="background-color: lightgreen;">
                                                                                        <input class="form-check-input" type="radio" disabled>
                                                                                        <label class="form-check-label" for="{{$question->question_id}}">
                                                                                            {{ $option->option }} 
                                                                                        </label>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="alert-warning">
                                                                                        <input class="form-check-input" type="radio" disabled>
                                                                                        <label class="form-check-label" for="{{$question->question_id}}">
                                                                                            {{ $option->option }} 
                                                                                        </label>
                                                                                    </div>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    @elseif($question->type == 3)

                                                                        @foreach($question->answer as $answer)
                                                                            @if($answer->option_id == $option->option_id)
                                                                                @if($answer->isCorrect)
                                                                                    <div class="alert-warning" style="background-color: lightgreen;">
                                                                                        <input class="form-check-input" type="checkbox" checked disabled>
                                                                                        <label class="form-check-label" for="{{$question->question_id}}">
                                                                                            {{ $option->option }} 
                                                                                        </label>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="alert-warning" style="background-color: #FFCCCB;">
                                                                                        <input class="form-check-input" type="checkbox" checked disabled>
                                                                                        <label class="form-check-label" for="{{$question->question_id}}">
                                                                                            {{ $option->option }} 
                                                                                        </label>
                                                                                    </div>
                                                                                @endif
                                                                            @else
                                                                                @if($option->isCorrect)
                                                                                    <div class="alert-warning" style="background-color: lightgreen;">
                                                                                        <input class="form-check-input" type="checkbox" disabled>
                                                                                        <label class="form-check-label" for="{{$question->question_id}}">
                                                                                            {{ $option->option }} 
                                                                                        </label>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="alert-warning">
                                                                                        <input class="form-check-input" type="checkbox" disabled>
                                                                                        <label class="form-check-label" for="{{$question->question_id}}">
                                                                                            {{ $option->option }} 
                                                                                        </label>
                                                                                    </div>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        <textarea class="form-control" placeholder="Enter your answer here..." id="floatingTextarea" rows="4" disabled>{{$option->answerbyQuestion->textAnswer}}</textarea>                                                                
                                                                    @endif
                                                                @else
                                                                    <input type="text" class="form-control option" id="option" placeholder="Question" aria-label="Question"  value="{{$option->answerbyQuestion->textAnswer}}">
                                                                @endif
                                                            </div>
                                                    @endforeach
                                                </div>
                                                
                                                <div class="card-footer">
                                                @foreach($question->answer as $answer)
                                                    @if($answer->isCorrect || $answer->option_id == null)
                                                        @if($answer->option_id == null)
                                                            @foreach($correctAnswers as $correctanswer)
                                                                @if($answer->textAnswer == $correctanswer)
                                                                <span class="input-group-text" style="color:green; background-color:transparent;border-style: hidden;">
                                                                    <img src="{{ asset('images/correct.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                    <div class="fw-bolder">You got the correct answer.</div>
                                                                    
                                                                </span>
                                                                @endif
                                                                @break
                                                            @endforeach
                                                            @if($question->type == 2)
                                                                <div class="fw-bolder">Other possible answers: </div>
                                                                
                                                                @foreach($correctAnswers as $correctanswer)
                                                                    @if($option->answerbyQuestion->textAnswer != $correctanswer)
                                                                        {{$correctanswer}}, 
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                            @if($question->type == 4)
                                                            
                                                            <span class="input-group-text" style="color:orange; background-color:transparent;border-style: hidden;">
                                                                <img src="{{ asset('images/pending.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                <div class="fw-bolder">Your answer is to be reviewed.</div>
                                                            </span>
                                                                
                                                            @endif
                                                        @else
                                                            <span class="input-group-text" style="color:green; background-color:transparent;border-style: hidden;">
                                                                <img src="{{ asset('images/correct.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                <div class="fw-bolder">You got the correct answer.</div>
                                                                
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="input-group-text" style="color:red; background-color:transparent;border-style: hidden;">
                                                            <img src="{{ asset('images/wrong.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                            <div class="fw-bolder">You got the wrong answer.</div>
                                                            
                                                        </span>
                                                            <div class="fw-bolder">Correct answer is:</div>
                                                            @foreach($question->option as $option)
                                                                @if($option->isCorrect == 1)
                                                                     {{$option->option }}
                                                                @endif
                                                            @endforeach
                                                    @endif
                                                @endforeach
                                                </div>
                                            </div>
                                        </div>
                            @endforeach

                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <a href="{{ route('student.viewQuiz',[request()->route('courseid'), request()->route('quizid')])}}">
                                        <button type="button" class="btn btn" style="background-color: orange;">
                                            Return
                                        </button>
                                    </a>
                                    
                                </div>
                                
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection