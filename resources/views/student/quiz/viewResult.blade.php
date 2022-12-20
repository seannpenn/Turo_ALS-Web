@extends('main')

@section('css-style')
    .breadHeader{
        padding-top: 50px;
        padding-left: 50px;
    }
    .layout{
        max-width: 1200px;
        margin: 0 auto;
    }
    .container{
        max-width: 1500px;
    }
    .content {
        padding: 15px;
        display: none;
        overflow: hidden;
        background-color: #f1f1f1;
        transition:height 0.3s ease-in-out;
        transition-delay: 0.1s;
    }
    .attemptButton {
        cursor: pointer;
        padding: 18px;
        width: 100%;
        text-align: left;
        outline: none;
        border-color: orange;
        font-size: 15px;
        height: 80px;
        margin-bottom: 2px;
    }
    .attemptButton:after {
        content: '\002B';
        width: 20px;
        height: 20px;
        color: black;
        font-weight: bold;
        float: right;
        margin-left: 5px;
    }

    .active:after {
        content: "\2212";
    }
@stop

@section('main-content')
@include('navbar/navbar_inside', ['courseId' => request()->route('courseid'), 'topiccontentid' => request()->route('topiccontentid')])
    <nav aria-label="breadcrumb" class="breadHeader">
        <ol class="breadcrumb" style="background-color:white;">
            <li class="breadcrumb-item"><a href="{{ route('student.viewQuiz', [request()->route('courseid'), $chosenQuiz->quiz_id])}}">{{ $chosenQuiz->quiz_title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">My result</li>
        </ol>
    </nav>
    <div class="layout">
        <div class="col align-self-center">
            <div class="container p-4 rounded">
                    @if($chosenQuiz->quizAttempt->count() != 0 && $chosenQuiz->releaseGrades == 1)
                        <table class="table table table-bordered" style="width: 100%;">
                            <tr class="bg-light">
                                <th scope="col" class="text-left">Attempt ID</th>
                                <th scope="col" class="text-left">Attempt</th>
                                <th scope="col" class="text-center">Attempt date </th>
                            <tbody >
                            @foreach($chosenQuiz->quizAttempt as $index => $attempt)
                        
                                    <tr style="border-bottom: 2px solid black;">
                                        <td width="10%" class="text-start p-3">
                                                <p>{{ $attempt->attempt_id }}</p>
                                        </td>
                                        <td width="80%">
                                            <button type="button" class="btn btn-outline-warning attemptButton"  style="border-radius: 0;">Attempt {{$index+1}}</button>
                                            <div class="content">
                                                <div class="container">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-10">
                                                            <div class="card" style="margin-bottom: 50px;">
                                                                <div class="card-header">
                                                                    <div class="form-group row mb-0">
                                                                        <div class="col-md-6">
                                                                           Attempt {{$index + 1}}
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            
                                                                                <h6 style="float: right;">
                                                                                    <span class="badge text-bg-success" >
                                                                                        Score : {{$attempt->quizSummary->total_score}} point/s
                                                                                    </span>
                                                                                </h6>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                        @foreach($attempt->quiz->question as $index => $question)
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
                                            
                                                                                                                    @if($option->isCorrect)
                                                                                                                        <div class="alert-warning" style="background-color: lightgreen;">
                                                                                                                            <input class="form-check-input" type="radio" disabled
                                                                                                                            
                                                                                                                            @foreach($attempt->quizAnswer as $answer)
                                                                                                                                @if($answer->option_id == $option->option_id)
                                                                                                                                    checked
                                                                                                                                @endif
                                                                                                                            @endforeach
                                                                                                                            
                                                                                                                            >
                                                                                                                            <label class="form-check-label" for="{{$question->question_id}}">
                                                                                                                                {{ $option->option }} 
                                                                                                                            </label>
                                                                                                                        </div>
                                                                                                                    @else
                                                                                                                        <div class="alert-warning" style="background-color: #FFCCCB;">
                                                                                                                            <input class="form-check-input" type="radio" disabled
                                                                                                                            
                                                                                                                            @foreach($attempt->quizAnswer as $answer)
                                                                                                                                @if($answer->option_id == $option->option_id)
                                                                                                                                    checked
                                                                                                                                @endif
                                                                                                                            @endforeach
                                                                                                                            
                                                                                                                            >
                                                                                                                            <label class="form-check-label" for="{{$question->question_id}}">
                                                                                                                                {{ $option->option }} 
                                                                                                                            </label>
                                                                                                                        </div>
                                                                                                                    @endif
                                                                                                                @elseif($question->type == 3)
                                            
                                                                                                                    @if($option->isCorrect)
                                                                                                                        <div class="alert-warning" style="background-color: lightgreen;">
                                                                                                                            <input class="form-check-input" type="checkbox" 
                                                                                                                                @foreach($attempt->quizAnswer as $answer)
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
                                                                                                                        <div class="alert-warning"
                                                                                                                        @foreach($attempt->quizAnswer as $answer)
                                                                                                                            @if($answer->option_id == $option->option_id)
                                                                                                                                style="background-color: #FFCCCB;"
                                                                                                                            @else
                                                                                                                                
                                                                                                                            @endif
                                                                                                                        @endforeach
                                                                                                                        >
                                                                                                                            <input class="form-check-input" type="checkbox" disabled
                                                                                                                            
                                                                                                                            @foreach($attempt->quizAnswer as $answer)
                                                                                                                                @if($answer->option_id == $option->option_id)
                                                                                                                                    checked
                                                                                                                                @endif
                                                                                                                            @endforeach
                                                                                                                            
                                                                                                                            >
                                                                                                                            <label class="form-check-label" for="{{$question->question_id}}">
                                                                                                                                {{ $option->option }} 
                                                                                                                            </label>
                                                                                                                        </div>
                                                                                                                    @endif
                                            
                                                                                                                        
                                                                                                                    
                                                                                                                @else
                                                                                                                    @foreach($attempt->quizAnswer as $answer)
                                                                                                                        @if($answer->question_id == $option->question_id)
                                                                                                                            <textarea class="form-control" placeholder="Enter your answer here..." id="floatingTextarea" rows="4" disabled>{{$answer->textAnswer}}</textarea>                                                                
                                                                                                                        @endif
                                                                                                                    @endforeach
                                                                                                                @endif
                                                                                                            @else
                                                                                                                @foreach($attempt->quizAnswer as $answer)
                                                                                                                    @if($answer->question_id == $option->question_id)
                                                                                                                        <input type="text" class="form-control option" id="option" placeholder="Question" aria-label="Question"  value="{{$answer->textAnswer}}">
                                                                                                                    @endif
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                        </div>
                                                                                                @endforeach
                                                                                            </div>
                                                                                            
                                                                                            <div class="card-footer">
                                                                                                @php
                                                                                                    $noAnswer = 0;
                                                                                                    $incorrectAnswer = 0;
                                                                                                    $answerCorrect = 0;
                                                                                                    $optionCorrect = 0;
                                                                                                @endphp
                                            
                                                                                                @if($question->type == 3)
                                                                                                    @foreach($attempt->quizAnswer as $key => $answer)
                                                                                                        @if($answer->question_id == $option->question_id)
                                                                                                            @if($answer->isCorrect)
                                                                                                                @php $answerCorrect++; @endphp
                                                                                                            @else
                                                                                                                @php $incorrectAnswer++; @endphp
                                                                                                            @endif
                                                                                                                
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                    @foreach($attempt->quiz->question as $index => $question)
                                                                                                        @foreach($question->option as $option)
                                            
                                                                                                            @if($option->isCorrect && $question->type == 3)
                                                                                                                @php $optionCorrect++; @endphp
                                                                                                            @endif
                                                                                                            
                                                                                                        @endforeach
                                                                                                    @endforeach
                                                                                                    {{ $answerCorrect }} {{ $optionCorrect }}
                                                                                                    @if($optionCorrect == $answerCorrect && $incorrectAnswer == 0)
                                            
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
                                                                                                                @foreach($attempt->quiz->question as $index => $question)
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
                                                                                                @php
                                                                                                    $matchedAnswers = 0;
                                                                                                @endphp
                                                                                                    @foreach($attempt->quizAnswer as $key => $answer)
                                                                                                        @foreach($correctAnswers as $correctanswer)
                                                                                                            @if($answer->question_id == $question->question_id)
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
                                                                                                                    @break
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    @endforeach
                                                                                                    
                                            
                                                                                                @elseif($question->type == 1)
                                                                                                            @foreach($attempt->quizAnswer as $key => $answer)
                                                                                                                @if($answer->question_id == $option->question_id)
                                                                                                                    @if($answer->isCorrect)
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
                                            </div>
                                        </td>
                                        <td width="10%" class="text-center p-3">
                                            date
                                        </td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @elseif($chosenQuiz->quizAttempt->count() != 0 && $chosenQuiz->releaseGrades != 1)
                        <h2 class="text-center">Results are not yet released.</h2>
                    @else
                        <h2>No attempts.</h2>
                    @endif
                </div>
            </div>
    </div>
    

    {{-- @foreach($chosenQuiz->quizAttempt as $index => $attempt) --}}
    <script>
        var coll = document.getElementsByClassName("attemptButton");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
            });
        }
    </script>
@endsection