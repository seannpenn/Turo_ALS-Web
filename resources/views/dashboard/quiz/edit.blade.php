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
                    <div class="col-sm-12">
                        <input type="text" style="height:50px;" class="form-control" name="quiz_title" id="quiz_title" value="{{$quiz->quiz_title}}">
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
                                <div class="card-header" style="background-color: orange;">
                                    question id: {{ $question->question_id }}
                                </div>
                                <div class="card-body " >
                                    <div class="row g-3 optionArea">
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control question_id" id="question_id" placeholder="Question" aria-label="Question" value="{{ $question->question_id }}" hidden>
                                            <input type="text" style="height:45px;" class="form-control question" id="question" placeholder="Question" aria-label="Question" value="{{ $question->question }}" question-id="{{$question->question_id}}">
                                        </div>
                                        <div class="col-sm-3">
                                            <select id="questionType" class="form-select questionType">
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach($types as $type)
                                                @if(($count == 1) and ($question->type <> $type->type_id))
                                                    <option value="{{ $type->type_id }}" selected>{{ $type->type_name }}</option>
                                                @elseif($question->type == $type->type_id)  
                                                    <option value="{{ $type->type_id }}" selected>{{ $type->type_name }}</option>
                                                @else
                                                    <option value="{{ $type->type_id }}">{{ $type->type_name  }}</option>
                                                @endif
                                                @php
                                                    $count++;
                                                @endphp
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class ="questionChoices" id="questionChoices">
                                            <form>
                                                @foreach($question->option as $option)

                                                <div class="input-group mb-3">
                                                    <div class="input-group flex-nowrap " id="optionArea">
                                                        @if($option->isCorrect == 1)
                                                            <span class="input-group-text" style="color:green; background-color:transparent;border-style: hidden;">
                                                                <img src="{{ asset('images/correct.png') }}"  alt="" width="20" height="20">
                                                            </span>
                                                        @endif
                                                        @if($question->type != 2)
                                                            <span class="input-group-text" id="addon-wrapping">
                                                                @if($question->type == 1)
                                                                    <input type="radio" value="{{$option->option_id}}" href="" aria-label="Checkbox for following text input" disabled>
                                                                @elseif($question->type == 3)
                                                                    <input type="checkbox" value="{{$option->option_id}}" aria-label="Checkbox for following text input" disabled>
                                                                @endif

                                                            </span>
                                                            <input type="text" class="form-control option" id="option" placeholder="Question" aria-label="Question" option-id = "{{$option->option_id}}" value="{{$option->option}}">
                                                        @endif

                                                        @if($question->type == 2)
                                                            <div class="col-sm-5">
                                                                <input type="text" style="border-top-style: hidden; border-right-style: hidden;border-left-style: hidden;" placeholder="Short answer text" class="form-control" aria-label="Question" value="">
                                                            </div>
                                                        @endif

                                                        
                                                        @if($question->type != 2)
                                                        <span class="input-group-text" style="background-color: transparent; ">
                                                            @if($option->isCorrect == 1)
                                                                <input type="checkbox" class="isCorrect" value="{{$option->option_id}}" aria-label="..." title="Set answer" checked>
                                                            @else
                                                            <input type="checkbox" class="isCorrect" value="{{$option->option_id}}" aria-label="..." title="Set answer" >
                                                            @endif
                                                        </span>
                                                        <span class="input-group-text" style="background-color: transparent;">
                                                            <button type="button" class="form-check-label deleteOption" style="border:none; background-color: transparent;" value="{{$option->option_id}}" title="Delete Option" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img src="{{ asset('images/close.png') }}" alt="" width="20" height="20"></button>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="row g-3">
                                                        <div class="col-sm-9" style="text-align:left;">
                                                            <div class="form-check">
                                                            @if($question->type != 2)
                                                                <button type="button" style="border:none; background-color: transparent;" class="addOptionButton" value="{{ $question->question_id }}"><img src="{{ asset('images/add.png') }}" alt="" width="20" height="20">Add option</button>
                                                            @endif
                                                            </div>
                                                        </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-end">
                                        <div class="d-flex justify-content-evenly" style="width: 200px;">
                                            <a class="setAnswer" title="Set Answer" value="{{ $question->question_id }}"><img src="{{ asset('images/answer.png') }}"  alt="" width="20" height="20"> Set answer</a>
                                            <button class="question-button deleteQuestion" style="background-color: transparent; border:none;" value="{{ $question->question_id }}" title="Delete Question" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="border:none;"><img src="{{ asset('images/delete.png') }}" alt="" width="20" height="20"></button>
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
            $(window).on('load', 
                deleteQuestion(),
                deleteOption(),
                getQuestion(),
                // loadQuestions(),
            );
            var isCorrect = document.getElementsByClassName('isCorrect');

            for(var i = 0; i < isCorrect.length; i++) {
                (function(index) {
                    isCorrect[index].addEventListener("click", function() {
                        if(this.checked == false){
                            alert('gwapo ko');
                            setAnswer(this.value, 0);
                        }
                        else{
                            alert('gwapo ko again');
                            setAnswer(this.value, 1);
                        }
                        
                    })
                })(i);
            }
            
            // get question
            function getQuestion(){
                const question = document.getElementsByClassName("questionContainer");
                var x;
                for(x=0;x<question.length;x++){
                    $(question[x]).click(function(e){
                        var getQuestionRoute = "{{ route('question.get', ":questionid") }}";
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
            }
            // await axios.post(`http://localhost:8000/api/products`, formData).then(({data})=>{
            // Swal.fire({
            //     icon:"success",
            //     text:data.message
            // })
            // navigate("/")
            // })
            
            // delete question
            function deleteQuestion(){
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
            }


            // delete option
                function deleteOption(){
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
                }

                function deleteAllOption(questionId){
                    var deleteAllOption = "{{route('option.deleteAll', ":questionid")}}";
                    deleteAllOption = deleteAllOption.replace(':questionid', questionId);
                    window.location.href = deleteAllOption;
                }
            
            

            //create question
            var questionCreateRoute = "{{route('question.create')}}";
            var quizId = {{request()->route('quizid')}};
            
            $("#createQuestion").click(function(e){
                e.preventDefault();
                console.log(questionCreateRoute);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                // $('#questions').html(`<div class="spinner-border" role="status">
                //                             <span class="visually-hidden">Loading...</span>
                //                             </div>`);
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
                        complete: function(response){
                            console.log('created successfully')
                        },
                        error: function(data){
                            console.log(data);
                        },
                });
                // $(document).ajaxStop(function(){
                //     window.location.reload();
                // });
                
            });

            

            //update quiz
            var quizId = "{{request()->route('quizid')}}";
            var quizUpdateRoute = "{{route('quiz.update', ":quizid") }}";
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
                        if(this.value == "2"){
                            deleteAllOption(data.question_id);
                            addOption(data.question_id);
                        }
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
                                    console.log(response);
                                },
                        });
                        $(document).ajaxStop(function(){
                            
                            window.location.reload();
                        });
                    });
                    
                }
            }
            
            // option update
            const option = document.getElementsByClassName("option");
            
            var a;
            for(a=0;a<option.length;a++){
                $(option[a]).on("change", function(e){
                    var option_id = this.getAttribute("option-id");
                    var updateOptionRoute = "{{route('option.update', ":optionid")}}";
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
                            },
                            error: function(response){
                                console.log(response);
                            }
                        });
                });
            }

            // set question answer
            function setAnswer(option_id, isCorrect){
                var setAnswer = "{{route('option.setAnswer', ":optionid")}}";
                setAnswer = setAnswer.replace(':optionid', option_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: setAnswer,
                    data: {
                        isCorrect: isCorrect,
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        console.log('success');
                    },
                    error: function(response){
                        console.log(response);
                    },
                });
                $(document).ajaxStop(function(){
                    window.location.reload();
                });
            }

            // Choose question type
            const questionType = document.getElementsByClassName("questionType");
            const options = document.getElementsByClassName("option");
            var x, y=0;
            for(x=0;x<questionType.length;x++){
                questionType[x].addEventListener("change", function() {
                    console.log(quizUpdateRoute);
                
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

            // add Option

                function addOption(questionId){
                    $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                }
                            });
                            $.ajax({
                                url: optionCreateRoute,
                                type: 'POST',
                                data: {
                                    question_id: questionId,
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
                }
            
                const optionButton = document.getElementsByClassName("addOptionButton");
                var index;
                var optionCreateRoute = "{{route('option.create')}}";
                
                for(index = 0; index < optionButton.length; index++){
                    $(optionButton[index]).click(function(e){
                        console.log(optionCreateRoute);
                        addOption(this.value);
                    });
                }
        });
        
</script>