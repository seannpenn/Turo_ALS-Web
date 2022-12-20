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
    <div class="container">
        <h1>Quiz</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color:white;">
                    <li class="breadcrumb-item"><a href="{{route('student.quizzes', request()->route('courseid'))}}">Quiz list</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$chosenQuiz[0]->quiz_title}}</li>
                </ol>
            </nav>
        <div class="container text-left p-4 rounded">
            
            <div class="col align-self-center">
                @if($chosenQuiz->count() != 0)
                    @foreach($chosenQuiz as $quiz)
                        <h1>Quiz - {{$quiz->quiz_title}}</h1>
                        @php
                            $duration = $quiz->duration;
                            $hours = intdiv($duration, 60);
                            $minutes = $duration%60;
                        @endphp
                        <h3>Quiz duration - {{$hours}} hour and {{$minutes}} minutes</h3>
                        <!-- <h5>{{Auth::user()->student->student_fname}} {{Auth::user()->student->student_mname}} {{Auth::user()->student->student_lname}}</h5> -->
                        
                        @if($quiz->quizAttempt->count() == $quiz->attempts)
                            <div class="row">
                                <div class="col-12">
                                    @if($quiz->releaseGrades == 1)
                                        <div class="alert alert-success" role="alert">
                                            @foreach($quiz->quizAttempt as $attempt)
                                                @php
                                                    $totalPoints = 0;
                                                @endphp
                                                @foreach($quiz->question as $question)

                                                    @php
                                                        $totalPoints += $question->points
                                                    @endphp
                                                @endforeach
                                                Score: {{$attempt->quizSummary->total_score}} / {{$attempt->quizSummary->total_points}}
                                            @endforeach
                                        </div>
                                    @endif
                                    <hr>
                                    <h5>Quiz Status: Completed.</h5>
                                </div>
                            </div>
                        @else
                            <div class="text-left">
                                <br>
                                @if($quiz->quizAttempt->count() == $quiz->attempts)
                                    @if($quiz->releaseGrades != 1)
                                        <h6>Click <a href="{{ route('student.viewResult',[request()->route('courseid'), $quiz->quiz_id])}}">HERE</a> to view result.</h6>
                                    @endif
                                @else
                                    @if($quiz->password == null)
                                        <a href="{{ route('student.takeQuiz',[request()->route('courseid'), $quiz->quiz_id])}}"><button type="button" class="btn btn-warning">Take Quiz!</button></a>
                                    @else
                                        <form class="row gx-3 gy-2 align-items-left" action="{{ route('student.takeQuiz',[request()->route('courseid'), $quiz->quiz_id]) }}" method="GET">
                                            <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="quizPass" id="specificSizeInputGroupUsername" placeholder="input quiz password" required>
                                                        @if($errors->any())
                                                        <p class="fs-6" style="color: red;">
                                                            {{$errors->first()}}
                                                        </p>
                                                        @endif
                                            </div>
                                            <div class="col-sm-5">
                                                <button type="submit" class="btn btn-warning">Take Quiz!</button>
                                            </div>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            
        </div>

    </div>  

    <script>
        
    </script>
@stop