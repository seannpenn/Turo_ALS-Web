@extends('main')
@extends('dashboard/modals/createquestion_modal')
@extends('dashboard/modals/editquestion_modal')
@extends('modalslug')

@section('modal-content')
    <span id="modalContent"> Are you sure you want to delete this question?</span>
@stop

@section('css-style')
    .layout{
        padding: 50px;
    }
    table{
        text-align:center;
    }
    .upper-left-header{
        <!-- margin-left: 30px;
        margin-top: 30px; -->
        
    }
    .create-button{
        width: 150px;
        line-height:40px;
        background-color:orange;
        color: white;
        border: 0;
        border-radius: 10px;
        
    }
    .create-button:hover{
        background-color:white;
        color:orange;
        border: 2px solid orange;
    }
@stop

@section('main-content')
@include('navbar/navbar_inside')
    @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'topic.view')
        <a href="{{ URL::previous() }}">
            < Back to Topic
        </a>
    @else
        <a href="{{ URL::previous() }}">
            < Back to Quiz Management
        </a>
    @endif

    <div class="layout">
        
        @foreach($selectedQuiz as $quiz)
            <form class="row g-3" action="{{route('quiz.update', $quiz->quiz_id)}}" method="post">
            {{ csrf_field() }}

                <div class="col-auto">
                    <label for="staticEmail2" >Quiz title: </label>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" name="quiz_title" id="staticEmail2" value="{{$quiz->quiz_title}}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Update title</button>
                </div>
                
            </form>
            @section('quiz_id')
                {{$quiz->quiz_id}}
            @stop
        @endforeach
        
            <div class="upper-left-header">
                <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#questionModal" data-bs-whatever="@fat">Create Question</button>
            </div>

        @if($selectedQuiz[0]->question->count() != 0)
            <table class="table table-hover">
                <tr>
                    <th scope="col">Question id</th>
                    <th scope="col">Question</th>
                    <th scope="col">Answer</th>
                    <th scope="col">Actions</th>
                </tr>
                @foreach($selectedQuiz[0]->question as $question)
                    <tr>
                        <th scope="row">{{ $question->question_id }}</th>
                        <td>{{ $question->question }}</td>
                        <td>{{ $question->answer }}</td>
                        <td>
                            <a title="Edit Question"><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editquestionModal">Edit</button></a>
                            <a title="Delete Question"><button class="btn btn-danger" alt="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Delete</button></a>
                        </td>
                    </tr>
                    <!-- for updating the question -->
                        @section('question-action-update') {{route('question.update', $question->question_id)}}@stop
                        @section('question') {{$question->question}}@stop
                        @section('choice_a') {{$question->choice_a}}@stop
                        @section('choice_b') {{$question->choice_b}}@stop
                        @section('choice_c') {{$question->choice_c}}@stop
                        @section('choice_d') {{$question->choice_d}}@stop

                        @section('script-area-update')

                        $("#radio-button-a").prop("checked", false);

                        console.log($question->answer);
                            document.getElementById('radio-button-a').checked = true;
                            let b = document.getElementById('radio-button-b');
                            let c = document.getElementById('radio-button-c');
                            let d = document.getElementById('radio-button-d');
                            a.checked = true;
                            const radioButtons = document.querySelectorAll('input[name="answer"]');
                            
                                for (const radioButton of radioButtons) {
                                    
                                    if (radioButton.value == $question->answer) {
                                        
                                        radioButton.checked = true;
                                        break;
                                    }
                                }
                        @stop
                    <!--  -->
                    <!-- for deleting the question -->
                        @section('script-area')
                            let confirmTask = document.getElementById('confirmTask');
                            confirmTask.addEventListener('click',()=>{
                                window.location.href = "{{ route('question.delete', $question->question_id) }}";
                            }); 
                        @stop
                    <!--  -->
                @endforeach

            </table>
        @else
            <div class="d-grid gap-2 col-2 mx-auto" >
                <h2>Add questions..</h2>
            </div>
        @endif
            
    </div>
@stop

@section('script-area')

@stop