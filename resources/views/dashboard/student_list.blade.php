@extends('main')

@section('css-style')
        img {
           height: 30px;
           width: 30px; 
        } 
        .layout{
            padding: 50px;
        }
        table {
            text-align:center;
            justify-content: center;
            align-items: center;
            font-family: verdana;
        } 

        .icons > a {
            margin-left: 1.5rem;
        }

         #nav-links {
            text-align: center;
        } 
@stop

@section('main-content')
@include('navbar/navbar_inside')
    <div class="layout">
        @if(count($enrollees) != 0)
        <h3>Location: {{Auth::user()->teacher->location->loc_city}}, {{Auth::user()->teacher->location->loc_name}}</h3>
            <table class="table table-hover" style="width: 100%;">
                <tr>
                    <th scope="col">Student ID</th>
                    <th scope="col">Student LRN</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Status </th>
                    <th scope="col">Program enrolled </th>
                    <th scope="col">Actions</th>
                </tr>
            
                    @foreach($enrollees as $enrollee)
                        <tr>
                            <th scope="row">{{ $enrollee->student_id }}</th>
                            @if( $enrollee->student->information->LRN != null)<td>{{ $enrollee->student->information->LRN }}</td>@else <td>no LRN</td>@endif
                            <td>{{ $enrollee->student->student_lname }}, {{ $enrollee->student->student_fname }} {{ $enrollee->student->student_mname }}</td>
                            <td>{{ $enrollee->status }}</td>
                            <td>{{$enrollee->program->prog_fname}}</td>
                            <td>
                                <a href="{{ route('student.application',$enrollee->student_id) }}" title="Delete Student Record"><button type="button" class="btn btn-warning" style="color:white;">View application</button></a>
                            </td>
                        </tr>
                    @endforeach
            </table>
        @else
            <h3>No Student Records found.</h3>   
        @endif
    </div>
    
@stop
