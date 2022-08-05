@extends('main')

@section('left-side-nav')
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('teacher.home')}}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('students.all')}}">Manage Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="">Profile</a>
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
    .text-content{
        background-color: yellow;
        margin: 0 auto;
        justify-content: center;
        width: 1000px;
        border: 1 solid;
        text-align:left;
    }
    a{
        text-decoration: none;
        font-color: black;
    }
    
@stop

@section('main-content')
@include('navbar/navbar_inside')
<a href="{{route('content.view', $selectedTopic->content_id)}}">< Back to module</a>
    <div class="layout">
        @if($selectedTopic->topic_type == 'quiz')
            
            <div class="topic-content">
                <h1>View and edit this quiz in the quiz tab</h1>
                    
                <div class="col-auto">
                    <a href="{{route('quiz.manage')}}"><button type="submit" class="btn btn-primary">Go to Quiz tab</button></a>
                    
                </div>
            </div>
            
            
        @elseif ($selectedTopic->topic_type == 'text')
            <div class="text-content">
                <div class="col-auto">
                    {!! $selectedTopic->text_content !!}
                </div>
            </div>

        @else
            <div class="pdf-content">
                <embed src="{{ asset('storage/files/'.$selectedTopic->file_name) }}" height="750" width="1500" />
            </div>
        @endif
    </div>
@stop