@extends('main')

@section('css-style')
    .layout{
        max-width: 1200px;
        margin: 0 auto;
    }
    table {
        justify-content: center;
        align-items: center;
        font-family: verdana;
        
    } 
    .upper-left-header{
        margin-left: 30px;
        margin-top: 30px;
        
    }
    .create-button{
        width: 150px;
        line-height:50px;
        background-color:orange;
        color: white;
        border: 0;
        border-radius: 10px;
        
    }
    .create-button:hover{
        line-height:50px;
        background-color:orange;
        color: white;
        border: 0;
        border-radius: 10px;
    }
    
    img {
           height: 20px;
           width: 20px; 
        } 

@stop

@section('main-content')
@include('navbar/navbar_inside', ['courseId' => request()->route('courseid') ])
@include('dashboard/assignment/createModal')
@include('dashboard/assignment/updateModal')
    
    <div class="layout">
        <h1>Assignment List</h1>
        
            <div class="container text-center p-4">
                <div class="col align-self-center">
                    @if($assignmentCollection->count() != 0)
                        <table class="table table-hover table table-bordered text-center" style="width: 100%;">
                            <tr>
                                <th scope="col" class="text-center">Assignment Title</th>
                                <th scope="col">Submissions </th>
                                <th scope="col">Score </th>
                                <th scope="col">Due date </th>
                            <tbody>
                            @foreach($assignmentCollection as $index => $assignment)
                                <tr>
                                    <td width="80%" class="text-start p-3">
                                        <div class="row" style="width: 300px;">
                                            <div class="col-auto">
                                                <a href="/student/course/{{ request()->route('courseid') }}/assignment/{{ $assignment->assignment_id }}">
                                                    <p>{{ $assignment->assignment_title }}</p>
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                @if($assignment->status == 'active')
                                                    <div class="badge bg-success text-wrap">
                                                        {{ $assignment->status }}
                                                    </div>
                                                @else
                                                    <div class="badge bg text-wrap" style="background-color:grey;">
                                                        {{ $assignment->status }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="/student/course/{{ request()->route('courseid') }}/assignment/{{ $assignment->assignment_id }}/submissions">
                                            <p style="font-size:small; padding:10px;">{{ $assignment->submissions->count()}} submissions</p>
                                        </a>
                                    </td>
                                    <td class="text-start p-3">
                                        <p> / 10</p>
                                        
                                    </td>
                                    <td width="15%" class="text-center p-3">
                                        <p class="fs-6">May 20, 2001</p>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h2>No assignment..</h2>
                    @endif
                </div>
            </div>
    </div>  

    
@stop
