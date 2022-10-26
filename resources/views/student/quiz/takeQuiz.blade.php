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
            <div class="container text-left p-4 rounded" style="width: 600px;">
                <h1>Hello i am Taking the quiz</h1>
                <button type="button" class="btn btn-warning">Submit Quiz</button>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
        @if($message)
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$chosenQuiz->quiz_title}}</div>
                    <div class="card-body">
                            
                        <form action="{{ route('student.storeAnswers', [request()->route('courseid'), request()->route('quizid')])}}" method="post">
                            {{ csrf_field() }}
                            @foreach($questions->shuffle() as $index => $question)
                                <div class="card mb-3">
                                            <div class="card ">
                                                <div class="card-header">{{$index+1}}.) {{  $question->question }}</div>
                            
                                                <div class="card-body">
                                                    @foreach($question->option as $option)
                                                        <div class="form-check">
                                                            
                                                            @if($question->type != 2)
                                                                @if($question->type == 1)
                                                                    <input class="form-check-input" type="radio" name="questions[{{ $question->question_id }}]hello" id="option-{{ $option->option_id }}" value="{{ $option->option_id }}">
                                                                @elseif($question->type == 3)
                                                                    <input class="form-check-input"  type="checkbox" name="options[{{ $option->option_id}}]" id="exampleRadios2" value="{{$question->question_id}}">
                                                                @endif
                                                                <label class="form-check-label" for="{{$question->question_id}}">
                                                                    {{ $option->option }}
                                                                </label>
                                                            @else
                                                                <input type="text" name="questions[{{ $question->question_id }}]" style="border-top-style: hidden; border-right-style: hidden;border-left-style: hidden;" placeholder="Short answer text" class="form-control" aria-label="Question" value="">
                                                            @endif
                                                            
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                </div>
                            @endforeach

                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        </div>
    </div>

@endsection