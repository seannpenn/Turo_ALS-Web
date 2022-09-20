@extends('main')

@section('css-style')
    .layout{
        padding: 20px;
    }
    img{
        height: 30px;
        width: 30px; 
    } 
    .module-header{
        margin: 0 auto;
        justify-content:center;
        text-align:center;
        padding: 20px;
        width: 1000px;
    }
    .action{
        position: absolute;
        bottom: 0px;
        right: 0px;
    }
    .action-delete{
        position: absolute;
        bottom: 0px;
        right: 0px;
    }
    .topic-form-content{
        border: 2px solid black;
        padding: 20px;
        
        width:50%;
        height: auto;
        
    }
    
    .module-content{
        margin: 0 auto;
        justify-content:center;
        width: 1000px;
    }
    .module-list{
        margin: 0 auto;
        justify-content:center;
        width: 1000px;
        height:450px;
        overflow-y: auto;
    }
    .card{
        height: 100px;
    }
    .card:hover{
        cursor:pointer;
        border-color: orange;
    }
    .upper-left-header{
        
    }
    .create-button{
        width: 150px;
        line-height:50px;
        background-color:white;
        color: orange;
        border: 2px solid orange;
        border-radius: 10px;
        margin:10px;
        
    }
    .create-button:hover{
        
        background-color:orange;
        color: white;
        
    }
    
@stop

@section('main-content')
@include('navbar/navbar_inside')
<div class="layout">
    <a href="{{route('student.course', $studentChosenCourse[0]->course_id)}}">
        < Back to course
    </a>
    @if(!empty($studentChosenCourse))
    <div class="module-header"> 
        <div class="d-flex justify-content-center">
            @foreach($studentChosenCourse as $module)
            <div class="card" role="button" href="#multiCollapseExample1" style="width: 500px; height: 100px;">
            <div class="card-body">
                <h5>{{$module->content_title}}</h5>
                <h9>{{$module->content_description}}</h9>                                      
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
    <h1> Courses Unavailable.</h1>
@endif    
    <hr>

@stop
