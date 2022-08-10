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
                            <th scope="row">{{ $enrollee->studentId }}</th>
                            @if( $enrollee->student->LRN != null)<td>{{ $enrollee->student->LRN }}</td>@else <td>no LRN</td>@endif
                            <td>{{ $enrollee->student->student_lname }}, {{ $enrollee->student->student_fname }} {{ $enrollee->student->student_mname }}</td>
                            <td>{{ $enrollee->status }}</td>
                            <td></td>
                            <td>
                                <a href="{{ route('student.application',$enrollee->studentId) }}" title="Delete Student Record"><button type="button" class="btn btn-warning" style="color:white;">View application</button></a>
                            </td>
                        </tr>
                    @endforeach
            </table>
        @else
            <h3>No Student Records found.</h3>   
        @endif
    </div>
    
@stop
