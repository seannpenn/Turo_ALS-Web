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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color:white;">
                    <li class="breadcrumb-item"><a href="{{route('student.quizzes', request()->route('courseid'))}}">Quiz list</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$chosenQuiz[0]->quiz_title}}</li>
                </ol>
            </nav>
        <div class="container text-left p-4 rounded" style="border: 2px solid black; width: 600px;">
            
            <div class="col align-self-center">
                @if($chosenQuiz->count() != 0)
                    @foreach($chosenQuiz as $quiz)
                        <h1>Quiz - {{$quiz->quiz_title}}</h1>
                        <h2>Learner</h2>
                        <!-- <h5>{{Auth::user()->student->student_fname}} {{Auth::user()->student->student_mname}} {{Auth::user()->student->student_lname}}</h5> -->
                        
                        
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-success" role="alert">
                                        @foreach($quiz->attempt as $attempt)
                                            @php
                                                $totalPoints = 0;
                                            @endphp
                                            @foreach($quiz->question as $question)
                                                @php
                                                    $totalPoints += $question->points
                                                @endphp
                                                    
                                            @endforeach
                                            Score: {{$attempt->quizSummary->total_score}} / {{$totalPoints}}
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        <div class="text-center">
                            <br>
                            @if($quiz->attempt->count() == 1)
                                <h6>You are done taking the quiz. Click <a href="{{ route('student.viewResult',[request()->route('courseid'), $quiz->quiz_id])}}">HERE</a>to view result.</h6>
                            @else
                                <a href="{{ route('student.takeQuiz',[request()->route('courseid'), $quiz->quiz_id])}}"><button type="button" class="btn btn-warning">Take Quiz!</button></a>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
            
        </div>

    </div>  
@stop