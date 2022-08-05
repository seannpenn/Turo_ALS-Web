@extends('main')

@section('css-style')
    .form-content{
        margin: 0 auto;
        margin-top: 50px;
        width: 500px;
        height: 300px;
        border: 1 solid;
        text-align:center;
    }
    form{
        justify-content:center;
        
    }
    
@stop

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


@section('main-content')
    <div class="form-content">
        <form class="row g-3">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Quiz title</label>
                <input type="email" class="form-control" name="quiz_title" id="inputEmail4">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Create Quiz</button>
            </div>
        </form>
    </div>
@stop