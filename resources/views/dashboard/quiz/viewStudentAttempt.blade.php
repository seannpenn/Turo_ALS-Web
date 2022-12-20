@extends('main')

<style>
    .layout{
        padding: 50px;
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
</style>

@section('main-content')
@include('navbar/navbar_inside', ['courseId' => request()->route('courseid')])
    <div class="layout">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color:white;">
                <li class="breadcrumb-item"><a href="{{ URL::previous() }}">back</a></li>
            </ol>
        </nav>
        <div class="container">
            @foreach($studentData as $key => $student)
                <h2>{{ $student->student_lname }}, {{ $student->student_fname }} {{ $student->student_mname }}</h2>
            @endforeach
            
            <table class="table table-hover table table-bordered" style="width: 100%;">
                <tbody>
                    @foreach ($quizAttempt as $index => $attempt)
                        <button type="button" class="btn btn-outline-warning attemptButton"  style="border-radius: 0;">Attempt {{$index+1}}</button>
                            <div class="content">
                                @foreach($selectedQuiz[0]->question as $index => $question)
                                    @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->option_id == null && $question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->isCorrect == null && $question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->points == null)
                                        <span class="badge text-bg-success" style="font-size: 20px;">
                                            Partial Score : {{$attempt->quizSummary->total_score}} / {{$attempt->quizSummary->total_points}}
                                        </span>
                                    @break
                                    @else
                                        <span class="badge text-bg-success" style="font-size: 20px;">
                                            Final Score : {{$attempt->quizSummary->total_score}} / {{$attempt->quizSummary->total_points}}
                                        </span>
                                        @break
                                    @endif
                                @endforeach
                                
                                <div class="card m-3">
                                    <div class="card-body">
                                            @foreach($selectedQuiz[0]->question as $index => $question)
                                                    <div class="card mb-3">
                                                        <div class="card ">
                                                            <div class="card-header">{{$index+1}}.) {{  $question->question }}
                                                                <div class="float-end">{{$question->points}} point/s</div>
                                                            </div>
                                                            <div class="card-body">
                                                                @foreach($question->option as $option)
                                                                    @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id))
                                                                        <div class="form-check">
                                                                            @if($question->type != 2)
                                                                                @if($question->type == 1)
                                                                                    {{-- @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->option_id == $option->option_id)
                                                                                        @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->isCorrect)
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
                                                                                    @endif --}}
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
                                                                                    {{-- @if($option->answer)
                                                                                        @if($option->answer->isCorrect)
                                                                                            <div class="alert-warning" style="background-color: lightgreen;">
                                                                                                <input class="form-check-input"  type="checkbox" name="options[{{ $option->option_id}}]" id="exampleRadios2" value="{{$question->question_id}}" disabled checked>
                                                                                                <label class="form-check-label" for="{{$question->question_id}}">
                                                                                                    {{ $option->option }}
                                                                                                </label>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="alert-warning" style="background-color: #FFCCCB;">
                                                                                                <input class="form-check-input"  type="checkbox" name="options[{{ $option->option_id}}]" id="exampleRadios2" value="{{$question->question_id}}" disabled checked>
                                                                                                <label class="form-check-label" for="{{$question->question_id}}">
                                                                                                    {{ $option->option }}
                                                                                                </label>
                                                                                            </div>
                                                                                        @endif
                                                                                    @else
                                                                                        @if($option->isCorrect == 1)
                                                                                            <div class="alert-success" style="background-color: lightgreen;">
                                                                                                <input class="form-check-input"  type="checkbox" name="options[{{ $option->option_id}}]" id="exampleRadios2" value="{{$question->question_id}}" disabled>
                                                                                                <label class="form-check-label" for="{{$question->question_id}}">
                                                                                                    {{ $option->option }}
                                                                                                </label>
                                                                                            </div>
                                                                                        @else
                                                                                            <input class="form-check-input"  type="checkbox" name="options[{{ $option->option_id}}]" id="exampleRadios2" value="{{$question->question_id}}" disabled>
                                                                                            <label class="form-check-label" for="{{$question->question_id}}">
                                                                                                {{ $option->option }}
                                                                                            </label>
                                                                                        @endif
                                                                                    @endif --}}
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
                                                                    @endif
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
                    @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->textAnswer != $correctanswer)
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
                                                            {{-- @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id))
                                                                @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->isCorrect || $question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->option_id == null)
                                                                    @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->option_id == null)
                                                                                @if($question->type == 4)
                                                                                <div class="d-flex justify-content-end">
                                                                                    <div class="p">
                                                                                        <div class="input-group">
                                                                                            @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->points == null)
                                                                                                <input type="number" min="0" max="{{$question->points}}" class="form-control givenPoint" id="{{$index}}" size="2" value="{{$question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->points}}">
                                                                                                <span class="input-group-text">/5</span>
                                                                                                <button class="btn btn-primary mark" id="{{$index}}" style="background-color: orange; border: 1px solid orange;" value="{{$question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->quiz_answer_id}}">Mark</button>
                                                                                            @else
                                                                                                <h6>Given score: {{$question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->points}}</h6>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                @endif
                                                                        @foreach($correctAnswers as $correctanswer)
                                                                            @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->textAnswer == $correctanswer || $question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->isCorrect)
                                                                                <span class="input-group-text" style="color:green; background-color:transparent;border-style: hidden;">
                                                                                    <img src="{{ asset('images/correct.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                                    Student got the correct answer.
                                                                                </span>
                                                                                
                                                                                @if($question->type == 2)
                                                                                    Other possible answers: 
                                                                                    @foreach($correctAnswers as $correctanswer)
                                                                                        @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->textAnswer != $correctanswer)
                                                                                            {{$correctanswer}}, 
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                                
                                                                                @break
                                                                            @else
                                                                                <span class="input-group-text" style="color:red; background-color:transparent;border-style: hidden;">
                                                                                    <img src="{{ asset('images/wrong.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                                    Student got the wrong answer.
                                                                                </span>

                                                                                @if($question->type == 2)
                                                                                    Correct answers: 
                                                                                    @foreach($correctAnswers as $correctanswer)
                                                                                        @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->textAnswer != $correctanswer)
                                                                                            {{$correctanswer}}, 
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                                @break
                                                                            @endif
                                                                            
                                                                        @endforeach
                                                                    @else
                                                                            @php
                                                                                $testCount = 0;
                                                                                $countTesting = 0;
                                                                            @endphp

                                                                            @foreach($attempt->quiz->question as $index => $question)
                                                                                @if($question->type == 3)
                                                                                    @foreach($question->option as $option)
                                                                                        @if($option->isCorrect)
                                                                                            @if($option->answer)
                                                                                                @if($option->answer->isCorrect)
                                                                                                    @php $testCount++; @endphp
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                        @if($option->answer)
                                                                                            @if(!$option->answer->isCorrect)
                                                                                                @php $countTesting++; @endphp
                                                                                            @endif
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                            @endforeach

                                                                        @if($countTesting == 0)
                                                                            <span class="input-group-text" style="color:green; background-color:transparent;border-style: hidden;">
                                                                                <img src="{{ asset('images/correct.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                                Student got the correct answer.
                                                                            </span>
                                                                        @else
                                                                            <span class="input-group-text" style="color:red; background-color:transparent;border-style: hidden;">
                                                                                <img src="{{ asset('images/wrong.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                                Student got the wrong answer.
                                                                            </span>
                                                                        @endif
                                                                    @endif
                                                                @else   
                                                                    <span class="input-group-text" style="color:red; background-color:transparent;border-style: hidden;">
                                                                        <img src="{{ asset('images/wrong.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                        Student got the wrong answer.
                                                                    </span>
                                                                    @if($question->type == 2)
                                                                        Correct answers:
                                                                        @foreach($correctAnswers as $correctanswer)
                                                                            @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->textAnswer != $correctanswer)
                                                                                {{$correctanswer}}, 
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        Correct answer is:
                                                                        @foreach($question->option as $option)
                                                                            @if($option->isCorrect == 1)
                                                                                {{$option->option }}
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endif
                                                            @endif --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        {{-- <tr>
                            <td width="70%" class="text-left p-3">
                                attempt {{ $index+1}}
                            </td>
                            <td class="text-center">
                                Test
                            </td>
                        </tr> --}}
                </tbody>
            </table>
            
            
        </div>
    </div>

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
