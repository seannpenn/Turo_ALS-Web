@extends('main')

@section('css-style')
    table {
        margin: 50px;
        justify-content: center;
        align-items: center;
        font-family: verdana;
    } 
@stop

@section('main-content')
@include('navbar/navbar_inside')
    <table class="table table-hover" style="width: 100%;">
        <tr>
            <th scope="col">Quiz Id</th>
            <th scope="col">Topic Id</th>
            <th scope="col">Quiz Title</th>
            <th scope="col">Status </th>
            <th scope="col">Actions</th>
        </tr>
        @foreach($quizCollection as $quiz)
            <tr>
                <th scope="row">{{ $quiz['quiz_id'] }}</th>
                <td>{{ $quiz['topic_id'] }}</td>
                <td>{{ $quiz['quiz_title'] }}</td>
                <td></td>
                <td class="icons"><a href="" title="Delete Module"><button type="button" class="btn btn-primary">View Details</button></a></td>

            </tr>
        @endforeach
    </table>
@stop
