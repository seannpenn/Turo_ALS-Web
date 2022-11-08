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

    <div class="layout">
        <div class="col align-self-center">
            <div class="container text-center p-4 rounded" style="width: 600px;">
                <h1>Quiz Result</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$chosenQuiz->quiz_title}}</div>
                    <div class="card-body">
                            @foreach($questions as $index => $question)
                                @foreach($QuizAnswers as $answer)
                                    @if($question->question_id == $answer->question_id)
                                        <div class="card mb-3">
                                            <div class="card ">
                                                <div class="card-header">{{$index+1}}.) {{  $question->question }}  {{$question->points}} point/s</div>
                            
                                                <div class="card-body">
                                                
                                                    @foreach($question->option as $option)
                                                        
                                                            <div class="form-check">
                                                                @if($question->type != 2)
                                                                    @if($question->type == 1)
                                                                        @if($option->answer)
                                                                            <div class="alert-warning">
                                                                                <input class="form-check-input" type="radio" name="questions[{{ $question->question_id }}]hello" id="option-{{ $option->option_id }}" value="{{ $option->option_id }}" checked disabled>
                                                                                <label class="form-check-label" for="{{$question->question_id}}">
                                                                                    {{ $option->option }} 
                                                                                </label>
                                                                            </div>
                                                                        @else
                                                                            @if($option->isCorrect == 1)
                                                                                <div class="alert-success">
                                                                                    <input class="form-check-input" type="radio" name="questions[{{ $question->question_id }}]hello" id="option-{{ $option->option_id }}" value="{{ $option->option_id }}" disabled>
                                                                                    <label class="form-check-label" for="{{$question->question_id}}">
                                                                                        {{ $option->option }}
                                                                                    </label>
                                                                                </div>
                                                                            @else
                                                                                <input class="form-check-input" type="radio" name="questions[{{ $question->question_id }}]hello" id="option-{{ $option->option_id }}" value="{{ $option->option_id }}" disabled>
                                                                                <label class="form-check-label" for="{{$question->question_id}}">
                                                                                    {{ $option->option }}
                                                                                </label>
                                                                            @endif
                                                                        @endif
                                                                    @elseif($question->type == 3)
                                                                        <input class="form-check-input"  type="checkbox" name="options[{{ $option->option_id}}]" id="exampleRadios2" value="{{$question->question_id}}"disabled>
                                                                            <label class="form-check-label" for="{{$question->question_id}}">
                                                                                {{ $option->option }}
                                                                            </label>
                                                                    @endif
                                                                @else
                                                                    <input type="text" name="questions[{{ $question->question_id }}]" style="border-top-style: hidden; border-right-style: hidden;border-left-style: hidden;" placeholder="Short answer text" class="form-control" aria-label="Question" value="">
                                                                @endif
                                                            </div>
                                                    @endforeach
                                                    
                                                </div>
                                                <div class="card-footer">
                                                    @if($answer->question_id == $question->question_id)
                                                        @if($answer->isCorrect==1)
                                                            <span class="input-group-text" style="color:green; background-color:transparent;border-style: hidden;">
                                                                <img src="{{ asset('images/correct.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                You got the correct answer.
                                                            </span>
                                                        @else
                                                            <span class="input-group-text" style="color:red; background-color:transparent;border-style: hidden;">
                                                                <img src="{{ asset('images/wrong.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                You got the wrong answer.
                                                            </span>
                                                            @foreach($question->option as $option)
                                                                @if($option->isCorrect == 1)
                                                                    Correct answer is: {{$option->option}}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach

                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <a href="{{ route('student.viewQuiz',[request()->route('courseid'), request()->route('quizid')])}}">
                                        <button type="button" class="btn btn-primary">
                                            Return
                                        </button>
                                    </a>
                                    
                                </div>
                                <div class="col">
                                    <div class="d-flex align-content-end flex-wrap">
                                    Points
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection