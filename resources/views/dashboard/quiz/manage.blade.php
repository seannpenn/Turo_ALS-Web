@extends('main')
@extends('dashboard/modals/createquestion_modal')
@extends('modalslug')

@section('modal-content')
    <span id="modalContent"> Are you sure you want to delete this quiz?</span>
@stop

@section('css-style')
    .layout{
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
        width: 155px;
        line-height:55px;
        background-color:orange;
        color: white;
        border: 0;
        border-radius: 10px;
        font-size: 18px;
    }
    
    img {
           height: 30px;
           width: 30px; 
        } 

@stop

@section('main-content')
@include('navbar/navbar_inside')

    <!-- <div class="upper-left-header">
        <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">Create Quiz</button>
    </div> -->
    <div class="layout">
    @if($quizCollection->count() != 0)
        <table class="table table-hover">
            <tr>
                <th scope="col">Quiz Id</th>
                <th scope="col">Assigned to topic</th>
                <th scope="col">Quiz Title</th>
                <th scope="col">Status </th>
                <th scope="col">Actions</th>
            </tr>
            
                @foreach($quizCollection as $quiz)
                    <tr>
                        <th scope="row">{{ $quiz->quiz_id }}</th>
                        <td>{{ $quiz->topic->topic_title }}</td>
                        <td>{{ $quiz->quiz_title }}</td>
                        <td>{{ $quiz->status }}</td>
                        <td>
                            <a href="{{ route('quiz.edit', $quiz->quiz_id) }}" title="Edit Quiz"><button class="btn btn-warning">Edit</button></a>
                            <a  title="Delete Quiz"><button class="btn btn-danger" alt="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Delete</button></a>
                        </td>
                            
                        
                        
                    </tr>

                    @section('script-area')
                        let confirmTask = document.getElementById('confirmTask');
                        confirmTask.addEventListener('click',()=>{
                            window.location.href = "{{route('topic.delete', $quiz->topic_id)}}";
                        }); 
                    @stop
                @endforeach
            
        </table>
        @else
            <h2>No created quizes..</h2>
        @endif
    </div>
    
@stop
