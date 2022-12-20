@extends('main')

@section('css-style')
    .layout{
        padding: 20px;
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
        <h2>Quiz List</h2>
        <div class="container text-left p-4">
            <div class="col align-self-center">
                
                <table class="table table-hover table table-bordered" style="width: 100%;">
                @if($quizCollection->count() != 0 )
                    <tr>
                        <th scope="col" class="text-left">Quiz Title</th>
                        <th scope="col" class="text-center">Status </th>
                        <th scope="col" class="text-center">Attempt </th>
                    </tr>
                    <tbody>
                        @foreach($quizCollection as $quiz)
                                <tr>
                                    <td width="80%" class="text-left p-3">
                                        <div class="row" style="width: 300px;">
                                            <div class="col-auto">
                                                <a href="{{ route('student.viewQuiz', [request()->route('courseid'), $quiz->quiz_id])}}">{{ $quiz->quiz_title }}</a>
                                            </div>
                                            <div class="col-auto">
                                                @if($quiz->status == 'active')
                                                    <div class="badge bg-success text-wrap" style="width: 100%;">
                                                    {{ $quiz->status }} 
                                                    </div>
                                                @else
                                                    <div class="badge bg text-wrap" style="width: 100%; background-color:grey;">
                                                    {{ $quiz->status }} 
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <p style="font-size:small;">Available on {{\Carbon\Carbon::parse($quiz->start_date)->isoFormat('MMMM DD YYYY')}} {{$quiz->start_time}} until {{\Carbon\Carbon::parse($quiz->end_date)->isoFormat('MMMM DD YYYY')}} {{$quiz->end_time}}</p>
                                        
                                    </td>
                                    <td class="text-center">
                                        @if($quiz->quizAttempt->count() != 0)
                                            
                                            <br>
                                            @if($quiz->quizAttempt->count() == $quiz->attempts)
                                                <a href="{{ route('student.viewResult',[request()->route('courseid'), $quiz->quiz_id])}}">
                                                    Done
                                                    @if($quiz->releaseGrades == 1)
                                                        <a href="{{ route('student.viewResult',[request()->route('courseid'), $quiz->quiz_id])}}">view result</a>
                                                    @else
                                                        attempt
                                                    @endif
                                                </a>
                                            @else
                                                <a href="{{ route('student.viewResult',[request()->route('courseid'), $quiz->quiz_id])}}">view attempts</a>
                                            @endif
                                        @else
                                            <h6>No attempt</h6>
                                        @endif
                                    </td>
                                    <td class="text-center">{{$quiz->quizAttempt->count()}}/{{ $quiz->attempts }}</td>
                                </tr>
                        @endforeach
                    </tbody>
                @else
                    <p class="text-start fs-5">There are no quizzes.</p>
                @endif
                </table>
                
            </div>
        </div>
    </div>  
   
@stop