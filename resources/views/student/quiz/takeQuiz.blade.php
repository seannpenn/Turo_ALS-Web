@extends('main')

@section('css-style')
    .layout{
        max-width: 1200px;
        margin: 0 auto;
    }
@stop

@section('main-content')

    <div class="layout">
        <div class="col align-self-center">
            <div class="container text-left p-4 rounded" style="width: 600px;">
                <h1>Hello i am Taking the quiz</h1>
                <button type="button" class="btn btn-warning">Submit Quiz</button>
            </div>
        </div>
    </div>
    
@stop