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


@section('main-content')
@include('navbar/navbar_inside', ['courseId' => Request::getRequestUri()[strlen(Request::getRequestUri())-1] ])
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