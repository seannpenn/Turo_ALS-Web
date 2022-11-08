@extends('main')
@extends('dashboard/modals/createquestion_modal')
@extends('dashboard/modals/editquestion_modal')
@extends('dashboard/quiz/quizSettingsModal')
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
    .addOptionButton:hover{
        text-decoration: underline;
    }
@stop

@section('main-content')
@include('navbar/navbar_inside', ['courseId' => request()->route('courseid')])
    
    <div class="layout">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color:white;">
                <li class="breadcrumb-item"><a href="{{ route('quiz.manage',request()->route('courseid')) }}">Quiz list</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$selectedQuiz[0]->quiz_title}}</li>
            </ol>
        </nav>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Setup</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Student's answers</button>
                <button class="nav-link" id="nav-settings-tab" data-bs-toggle="tab" data-bs-target="#nav-settings" type="button" role="tab" aria-controls="nav-settings" aria-selected="false"><img src="{{ asset('images/settings.png') }}"  alt="" width="20" height="20"></button>        
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">@include('dashboard.quiz.editQuestions')</div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">@include('dashboard.quiz.studentAnswers')</div>
            <div class="tab-pane fade" id="nav-settings" role="tabpanel" aria-labelledby="nav-settings-tab" tabindex="0">
                @include('dashboard.quiz.settings')
            </div>
        </div>
    </div>
@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

        $(document).ready(function(){
            $(window).on('load', 
                deleteQuestion(),
                deleteOption(),
                getQuestion(),
                getQuestions()
                // loadQuestions(),
            );

            function getQuestions(){
                var route = "{{route('question.getAll', ":quizId")}}";
                var quizId = {{request()->route('quizid')}};

                route = route.replace(':quizId', quizId);
                $.ajax({
                    type: "GET",
                    url: route,
                    dataType: "json",
                    success: function (response) {
                        console.log('These are the questions');

                        $(response).each(function(index, value) {
                            console.log(`question${index}: ${this.question}`);
                            getOptions(this.question_id);
                        });
                        // displayQuestions(response);
                    },
                    error: function (response){
                        console.log(response);
                    }
                });
            }

            function getOptions(questionid) {
                
                var route = "{{route('option.getAll', ":questionid")}}";
                route = route.replace(':questionid', questionid);
                // axios.get(route)
                // .then((response) => {
                //     console.log(response.data);
                // });
                $.ajax({
                    type: "GET",
                    url: route,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        // displayQuestions(response);
                    },
                    error: function (response){
                        console.log(response);
                    }
                });
            }
            
            var isCorrect = document.getElementsByClassName('isCorrect');

            for(var i = 0; i < isCorrect.length; i++) {
                (function(index) {
                    isCorrect[index].addEventListener("click", function() {
                        if(this.checked == false){
                            setAnswer(this.value, 0);
                        }
                        else{
                            alert('Set this option as correct answer?');
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
                    $.ajax({
                        type: "get",
                        url: deleteAllOption,
                        dataType: "json",
                        success: function (response) {
                            console.log('Deleted all option');
                        }
                    });
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
                const points = document.getElementsByClassName("point");
                var questionUpdateRoute = "{{route('question.update', ":questionid")}}";
                var pointsUpdateRoute = "{{route('question.updatePoint', ":questionid")}}";
                var a;
                var temp;
                for(a=0;a<questions.length;a++){
                        $(points[a]).change(function(e){
                            
                            var questionId = this.getAttribute("question-id");
                            alert(questionId);
                            pointsUpdateRoute = pointsUpdateRoute.replace(':questionid', questionId);
                            $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            }
                            });
                            $.ajax({
                                type: "post",
                                url: pointsUpdateRoute,
                                data: {
                                    points: this.value,
                                },
                                dataType: "json",
                                success: function (response) {
                                    console.log('success');
                                    console.log(response);
                                },
                                error: function(response){
                                    console.log('error');
                                }
                            });
                        });
                        
                        $(questions[a]).change(function(e){
                            alert(this.value);
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
                                        console.log('question is updated');
                                        console.log(response);
                                    },
                                    error: function(data){
                                        console.log(data);
                                    }
                            });
                        });

                        $(questionType[a]).change(function(e){
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
                                        if(response == 2 || response == 4){
                                            deleteAllOption(data.question_id);
                                            addOption(data.question_id);
                                        }
                                        else{
                                            window.location.reload();
                                        }
                                        console.log('success');
                                    },
                                    error: function(response){
                                        console.log('error');
                                    }
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
                                    window.location.reload();
                                },
                                error: function(data){
                                    console.log(data);
                                    console.log('error');
                                },
                            });
                            // $(document).ajaxStop(function(){
                            //     window.location.reload();
                            // });
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