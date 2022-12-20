@extends('main')

@section('css-style')
    .layout{
        padding: 20px;
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
        <h2>Assignment List</h2>
        
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
                            @if($assignment->status == 'inactive' && $assignment->submissions->count() != 0 || $assignment->status == 'active')
                                <tr>
                                    <td width="70%" class="text-start p-3">
                                        <div class="row" >
                                            <div class="col-auto">
                                                @if($assignment->status == 'active')
                                                    @if($assignment->submissions->count() == 0 )
                                                        <a href="/student/course/{{ request()->route('courseid') }}/assignment/{{ $assignment->assignment_id }}">
                                                            <p>{{ $assignment->assignment_title }}</p>
                                                        </a>
                                                    @elseif ($assignment->submissions->count() != 0 && $assignment->multiple_submissions == 'true')
                                                        <a href="/student/course/{{ request()->route('courseid') }}/assignment/{{ $assignment->assignment_id }}">
                                                            <p>{{ $assignment->assignment_title }}</p>
                                                        </a>
                                                    @else
                                                        <a href="/student/course/{{ request()->route('courseid') }}/assignment/{{ $assignment->assignment_id }}">
                                                            <p>{{ $assignment->assignment_title }}</p>
                                                        </a>
                                                    @endif
                                                @else
                                                    <p>{{ $assignment->assignment_title }}</p>
                                                @endif
                    
                                            </div>
                                            <div class="col-auto">
                                                @if($assignment->status == 'active' )
                                                    <div class="badge bg-success text-wrap">
                                                        {{ $assignment->status }}
                                                    </div>
                                                @elseif($assignment->status == 'inactive' && $assignment->submissions->count() != 0)
                                                    <div class="badge bg text-wrap" style="background-color:grey;">
                                                        closed 
                                                    </div>
                                                @else
                                                    <div class="badge bg text-wrap" style="background-color:grey;">
                                                        {{ $assignment->status }} 
                                                    </div>
                                                @endif
                                            </div>
                                            <p style="font-size:small;">Available on {{\Carbon\Carbon::parse($assignment->start_date)->isoFormat('MMMM DD YYYY')}} {{$assignment->start_time}} until {{\Carbon\Carbon::parse($assignment->end_date)->isoFormat('MMMM DD YYYY')}} {{$assignment->end_time}}</p>
                                            
                                        </div>
                                    </td>
                                    <td>
                                        @if($assignment->submissions->count() == 0)
                                            <p style="font-size:x-small; padding:10px;">No submissions</p>
                                        @else
                                            <a href="/student/course/{{ request()->route('courseid') }}/assignment/{{ $assignment->assignment_id }}/submissions">
                                                <p style="font-size:x-small; padding:10px;">{{ $assignment->submissions->count()}} submissions</p>
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-start p-3" width="10%">
                                        @if($assignment->submissions->count() == 1)
                                            <p>{{ $assignment->submissions[0]->total_score }} / {{ $assignment->points }}</p>
                                        @else
                                            <p> / 10</p>
                                        @endif
                                        
                                    </td>
                                    <td width="15%" class="text-center p-3">
                                        <p class="fs-6">May 20, 2001</p>
                                    </td>
                                </tr>
                            @endif
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
