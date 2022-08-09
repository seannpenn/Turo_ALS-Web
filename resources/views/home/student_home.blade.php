@extends('main')
<!--//for outer navbar//-->

@section('css-style')
    .layout{
        border: 1 solid;
        height:94vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .message{
        text-align:center;
        padding: 0 24px;
        margin: 150px auto;
    }
    .work {
        max-width: 900px;
        padding: 0 24px;
        margin: 150px auto;
        margin-bottom: 32px;
        border-radius: 5px;
        background-color: #f9fafb;
    }
@stop

@section('main-content')
    
    
    <div class="layout">
        
        <div class="message">
            @if(Auth::user()->student->status != 'approved')
                <h2>Your enrollment is pending for approval.</h2>
                
                <h4>Please wait for a confimation.</h4>
                <img src="{{ asset('images/loading.gif') }}" alt="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            @else
                <h1>Your enrollment application is approved.</h1>
                <h4>Your Learning Reference number(LRN) is {{Auth::user()->student->LRN}}</h4>
                <br>
                <img src="{{ asset('images/loginUI.png')}}" width="200" height="350" class="img" />
                <br><br>
                <p><b>Install the mobile application to access your learning materials.</b></p>
                    
            @endif
        </div>
    </div>
    

@stop

