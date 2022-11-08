@extends('main')

@section('css-style')
    .layout{
        max-width: 1200px;
        margin: 0 auto;
    }
    .container{
        max-width: 1500px;
        margin: 50px auto;
    }
@stop

@section('main-content')
@include('navbar/navbar_inside', ['courseId' => request()->route('courseid'), 'topiccontentid' => request()->route('topiccontentid')])
   
    <div class="container">
        <div class="row justify-content-center">
        
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
                                                            
                                                            @if($question->type != 2 && $question->type != 4)
                                                                @if($question->type == 1)
                                                                    <input class="form-check-input" type="radio" name="questions[{{ $question->question_id }}]hello" id="option-{{ $option->option_id }}" value="{{ $option->option_id }}">
                                                                @elseif($question->type == 3)
                                                                    <input class="form-check-input"  type="checkbox" name="options[{{ $option->option_id}}]" id="exampleRadios2" value="{{$question->question_id}}">
                                                                @endif
                                                                <label class="form-check-label" for="{{$question->question_id}}">
                                                                    {{ $option->option }}
                                                                </label>
                                                            @endif
                                                        </div>
                                                        @if($question->type == 2)
                                                            <input type="text" name="questions[{{ $question->question_id }}]" style="border-top-style: hidden; border-right-style: hidden;border-left-style: hidden;" placeholder="Short answer text" class="form-control" aria-label="Question" value="">
                                                            @break
                                                        @endif
                                                        @if($question->type == 4)
                                                            <textarea class="form-control" name="questions[{{ $question->question_id }}]" placeholder="Enter your answer here..." id="floatingTextarea" rows="5"></textarea>                                                                
                                                        @endif
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
        </div>
    </div>

@endsection