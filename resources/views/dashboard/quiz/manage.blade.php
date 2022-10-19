@extends('main')
@extends('dashboard/modals/createquestion_modal')
@extends('dashboard/modals/createquiz_modal')
@extends('modalslug')

@section('modal-content')
    <span id="modalContent"> Are you sure you want to delete this quiz?</span>
@stop

@section('css-style')
    .layout{
        margin: 0 auto;
        width: 50em;
        padding: 50px;
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

    <div class="upper-left-header">
        <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#quizModal" data-bs-whatever="@fat">Create Quiz</button>
        @section('course_id')
            {{request()->route('courseid')}}
        @stop
    </div>
    <div class="layout">
        @if($quizCollection->count() != 0)
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <table class="table table-hover table table-bordered">
                <tr>
                    <th scope="col">Quiz Id</th>
                    <th scope="col">Quiz Title</th>
                    <th scope="col">Status </th>
                    <th scope="col">Actions</th>
                </tr>
                
                    @foreach($quizCollection as $quiz)
                        <tr>
                            <th scope="row">{{ $quiz->quiz_id }}</th>
                            <td>{{ $quiz->quiz_title }}</td>
                            <td>{{ $quiz->status }}</td>
                            <td>
                                <a href="{{ route('quiz.edit',[ request()->route('courseid') ,$quiz->quiz_id]) }}" title="Edit Quiz"><button class="btn btn-warning"><img src="{{ asset('images/edit.png') }}" alt="" ></button></a>
                                <a href="{{ route('quiz.edit',[ request()->route('courseid') ,$quiz->quiz_id]) }}" title="Edit Quiz"><button class="btn btn-danger"><img src="{{ asset('images/delete.png') }}" alt="" ></button></a>
                            </td>
                        </tr>

                    
                    @endforeach
                
            </table>
        </div>
        @else
            <h2>No created quizes..</h2>
        @endif
    </div>
    
@stop
