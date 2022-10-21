@extends('main')
@extends('dashboard/modals/createquestion_modal')
@extends('dashboard/modals/createquiz_modal')
@extends('modalslug')

@section('modal-content')
    <span id="modalContent"> Are you sure you want to delete this quiz?</span>
@stop

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

    
    <div class="layout">
        <h1>Quiz List</h1>
        
        <div class="container text-center p-4">
            
            <div class="col align-self-center">
            @if($quizCollection->count() != 0)
                <div class="d-flex flex-row mb-3">
                    <button type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#quizModal" data-bs-whatever="@fat">Create Quiz</button>
                </div>
                <table class="table table-hover table table-bordered" style="width: 100%;">
                    <tr>
                        <th scope="col" class="text-left">Quiz Title</th>
                        <th scope="col">Status </th>
                        <th scope="col">Actions</th>
                    <tbody>
                    @foreach($quizCollection as $quiz)
                        <tr>
                            <td width="90%" class="text-left p-3">
                                <a href="{{ route('student.viewQuiz', [request()->route('courseid'), $quiz->quiz_id])}}">{{ $quiz->quiz_title }}</a>
                                <br>
                                <p style="font-size:small;">Available on Sep 7, 2022 10:30 AM until Sep 7, 2022 12:30 PM</p>
                            </td>
                            <td>{{ $quiz->status }}</td>
                            <td>
                                <a href="{{ route('quiz.edit',[ request()->route('courseid') ,$quiz->quiz_id]) }}" title="Edit Quiz"><button class="btn btn-warning"><img src="{{ asset('images/edit.png') }}" alt="" ></button></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h2>No created quizes..</h2>
            @endif
            </div>
        </div>
    </div>  
    
@stop
