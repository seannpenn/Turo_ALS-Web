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
                                                <div class="card-header" style="background-color: orange; color:white;">{{$index+1}}.) {{  $question->question }}  
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

                                                                            <div class="alert-warning" 
                                                                                
                                                                                @foreach($question->answer as $answer)
                                                                                    @if($option->isCorrect)
                                                                                        style="background-color: lightgreen;"
                                                                                    @endif
                                                                                    @if($answer->option_id == $option->option_id && $answer->isCorrect)
                                                                                        style="background-color: lightgreen;"
                                                                                    @endif
                                                                                    @if($answer->option_id == $option->option_id && !$answer->isCorrect)
                                                                                        style="background-color: red;"
                                                                                    @endif
                                                                                @endforeach
                                                                            >
                                                                                <input class="form-check-input" type="checkbox"
                                                                                    @foreach($question->answer as $answer)
                                                                                        @if($answer->option_id == $option->option_id)
                                                                                            checked
                                                                                        @endif
                                                                                    @endforeach
                                                                                 disabled>
                                                                                <label class="form-check-label" for="{{$question->question_id}}">
                                                                                    {{ $option->option }} 
                                                                                </label>
                                                                            </div>
                                                                        
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
                                                @php
                                                    $noAnswer = 0;
                                                    $answerCorrect = 0;
                                                    $optionCorrect = 0;
                                                @endphp

                                                @if($question->type == 3)
                                                    @foreach($quizAttempt->quiz->question as $index => $question)
                                                        @foreach($question->option as $option)

                                                            @if($option->isCorrect && $question->type == 3)
                                                                @php $optionCorrect++; @endphp
                                                            @endif
                                                            
                                                            @foreach($question->answer as $answer)
                                                                @if($option->option_id == $answer->option_id)
                                                                    @if($answer->isCorrect)
                                                                        @php $answerCorrect++; @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach

                                                        @endforeach
                                                    @endforeach
                                                    @if($optionCorrect == $answerCorrect)
                                                        <span class="input-group-text" style="color:green; background-color:transparent;border-style: hidden;">
                                                            <img src="{{ asset('images/correct.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                            <div class="fw-bolder">You got the correct answer.</div>
                                                                
                                                        </span>
                                                    @else
                                                        <span class="input-group-text" style="color:red; background-color:transparent;border-style: hidden;">
                                                            <img src="{{ asset('images/wrong.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                            <div class="fw-bolder">You got the wrong answer.</div>
                                                        </span>

                                                        <div class="fw-bolder">Correct answer is:</div>
                                                                @foreach($quizAttempt->quiz->question as $index => $question)
                                                                    @if($question->type == 3)
                                                                        @foreach($question->option as $option)
                                                                            @if($option->isCorrect)
                                                                                {{$option->option }}
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                    @endif

                                                @elseif($question->type == 2)
                                                
                                                    @foreach($correctAnswers as $correctanswer)
                                                        @if($answer->textAnswer == $correctanswer)
                                                            <span class="input-group-text" style="color:green; background-color:transparent;border-style: hidden;">
                                                                <img src="{{ asset('images/correct.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                <div class="fw-bolder">You got the correct answer.</div>
                                                            </span>
                                                            @break
                                                        @else
                                                            <span class="input-group-text" style="color:red; background-color:transparent;border-style: hidden;">
                                                                <img src="{{ asset('images/wrong.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                <div class="fw-bolder">You got the wrong answer.</div>
                                                            </span>

                                                            <div class="fw-bolder">Correct answer/s: </div>
                                                            @foreach($correctAnswers as $correctanswer)
                                                                @if($option->answerbyQuestion->textAnswer != $correctanswer)
                                                                    {{$correctanswer}}, 
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        
                                                    @endforeach

                                                @elseif($question->type == 1)
                                                    @foreach($quizAttempt->quiz->question as $index => $question)
                                                        @foreach($question->option as $option)
                                                            @if($option->answer)
                                                                @if($option->answer->isCorrect)
                                                                    <span class="input-group-text" style="color:green; background-color:transparent;border-style: hidden;">
                                                                        <img src="{{ asset('images/correct.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                        <div class="fw-bolder">You got the correct answer.</div>
                                                                    </span>
                                                                @else
                                                                    <span class="input-group-text" style="color:red; background-color:transparent;border-style: hidden;">
                                                                        <img src="{{ asset('images/wrong.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                        <div class="fw-bolder">You got the wrong answer.</div>
                                                                    </span>
                                                                @endif
                                                                
                                                            @endif
                                                            @break
                                                        @endforeach
                                                    @endforeach
                                                @endif


                                                
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

<!-- @foreach($question->answer as $answer)
                                                    @if($answer->option_id == null)
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
                                                                @if($answer->points == null)
                                                                    <span class="input-group-text" style="color:orange; background-color:transparent;border-style: hidden;">
                                                                        <img src="{{ asset('images/pending.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                        <div class="fw-bolder">Your answer is to be reviewed.</div>
                                                                    </span>
                                                                @else
                                                                    <span class="input-group-text" style=" background-color:transparent;border-style: hidden;">
                                                                        <img src="{{ asset('images/correct.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                        <div class="fw-bolder">
                                                                            @if($answer->points <= 1)
                                                                                Score: {{$answer->points}} point
                                                                            @else
                                                                                Score: {{$answer->points}} points
                                                                            @endif
                                                                        </div>
                                                                    </span>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @else
                                                            @if($question->type == 3)
                                                                @php
                                                                    $correctCount = 0;
                                                                    $correctAnswerCount = 0;
                                                                @endphp
                                                                @foreach($question->option as $option)
                                                                    @if($option->isCorrect)
                                                                        @php $correctCount++; @endphp
                                                                    @endif
                                                                    @if($option->answer)
                                                                        @if($option->answer->isCorrect)
                                                                            @php $correctAnswerCount++; @endphp
                                                                        @endif
                                                                    @endif
                                                                    
                                                                @endforeach
                                                                {{$correctCount}}{{$correctAnswerCount}}
                                                                @if($correctCount == $correctAnswerCount)
                                                                    <span class="input-group-text" style="color:green; background-color:transparent;border-style: hidden;">
                                                                        <img src="{{ asset('images/correct.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                        <div class="fw-bolder">You got the correct answer.</div>
                                                                    </span>
                                                                @else
                                                                    <span class="input-group-text" style="color:red; background-color:transparent;border-style: hidden;">
                                                                        <img src="{{ asset('images/correct.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                        <div class="fw-bolder">You got the wrong answer.</div>
                                                                    </span>
                                                                @endif
                                                                
                                                                <div class="fw-bolder">Correct answer is:</div>
                                                                @foreach($question->option as $option)
                                                                    @if($option->isCorrect == 1)
                                                                        {{$option->option }}
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                    @endif
                                                @endforeach -->