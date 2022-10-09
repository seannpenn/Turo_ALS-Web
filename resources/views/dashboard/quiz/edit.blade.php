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
        border: 5px solid tranparent;
        border-left: 5px solid tranparent ;
        transition: transform .4s;
    }
    #question-container:hover{
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
        cursor:pointer;
    }
    #question-container:focus-within,  #question-container:focus{
        z-index: 9;
        transform: scale(1.05);
        border-left: 5px solid orange;

    }
    #radio{
        width: 20px;
        height: 20px;
    }
    #radio-row{
        font-size: 20px;
    }
    .question-button{
        border-bottom: 2px solid white;

    }
    .question-button:hover{
        border-bottom: 2px solid orange;
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
            <form action="{{ route('quiz.update', $selectedQuiz[0]->quiz_id) }}" method="post" style="width: 50%; margin: 0 auto;">
            {{ csrf_field() }}
                <div class="row">
                    <label for="staticEmail2" >Quiz title: </label>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="quiz_title" id="quiz_title" value="{{$quiz->quiz_title}}">
                    </div>
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
        <br>
            <div class="questions" id="questions">
                @foreach($selectedQuiz[0]->question as $key => $question)
                        <div class="card text-center questionContainer" id="question-container" style="width: 50%; margin: 0 auto; margin-bottom: 20px;" question-id="{{$question->question_id}}" tabindex='1'>
                            <div class="card-header">
                                question id: {{ $question->question_id }}
                            </div>
                            <div class="card-body">
                                <form class="row g-3">
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control question_id" id="question_id" placeholder="Question" aria-label="Question" value="{{ $question->question_id }}" hidden>
                                        <input type="text" class="form-control question" id="question" placeholder="Question" aria-label="Question" value="{{ $question->question }}" question-id="{{$question->question_id}}">
                                    </div>
                                    <select id="questionType" class="form-select questionType" style="width: 200px;">

                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach($types as $type)
                                        @if(($count == 1) and ($question->type === $type->type_id))
                                            <option value="{{ $question->type }}" selected>{{ $type->type_name }}</option>
                                        @else
                                            <option value="{{ $type->type_id }}">{{ $type->type_name  }}</option>
                                        @endif
                                        @php
                                            $count++;
                                        @endphp
                                    @endforeach
                                    </select>
                                    <div class ="questionChoices" id="questionChoices">
                                        <form>
                                            <div class="row g-3">
                                            @foreach($question->option as $option)
                                                    <div class="col-sm-9" style="text-align:left;">
                                                        <div class="form-check" id="radio-row">
                                                            <input class="form-check-input" type="radio" name="gridRadios" id="radio" value="option1" disabled>
                                                            <input type="text" class="form-control option" id="option" placeholder="Question" aria-label="Question" option-id = "{{$option->option_id}}" value="{{$option->option}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm">
                                                        <button type="button" class="form-check-label deleteOption" value="{{$option->option_id}}" title="Delete Option" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img src="{{ asset('images/delete.png') }}" alt="" width="20" height="20"></button>
                                                        
                                                    </div>
                                            @endforeach
                                            </div>
                                            <div class="row g-3">
                                                    <div class="col-sm-9" style="text-align:left;">
                                                        <div class="form-check">
                                                            <button type="button" class="addOptionButton" value="{{ $question->question_id }}"><img src="{{ asset('images/add.png') }}" alt="" width="20" height="20">Add option</button>
                                                            <!-- <a class="link-secondary" title="add option"><img src="{{ asset('images/add.png') }}" alt="" width="20" height="20">Add option</a> -->
                                                        </div>
                                                    </div>
                                            </div>
                                        </form>
                                    </div>
                                </form>
                                <hr>
                                <div class="d-flex justify-content-end">
                                    <div class="d-flex justify-content-evenly" style="width: 200px;">
                                        <button class="question-button deleteQuestion" value="{{ $question->question_id }}" title="Delete Question" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img src="{{ asset('images/delete.png') }}" alt="" width="20" height="20"></button>
                                        <a class="question-button" title="Delete Question"><img src="{{ asset('images/answer.png') }}" alt="" width="20" height="20"> Set answer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <!-- for updating the question -->
                        
                    <!-- for deleting the question -->
                        @section('modal-title')
                            Delete Question
                        @stop
                    <!--  -->
                @endforeach
                <br>
            </div>
        @else
            <div class="d-grid gap-2 col-2 mx-auto" >
                <h2>Add questions..</h2>
            </div>
        @endif
            <nav class="navbar fixed-bottom navbar-dark" style="box-shadow: 0 4px 20px rgb(0 0 0 / 0.2);">
                <div class="container-fluid">
                    <button type="button" class="create-button" id="createQuestion">Add Question</button>
                </div>
            </nav>
    </div>
@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
        $(document).ready(function(){

            // get question
            
                const question = document.getElementsByClassName("questionContainer");
                var x;
                for(x=0;x<question.length;x++){
                    $(question[x]).click(function(e){
                        var getQuestionRoute = "{{route('question.get', ":questionid")}}";
                        var questionId = this.getAttribute("question-id");
                        getQuestionRoute = getQuestionRoute.replace(':questionid', questionId);

                        console.log(getQuestionRoute);
                        $.ajax({
                            type: "GET",
                            url: getQuestionRoute,
                            dataType: "json",
                            success: function (response) {
                                updateQuestion(response[0]);
                                console.log(response);
                            },
                            error: function(response){
                                console.log(response);
                            }
                        });
                    });
                    
                }
            
            
            // delete question
            var deleteQuestionRoute = "{{route('question.delete', ":questionid")}}";
            const deleteQuestion = document.getElementsByClassName("deleteQuestion");
            var b;
            for(b=0;b<deleteQuestion.length;b++){
                $(deleteQuestion[b]).click(function(e){
                    var question_id = this.value;
                    deleteQuestionRoute = deleteQuestionRoute.replace(':questionid', question_id);
                    console.log(question_id);
                    $("#confirmTask").click(function(e){
                        window.location.href = deleteQuestionRoute;
                    });
                });
            }


            // delete option
            var deleteOptionRoute = "{{route('option.delete', ":optionid")}}";
            const deleteOption = document.getElementsByClassName("deleteOption");
            var a;
            for(a=0;a<deleteOption.length;a++){
                $(deleteOption[a]).click(function(e){
                    var option_id = this.value;
                    deleteOptionRoute = deleteOptionRoute.replace(':optionid', option_id);
                    console.log(option_id);
                    $("#confirmTask").click(function(e){
                        window.location.href = deleteOptionRoute;
                    });
                });
            }
            

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
                        },
                        dataType: 'json',
                        success: function(response){
                            console.log(response);
                        },
                        error: function(data){
                            console.log(data);
                        },
                });
                $(document).ajaxStop(function(){
                    window.location.reload();
                });
                
            });

            

            //update quiz
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
            function updateQuestion(data){
                const questionId = document.getElementsByClassName("question_id");
                const questions = document.getElementsByClassName("question");
                const questionType = document.getElementsByClassName("questionType");
                var questionUpdateRoute = "{{route('question.update', ":questionid")}}";
                var a;
                var temp;
                for(a=0;a<questions.length;a++){
                    
                    $(questions[a]).change(function(e){
                        var questionId = this.getAttribute("question-id");
                        questionUpdateRoute = questionUpdateRoute.replace(':questionid', questionId);
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                        });
                        $.ajax({
                                url: questionUpdateRoute,
                                type: 'POST',
                                data: {
                                    question: this.value,
                                    type: data.type,
                                },
                                dataType: 'json',
                                success: function(response){
                                    // $("#question-table").load(location.href + " #question-table");
                                    alert('Update done.');
                                    console.log(response);
                                },
                                error: function(data){
                                    console.log(data);
                                }
                        });
                    });
                    $(questionType[a]).change(function(e){
                        // var questionId = this.getAttribute("question-id");
                        questionUpdateRoute = questionUpdateRoute.replace(':questionid', data.question_id);
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                        });
                        $.ajax({
                                url: questionUpdateRoute,
                                type: 'POST',
                                data: {
                                    question: data.question,
                                    type: this.value,
                                },
                                dataType: 'json',
                                success: function(response){
                                    // $("#question-table").load(location.href + " #question-table");
                                    alert('Update done.');
                                    console.log(response);
                                },
                        });
                    });
                    
                }
            }
            
            
            const option = document.getElementsByClassName("option");
            var updateOptionRoute = "{{route('option.update', ":optionid")}}";
            var a;
            for(a=0;a<option.length;a++){
                $(option[a]).change(function(e){
                    var option_id = this.getAttribute("option-id");
                    updateOptionRoute = updateOptionRoute.replace(':optionid', option_id);
                    console.log(option_id);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: updateOptionRoute,
                        data: {
                            option: this.value,
                        },
                        dataType: "json",
                        success: function (response) {
                            console.log(response);
                            console.log('hello');
                        },
                        error: function(response){
                            console.log(response);
                        }
                    });
                    
                });
            }
            

            // Choose question type
            // const questionType = document.getElementsByClassName("questionType");
            const options = document.getElementsByClassName("option");
            var x, y=0;
            for(x=0;x<questionType.length;x++){
                questionType[x].addEventListener("change", function() {
                    console.log(quizUpdateRoute);
                    alert('hello');
                
                    var choice = this.nextElementSibling;
                        if(this.value == "True or false"){
                            choice.innerHTML =
                                `<form>
                                    <div class="row g-3">
                                        <div class="col-sm-9" style="width: 200px; text-align:left;">
                                            <div class="form-check" id="radio-row">
                                                <input class="form-check-input" type="radio" name="gridRadios" id="radio" value="option1"  checked>
                                                <label class="form-check-label" for="gridRadios1">
                                                    True
                                                </label>
                                            </div>
                                            <div class="form-check" id="radio-row">
                                                <input class="form-check-input" type="radio" name="gridRadios" id="radio" value="option1" checked>
                                                <label class="form-check-label" for="gridRadios1">
                                                    False
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </form>`;
                                
                        }
                        else if(this.value == "Multiple Choice"){
                            choice.innerHTML =
                                `Multiple Choice`;
                        }
                        else if(this.value == "Identification"){
                            choice.innerHTML =
                                `Identification`;
                        }
                });
            }

            const optionButton = document.getElementsByClassName("addOptionButton");
            var index;
            var optionCreateRoute = "{{route('option.create')}}";
            console.log(optionCreateRoute);
            for(index = 0; index < optionButton.length; index++){
                $(optionButton[index]).click(function(e){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                    });
                    $.ajax({
                        url: optionCreateRoute,
                        type: 'POST',
                        data: {
                            question_id: this.value,
                            option: 'Untitled option',
                        },
                        dataType: 'json',
                        success: function(data){
                            console.log('Option added');
                            console.log(data);
                        },
                        error: function(data){
                            console.log(data);
                            console.log('error');
                        },
                    });
                    $(document).ajaxStop(function(){
                        window.location.reload();
                    });
                });
            }


        });
        
</script>