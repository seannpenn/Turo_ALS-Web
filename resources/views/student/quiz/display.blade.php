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
        <h1>Quiz List</h1>
        <div class="container text-center p-4">
            <div class="col align-self-center">
                <table class="table table-hover table table-bordered" style="width: 100%;">
                    <tr>
                        <th scope="col" class="text-left">Quiz Title</th>
                        <th scope="col">Status </th>
                        <th scope="col">Attempt </th>
                    </tr>
                    <tbody>
                    @foreach($quizCollection as $quiz)
                        <tr>
                            <td width="80%" class="text-left p-3">
                                <a href="{{ route('student.viewQuiz', [request()->route('courseid'), $quiz->quiz_id])}}">{{ $quiz->quiz_title }}</a>
                                <br>
                                <p style="font-size:small;">Available on Sep 7, 2022 10:30 AM until Sep 7, 2022 12:30 PM</p>
                            </td>
                            <td>done <br><a href="">view result</a> </td>
                            <td>{{$quiz->attempt->count()}}/1</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
@stop