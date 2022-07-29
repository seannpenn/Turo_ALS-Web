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

@section('main-content')
@include('navbar/navbar_inside')
    @if(count($courseContentTopic) != 0)
        @foreach($courseContentTopic as $topic)
            <div class="card" role="button" href="#multiCollapseExample1" style="margin:5px;">
                <div class="card-body">
                    <h5>{{$topic['topic_title']}}</h5>
                    <h9>{{$topic['topic_description']}}</h9>
                                                            
                </div>
                
                                    
            </div>
        @endforeach
    @else
        <h1>No topics for this module</h1>
    @endif

@stop