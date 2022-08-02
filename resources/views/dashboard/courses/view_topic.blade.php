@extends('main')

@section('left-side-nav')
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('teacher.home')}}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('users.all')}}">Manage Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('users.all')}}">Profile</a>
    </li>
@stop

@section('right-side-nav')
    <a class="nav-link" style="color: black;" href="{{route('user.logout')}}">{{Auth::user()->username}}</a>
     <a class="nav-link" style="color: black;" href="{{route('user.logout')}}">Logout</a>
@stop

@section('css-style')
    .layout{
        justify-content:center;
        text-align:center;
    }
    .topic-content{
        margin-top: 320px;
        border: 1 solid;
    }
    a{
        text-decoration: none;
        font-color: black;
    }
    
@stop

@section('main-content')
@include('navbar/navbar_inside')
<a href="{{route('content.view', $selectedTopic[0]['content_id'])}}">< Back to courses</a>
    <div class="layout">
        @if($selectedTopic[0]['topic_type'] == 'quiz')
            
            <div class="topic-content">
                <h1>View and edit this quiz in the quiz tab</h1>
                    
                <div class="col-auto">
                    <a href="{{route('quiz.manage')}}"><button type="submit" class="btn btn-primary">Go to Quiz tab</button></a>
                    
                </div>
            </div>
            
            
        @elseif ($selectedTopic[0]['topic_type'] == 'text')
            <div class="topic-content">
                <h1>This topic contains a text content.</h1>
            </div>

        @else

            <div class="topic-content">
                <h1>This topic contains a pdf file.</h1>
            </div>
        @endif
    </div>
@stop