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
        border: 2px solid white;
        margin-bottom: 5px;
    }
    .create-button:hover{
        background-color:white;
        color:orange;
        border: 2px solid orange;
    }
    #question-container{
        transition: transform 250ms;
    }
    #question-container:hover{
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
        cursor:pointer;
    }
    #question-container:focus{
        background: pink;
    }
@stop

@section('main-content')
@include('navbar/navbar_inside', ['courseId' => request()->route('courseid')])
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
            <form action="{{ route('quiz.update', $selectedQuiz[0]->quiz_id) }}" method="post">
            {{ csrf_field() }}
                <div class="col-auto">
                    <label for="staticEmail2" >Quiz title: </label>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" name="quiz_title" id="quiz_title" value="{{$quiz->quiz_title}}">
                </div>
            </form>
            @section('quiz_id')
                {{$quiz->quiz_id}}
            @stop
        @endforeach
        
            <!-- <div class="upper-left-header">
                <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#questionModal" data-bs-whatever="@fat">Create Question</button>
            </div> -->

        @if($selectedQuiz[0]->question->count() != 0)

                @foreach($selectedQuiz[0]->question as $key => $question)
                <div class="card text-center" id="question-container" style="width: 50%; margin: 0 auto; margin-bottom: 20px;" question-id="{{$question->question_id}}">
                    <div class="card text-center">
                        <div class="card-header">
                            Question {{$key+1}}
                            question id: {{ $question->question_id }}
                        </div>
                        <div class="card-body">
                            <br>
                            <form class="row g-3">
                                <div class="row g-3">
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="question_id" placeholder="Question" aria-label="Question" value="{{ $question->question_id }}" hidden>
                                        <input type="text" class="form-control" id="question" placeholder="Question" aria-label="Question" value="{{ $question->question }}">
                                    </div>
                                    <div class="col-sm">
                                        <select id="questionType" class="form-select">
                                            <option selected>Choose...</option>
                                            <option>True or false</option>
                                            <option selected>Multiple Choice</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3" id="questionChoices">
                                    Hello
                                </div>
                            </form>
                                <a title="Delete Question"><button class="btn btn-danger" alt="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img src="{{ asset('images/delete.png') }}" alt="" width="20" height="20"></button></a>
                        </div>
                    </div>
                </div>
                    
                    <!-- for updating the question -->
                        
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
            
        @else
            <div class="d-grid gap-2 col-2 mx-auto" >
                <h2>Add questions..</h2>
            </div>
        @endif
            <nav class="navbar fixed-bottom navbar-dark bg-primary">
                <div class="container-fluid">
                    <button type="button" class="create-button" id="createQuestion">Add Question</button>
                </div>
            </nav>
    </div>
@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
        $(document).ready(function(){

            //create question
            var questionCreateRoute = "{{route('question.create')}}";
            var quizId = {{request()->route('quizid')}};
            
            $("#createQuestion").click(function(e){ 
                console.log(questionCreateRoute);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                        url: questionCreateRoute,
                        type: 'POST',
                        data: {
                            quiz_id: quizId,
                            question: 'Untitled Question',
                            choice_a: 'Option 1',
                            choice_b: 'Option 2',
                            choice_c: 'Option 3',
                            choice_d: 'Option 4',
                            answer: 'C',
                        },
                        dataType: 'json',
                        success: function(response){
                            $("#question-table").load(location.href + " #question-table");
                            alert('Update done.');
                            console.log(response);
                        },
                        error: function(data){
                            console.log(data);
                        }
                });
            });

            //update quiz title
            var quizId = "{{request()->route('quizid')}}";
            var quizUpdateRoute = "{{route('quiz.update', ":quizid")}}";
            quizUpdateRoute = quizUpdateRoute.replace(':quizid', quizId);
            
            $("#quiz_title").change(function(e){
                var updatedQuizTitle = $("#quiz_title").val();
                console.log(quizUpdateRoute);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                        url: quizUpdateRoute,
                        type: 'POST',
                        data: {
                            quiz_title: updatedQuizTitle,
                        },
                        dataType: 'json',
                        success: function(response){
                            $("#question-table").load(location.href + " #question-table");
                            alert('Update done.');
                            console.log(response);
                        },
                        error: function(data){
                            console.log(data);
                        }
                });
            });
            

            // update question
            var questionId = $("#question_id").val();
            var questionUpdateRoute = "{{route('question.update', ":questionid")}}";
            questionUpdateRoute = questionUpdateRoute.replace(':questionid', questionId);
            $("#question").change(function(e){
                var updatedQuestion = $("#question").val();
                console.log(questionUpdateRoute);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                        url: questionUpdateRoute,
                        type: 'POST',
                        data: {
                            question: updatedQuestion,
                            choice_a: 'Option 1',
                            choice_b: 'Option 2',
                            choice_c: 'Option 3',
                            choice_d: 'Option 4',
                            answer: 'C',
                        },
                        dataType: 'json',
                        success: function(response){
                            $("#question-table").load(location.href + " #question-table");
                            alert('Update done.');
                            console.log(response);
                        },
                        error: function(data){
                            console.log(data);
                        }
                });
            });
            
            // Choose question type
            $("#questionType").change(function(e){
                var updatedQuestion = $("#question").val();
                

                if(this.value == "True or false"){
                    alert("This is true or false");
                }
                else if(this.value == "Multiple Choice")
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                //     }
                // });
                // $.ajax({
                //         url: questionUpdateRoute,
                //         type: 'POST',
                //         data: {
                //             question: updatedQuestion,
                //             choice_a: 'Option 1',
                //             choice_b: 'Option 2',
                //             choice_c: 'Option 3',
                //             choice_d: 'Option 4',
                //             answer: 'C',
                //         },
                //         dataType: 'json',
                //         success: function(response){
                //             $("#question-table").load(location.href + " #question-table");
                //             alert('Update done.');
                //             console.log(response);
                //         },
                //         error: function(data){
                //             console.log(data);
                //         }
                // });
            });
        });
</script>