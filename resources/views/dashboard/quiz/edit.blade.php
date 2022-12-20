@extends('main')

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
    #qquestion-container:focus-within,  #qquestion-container:focus{
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
        text-decoration:underline;
        cursor: auto;
    }
@stop

@section('main-content')
    @include('navbar/navbar_inside', ['courseId' => request()->route('courseid')])
    @include('dashboard/modals/createquestion_modal')
    @include('dashboard/modals/editquestion_modal')
    @include('dashboard/quiz/quizSettingsModal')
    @include('modalslug')
    @include('dashboard/quiz/viewQuestion')

    <div class="layout">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color:white;">
                <li class="breadcrumb-item"><a href="{{ route('quiz.manage',request()->route('courseid')) }}">Quiz list</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$selectedQuiz[0]->quiz_title}}</li>
            </ol>
        </nav>
        <nav>
            <div class="nav nav-tabs" id="myTab" role="tablist">
                <button class="nav-link " id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="false">Setup</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Student's answers</button>
                <button class="nav-link" id="nav-settings-tab" data-bs-toggle="tab" data-bs-target="#nav-settings" type="button" role="tab" aria-controls="nav-settings" aria-selected="false"><img src="{{ asset('images/settings.png') }}"  alt="" width="20" height="20"></button>        
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                @include('dashboard.quiz.editQuestions')
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                @include('dashboard.quiz.studentAnswers')
                
            </div>
            <div class="tab-pane fade" id="nav-settings" role="tabpanel" aria-labelledby="settings-tab" tabindex="0">
                @include('dashboard.quiz.settings')
            </div>
        </div>
    </div>

    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        const toastLiveExample = document.getElementById('liveToast');
        const triggerTabList = document.querySelectorAll('#myTab button');
        
        
                $(document).ready(function(){
                    var activeTab = localStorage.getItem('activeTab');
                    console.log(activeTab);
                    triggerTabList.forEach(triggerEl => {
                        const tabTrigger = new bootstrap.Tab(triggerEl)
                        if($(triggerEl).attr('data-bs-target') === activeTab){
                            tabTrigger.show()
                        }
                    });

                    triggerTabList.forEach(triggerEl => {
                        const tabTrigger = new bootstrap.Tab(triggerEl)
                        triggerEl.addEventListener('click', event => {
                            localStorage.setItem('activeTab', $(triggerEl).attr('data-bs-target'));
                            tabTrigger.show()
                        })
                    });
                }); 

                    $('.closeQuestionModal').click(function () {
                        getAllQuestions();
                    });
        
                    function openQuestionModal(questionid){
                        var questionType;
                        var questionDetails;
                        var getQuestionRoute = "{{ route('question.get', ":questionid") }}";
                        getQuestionRoute = getQuestionRoute.replace(":questionid", questionid);
                        
                        
                        axios.get(getQuestionRoute).then((response)=>{
                            console.log(response);
                            questionType = `
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Question type: </label>
                                        <select class="form-select" id="selectType" question-id="${response.data.question_id}" style="margin:0 auto;">
                                `;
                                    var count = 1;
                                        var types = @json($types);
                                        for(x in types){
                                            if(count == 1 && `${response.data.type}` === types[x].type_id){
                                                questionType += `
                                                    <option value="${types[x].type_id}" selected> ${types[x].type_name} </option>
                                                `;
                                            }
                                            else if(`${response.data.type}` == `${types[x].type_id}`){
                                                questionType += `
                                                    <option value="${types[x].type_id}" selected> ${types[x].type_name}</option>
                                                `;
                                            }
                                            else{
                                                questionType += `
                                                    <option value="${types[x].type_id}"> ${types[x].type_name} </option>
                                                `;
                                            }
                                            count++;
                                        }
                                        
                            questionType += `
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="point" class="form-label">Points: </label>
                                    <input type="text" class="form-control" question-id="${response.data.question_id}" id="point" value="${response.data.points}" style="width:50%;">
                                </div>
                                `;
                            questionContent = `
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Question:</label>
                                    <textarea class="form-control question" question-id="${response.data.question_id}">${response.data.question}
                                    </textarea>
                                </div>
                            `;
                            
                                document.getElementsByClassName('questionInfo')[0].innerHTML = `
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                `;
                                document.getElementsByClassName('questionContent')[0].innerHTML = `
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                `;
                                $('#viewQuestion').modal('toggle');
                                document.getElementsByClassName('questionInfo')[0].innerHTML = questionType;
                                document.getElementsByClassName('questionContent')[0].innerHTML = questionContent;
                                getOptions(response);
                                
                        });
                            
                    }

                    // change question type
                    $(document).on('change','#selectType',function(){
                        var questionId = this.getAttribute("question-id");
                        var questionUpdateRoute = "{{route('question.update', ":questionid")}}";
                            questionUpdateRoute = questionUpdateRoute.replace(':questionid', questionId);
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
                                        question: $('.question').val(),
                                        type: this.value,
                                        points: $('#point').val(),
                                    },
                                    dataType: 'json',
                                    success: function(response){
                                        console.log('question is updated');
                                        var getQuestionRoute = "{{ route('question.get', ":questionid") }}";
                                        getQuestionRoute = getQuestionRoute.replace(":questionid", response.question_id);

                                        if(response.type == 2 || response.type == 4){
                                            deleteAllOption(response.question_id);
                                        }

                                        axios.get(getQuestionRoute).then((questionResponse) =>{
                                            getOptions(questionResponse);
                                        });
                                        console.log(response);
                                    },
                                    error: function(data){
                                        console.log('question is not updated');
                                        console.log(data);
                                    }
                            });
                    });

                    $(document).on('click','.isCorrect',function(){
                        var index = $('.isCorrect').index(this);
                        if(this.checked == false){
                            setAnswer(this.value, 0);
                        }
                        else{
                            alert('Set this option as correct answer?');
                            setAnswer(this.value, 1);
                        }
                    });

                    // set answer function
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
                                var getQuestionRoute = "{{ route('question.get', ":questionid") }}";
                                getQuestionRoute = getQuestionRoute.replace(":questionid", response.question_id);
                                console.log(response);
                                console.log('success');
                                axios.get(getQuestionRoute).then((questionResponse) =>{
                                    getOptions(questionResponse);
                                });
                                
                            },
                            error: function(response){
                                console.log(response);
                            },
                        });
                    }
                    // change question
                    $(document).on('change','.question, #point',function(){
                        
                        var questionid = this.getAttribute('question-id');
                        var questionUpdateRoute = "{{route('question.update', ":questionid")}}";
                            questionUpdateRoute = questionUpdateRoute.replace(':questionid', questionid);
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
                                        question: $('.question').val(),
                                        type: $('#selectType').val(),
                                        points: $('#point').val(),
                                    },
                                    dataType: 'json',
                                    success: function(response){
                                        alert('Question updated.')
                                        var getQuestionRoute = "{{ route('question.get', ":questionid") }}";
                                        getQuestionRoute = getQuestionRoute.replace(":questionid", response.question_id);

                                        if(response.type == 2 || response.type == 4){
                                            deleteAllOption(response.question_id);
                                        }

                                        axios.get(getQuestionRoute).then((questionResponse) =>{
                                            getOptions(questionResponse);
                                        });
                                        console.log(response);
                                    },
                                    error: function(data){
                                        console.log('question is not updated');
                                        console.log(data);
                                    }
                            });
                    });

            
            function getOptions(response){
                var getOptionRoute = "{{ route('option.getAll', ":questionid") }}";
                getOptionRoute = getOptionRoute.replace(":questionid", response.data.question_id);
                var options = `<p>Options:</p>`;
                axios.get(getOptionRoute).then((optionResponse)=>{
                        
                        for(index in optionResponse.data){
                            console.log(optionResponse.data[index]);
                            options += printOptions(optionResponse.data[index], response.data);
                        }
                        
                        if(`${response.data.type}` != 2 && `${response.data.type}` != 4){
                            options +=`
                                <div class="row">
                                        <div class="form-check">
                                            <button type="button" onclick="addOption(${response.data.question_id})" style="border:none; background-color: transparent;" class="addOptionButton" value="${response.data.question_id}"><img src="{{ asset('images/add.png') }}" alt="" width="20" height="20"> Add option</button>
                                        </div>
                                </div>
                            `;
                        }
                        else if(`${response.data.type}` == 2){
                            options += `
                                <div class="row g-3">
                                    <div class="col-sm-9" style="text-align:left;">
                                        <div class="form-check">
                                            <p class="fs-6 fw-bold">Set answer by using comma (,) as separator.</p>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }

                        $(".optionsContainer").html(options);
                    });
            }
            function printOptions(data, question){
                var optionHtml;
                optionHtml = `
                    <div class="input-group mb-3">
                        <div class="input-group flex-nowrap " id="optionArea">

                `;
                if(`${data.isCorrect}` == 1){
                    optionHtml +=`
                        <span class="input-group-text" style="color:green; background-color:transparent;border-style: hidden;">
                            <img src="{{ asset('images/correct.png') }}"  alt="" width="20" height="20">
                        </span>
                    `;
                }

                if(question.type != 2 && question.type !=4){
                    if(question.type == 1){
                        optionHtml += `
                            <span class="input-group-text" id="addon-wrapping">
                                <input type="radio" value="${data.option_id}" href="" aria-label="Checkbox for following text input" disabled>
                            </span>
                            <input type="text" class="form-control option" id="option" placeholder="Question" aria-label="Question" option-id = "${data.option_id}" value="${data.option}">
                            
                        `;
                    }
                    else if(question.type == 3){

                        optionHtml +=`
                            <span class="input-group-text" id="addon-wrapping">
                                <input type="checkbox" value="${data.option_id}" aria-label="Checkbox for following text input" disabled>
                            </span>
                            <input type="text" class="form-control option" id="option" placeholder="Question" aria-label="Question" option-id = "${data.option_id}" value="${data.option}">
                            
                        
                        `;
                    }      
                }else if(question.type == 2){
                    if(`${data.isCorrect}` == 1){
                            optionHtml +=
                            `
                            <input type="text" class="form-control option" option-id = "${data.option_id}" value="${data.option}" style="border-top-style: hidden; border-right-style: hidden;border-left-style: hidden;" placeholder="Input question answer here" class="form-control" aria-label="Question" value="">

                            <span class="input-group-text" style="background-color: transparent; border: none;">
                                <input type="checkbox" class="isCorrect" value="${data.option_id}" aria-label="..." title="Set answer" checked>
                            </span>
                            <span class="input-group-text" style="background-color: transparent;border: none;">
                                <button type="button" class="form-check-label deleteOption" style="border:none; background-color: transparent;" value="${data.option_id}" title="Delete Option" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img src="{{ asset('images/close.png') }}" alt="" width="20" height="20"></button>
                            </span>
                        </div>
                            `;
                        }else{
                            optionHtml +=`
                            <input type="text" class="form-control option" option-id = "${data.option_id}" value="${data.option}" style="border-top-style: hidden; border-right-style: hidden;border-left-style: hidden;" placeholder="Input question answer here" class="form-control" aria-label="Question" value="">

                            <span class="input-group-text" style="background-color: transparent; border: none;">
                                <input type="checkbox" class="isCorrect" value="${data.option_id}" aria-label="..." title="Set answer">
                            </span>
                            <span class="input-group-text" style="background-color: transparent;border: none;">
                                <button type="button" class="form-check-label deleteOption" style="border:none; background-color: transparent;" value="${data.option_id}" title="Delete Option" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img src="{{ asset('images/close.png') }}" alt="" width="20" height="20"></button>
                            </span>
                        </div>
                            `;
                        }
                    
                }
                else if(question.type == 4){
                    optionHtml += `
                        <textarea class="form-control" placeholder="Paragraph Answer" id="floatingTextarea" rows="5" disabled></textarea>
                        </div>
                    `;
                }

                if(question.type != 2 && question.type !=4){
                    if(`${data.isCorrect}` == 1){
                        optionHtml += `<span class="input-group-text" style="background-color: transparent; ">
                            <input type="checkbox" class="isCorrect" value="${data.option_id}" aria-label="..." title="Set answer" checked>
                        </span>
                        <span class="input-group-text" style="background-color: transparent;">
                            <button type="button" class="form-check-label" style="border:none; background-color: transparent;" value="${data.option_id}" title="Delete Option" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img src="{{ asset('images/close.png') }}" alt="" width="20" height="20"></button>
                        </span>
                    </div>
                        `;
                    }
                    else{
                        optionHtml += `
                        <span class="input-group-text" style="background-color: transparent; ">
                            <input type="checkbox" class="isCorrect" value="${data.option_id}" aria-label="..." title="Set answer">
                        </span>
                        <span class="input-group-text" style="background-color: transparent;">
                            <button type="button" onclick="deleteOption(${data.option_id})" class="form-check-label" style="border:none; background-color: transparent;" value="${data.option_id}" title="Delete Option" ><img src="{{ asset('images/close.png') }}" alt="" width="20" height="20"></button>
                        </span>
                    </div>
                        `;
                    }
                }

                
                optionHtml +=`
                    </div>
                </div>
                `;

                return optionHtml;
            }

            function addOption(questionid){
                var rowIdx = 0;
                var optionCreateRoute = "{{route('option.create')}}";
                    axios.post(optionCreateRoute,{
                        question_id: questionid,
                        option: 'Untitled option',
                    }).then(function (response){
                        console.log('option added');
                        const toast = new bootstrap.Toast(toastLiveExample)
                        toast.show();
                        console.log(response.data);
                        var getQuestionRoute = "{{ route('question.get', ":questionid") }}";
                        getQuestionRoute = getQuestionRoute.replace(":questionid", response.data.question_id);

                        axios.get(getQuestionRoute).then((questionResponse) =>{
                            getOptions(questionResponse);
                        });
                        
                    })
            }
            function deleteOption(optionid){
                var deleteOptionRoute = "{{route('option.delete', ":optionid")}}";
                deleteOptionRoute = deleteOptionRoute.replace(':optionid', optionid);
                    $.ajax({
                        type: "get",
                        url: deleteOptionRoute,
                        dataType: "json",
                        success: function (response) {
                            console.log('Hello sound check');
                            console.log(response);
                            var getQuestionRoute = "{{ route('question.get', ":questionid") }}";
                            getQuestionRoute = getQuestionRoute.replace(":questionid", response.question_id);

                            axios.get(getQuestionRoute).then((questionResponse) =>{
                                getOptions(questionResponse);
                            });
                        },
                        error: function (response){
                            console.log(response);
                        }
                    });     

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
                        addOption(response.question_id);
                    },
                    error: function (response){
                        console.log(response);
                        console.log('unsuccessful');
                    }
                });
            }
            function deleteQuestion(questionId, index){
                // alert('delete button clicked' + question);
                var deleteQuestionRoute = "{{route('question.delete', ":questionid")}}";
                deleteQuestionRoute = deleteQuestionRoute.replace(':questionid', questionId);
            
                $.ajax({
                    type: "get",
                    url: deleteQuestionRoute,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        console.log('question deleted successfully');
                        getAllQuestions();
                    },
                    error: function (response){
                        console.log(response);
                        console.log('question deleted unsuccessfully');
                    }
                });
                // ducoment.getElementsByClassName('deleteQuestionButton');
                // var b;
            }

        

            function getAllQuestions(){
                var route = "{{route('question.getAll', ":quizId")}}";
                var quizId = {{request()->route('quizid')}};
                route = route.replace(':quizId', quizId);

                axios.get(route)
                .then( (response) => {
                    printQuestions(response.data);
                });
            }
            function printQuestions(questions){
                var questionsHTML;
                for(index in questions){
                    questionsHTML += `
                            <tr>
                                <th scope="row">${questions[index].question_id}</th>
                                <td>${questions[index].question}</td>
                                <td>
                            `
                            var count = 1;
                            var types = @json($types);
                            for(x in types){
                                if(questions[index].type === types[x].type_id){
                                    questionsHTML += `
                                        ${types[x].type_name}
                                    `;
                                    break;
                                }
                            }
                            
                                        
                    questionsHTML += `
                                </td>   
                                <td>test</td>
                                <td>
                                    <button class="btn btn-warning" onclick="openQuestionModal(${questions[index].question_id})" style="background-color:lightgreen;border: 1px solid lightgreen;"><img src="{{ asset('images/edit.png') }}" alt="" width="20" height="20"></button>
                                    <button class="question-button deleteQuestionButton" onclick = "deleteQuestion(${questions[index].question_id}, ${index})" style="background-color: transparent; border:none;" value="${questions[index].question_id} " title="Delete Question" style="border:none;"><img src="{{ asset('images/delete.png') }}" alt="" width="25" height="25"></button>
                                </td>
                            </tr>
                    `;
                }

                $('#tbody').html(questionsHTML);
            }
        $(function(){
            // delete question
            
            
            // var rowIdx = 0;
            // $('#addBtn').on('click', function () {
  
            // // Adding a row inside the tbody.
            // $('#tbody').append(`<tr id="R${++rowIdx}">
            //     <td class="row-index text-center">
            //     <p>Row ${rowIdx}</p>
            //     </td>
            //         <td class="text-center">
            //         <button class="btn btn-danger remove"
            //             type="button">Remove</button>
            //         </td>
            //         </tr>`);
            // });
            
            $(window).on('load', 
                // deleteOption(),
                getAllQuestions(),
                // getQuestion(),
                // getQuestions(),
                // loadQuestions(),
            );
            // $selectedQuiz[0]->question as $key => $question
            
            // for settings tab
            $("#saveSettings").click(function (event) {
                var routeUpdateSettings = "/teacher/course/" + "{{request()->route('courseid')}}" + "/quiz/setup/" + "{{request()->route('quizid')}}";
                var formData = {
                    'start_date' : $('#start_date').val(),
                    'end_date' : $('#end_date').val(),
                    'start_time' : $('#start_time').val(),
                    'end_time' : $('#end_time').val(),
                    'attempts' : $('#attempts').val(),
                    'password' : $('#password').val(),
                    'releaseGrades' : $('#releaseGrades').is(':checked') ? 1:0,
                    'duration' : [$('#duration1').val(), $('#duration2').val()],
                };
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                });
                $.ajax({
                    type: "POST",
                    url: routeUpdateSettings,
                    data: formData,
                    dataType: 'json',
                    success: function(response){

                        alert('Update done.');
                        console.log(response);
                    },
                    error: function(data){
                        const toast = new bootstrap.Toast(toastLiveExample)
                        toast.show()
                        console.log(data);
                    },

                });
            });
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
                                // updateQuestion(response[0]);
                                console.log(response);
                            },
                            error: function(response){
                                console.log(response);
                            }
                        });
                    });
                }
            }

            


            // delete option
                // function deleteOption(){
                //     var deleteOptionRoute = "{{route('option.delete', ":optionid")}}";
                //     const deleteOption = document.getElementsByClassName("deleteOption");
                //     var a;
                //     for(a=0;a<deleteOption.length;a++){
                //         $(deleteOption[a]).click(function(e){
                //             var option_id = this.value;
                //             deleteOptionRoute = deleteOptionRoute.replace(':optionid', option_id);
                //             console.log(option_id);
                //             $("#confirmTask").click(function(e){
                //                 window.location.href = deleteOptionRoute;
                //             });
                //         });
                //     }
                // }

                
            
            

            //create question
            var questionCreateRoute = "{{route('question.create')}}";
            var quizId = {{request()->route('quizid')}};
            
            $("#addBtn").click(function(e){
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
                            
                            // console.log(response);
                        },
                        complete: function(response){
                            getAllQuestions();
                            console.log('created successfully');
                        },
                        error: function(data){
                            console.log(data);
                        },
                });
                // $(document).ajaxStop(function(){
                //     window.location.reload();
                // });
                
            });

            

            // //update quiz
            // var quizId = "{{request()->route('quizid')}}";
            // var quizUpdateRoute = "{{route('quiz.update', ":quizid")}}";
            // quizUpdateRoute = quizUpdateRoute.replace(':quizid', quizId);

            //     $("#quiz_title").change(function(e){
            //         var updatedQuizTitle = $("#quiz_title").val();
            //         console.log(quizUpdateRoute);
            //         $.ajaxSetup({
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            //             }
            //         });
            //         $.ajax({
            //                 url: quizUpdateRoute,
            //                 type: 'POST',
            //                 data: {
            //                     quiz_title: updatedQuizTitle,
            //                 },
            //                 dataType: 'json',
            //                 success: function(response){
            //                     $("#question-table").load(location.href + " #question-table");
            //                     alert('Update done.');
            //                     console.log(response);
            //                 },
            //                 error: function(data){
            //                     console.log(data);
            //                 }
            //         });
            //     });

            // // update question
            // function updateQuestion(data){
            //     const questionId = document.getElementsByClassName("question_id");
            //     const questions = document.getElementsByClassName("question");
            //     const questionType = document.getElementsByClassName("questionType");
            //     const points = document.getElementsByClassName("point");
            //     var questionUpdateRoute = "{{route('question.update', ":questionid")}}";
            //     var pointsUpdateRoute = "{{route('question.updatePoint', ":questionid")}}";
            //     var a;
            //     var temp;
            //     for(a=0;a<questions.length;a++){
            //             $(points[a]).change(function(e){
                            
            //                 var questionId = this.getAttribute("question-id");
            //                 alert(questionId);
            //                 pointsUpdateRoute = pointsUpdateRoute.replace(':questionid', questionId);
            //                 $.ajaxSetup({
            //                 headers: {
            //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            //                 }
            //                 });
            //                 $.ajax({
            //                     type: "post",
            //                     url: pointsUpdateRoute,
            //                     data: {
            //                         points: this.value,
            //                     },
            //                     dataType: "json",
            //                     success: function (response) {
            //                         console.log('success');
            //                         console.log(response);
            //                     },
            //                     error: function(response){
            //                         console.log('error');
            //                     }
            //                 });
            //             });
                        
            //             $(questions[a]).change(function(e){
            //                 alert(this.value);
            //                 var questionId = this.getAttribute("question-id");
            //                 questionUpdateRoute = questionUpdateRoute.replace(':questionid', questionId);
            //                 $.ajaxSetup({
            //                 headers: {
            //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            //                 }
            //                 });
            //                 $.ajax({
            //                         url: questionUpdateRoute,
            //                         type: 'POST',
            //                         data: {
            //                             question: this.value,
            //                             type: data.type,
            //                         },
            //                         dataType: 'json',
            //                         success: function(response){
            //                             console.log('question is updated');
            //                             console.log(response);
            //                         },
            //                         error: function(data){
            //                             console.log(data);
            //                         }
            //                 });
            //             });

            //             $(questionType[a]).change(function(e){
            //                 questionUpdateRoute = questionUpdateRoute.replace(':questionid', data.question_id);
            //                 $.ajaxSetup({
            //                     headers: {
            //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            //                     }
            //                 });
                            
            //                 $.ajax({
            //                         url: questionUpdateRoute,
            //                         type: 'POST',
            //                         data: {
            //                             question: data.question,
            //                             type: this.value,
            //                         },
            //                         dataType: 'json',
            //                         success: function(response){
            //                             if(response == 2 || response == 4){
            //                                 deleteAllOption(data.question_id);
            //                                 addOption(data.question_id);
            //                             }
            //                             else{
            //                                 window.location.reload();
            //                             }
            //                             console.log('success');
            //                         },
            //                         error: function(response){
            //                             console.log('error');
            //                         }
            //                 });
            //             });
                    
            //     }
            // }
            
            // // option update
            // const option = document.getElementsByClassName("option");
            
            // var a;
            // for(a=0;a<option.length;a++){
            //     $(option[a]).on("change", function(e){
            //         var option_id = this.getAttribute("option-id");
            //         var updateOptionRoute = "{{route('option.update', ":optionid")}}";
            //         updateOptionRoute = updateOptionRoute.replace(':optionid', option_id);
            //         console.log(option_id);
            //             $.ajaxSetup({
            //                 headers: {
            //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                 }
            //             });
            //             $.ajax({
            //                 type: "POST",
            //                 url: updateOptionRoute,
            //                 data: {
            //                     option: this.value,
            //                 },
            //                 dataType: "json",
            //                 success: function (response) {
            //                     console.log(response);
            //                 },
            //                 error: function(response){
            //                     console.log(response);
            //                 }
            //             });
            //     });
            // }

            // set question answer
            

            // // Choose question type
            // const questionType = document.getElementsByClassName("questionType");
            // const options = document.getElementsByClassName("option");
            // var x, y=0;
            // for(x=0;x<questionType.length;x++){
            //     questionType[x].addEventListener("change", function() {
            //         console.log(quizUpdateRoute);
                
            //         var choice = this.nextElementSibling;
            //             if(this.value == "True or false"){
            //                 choice.innerHTML =
            //                     `<form>
            //                         <div class="row g-3">
            //                             <div class="col-sm-9" style="width: 200px; text-align:left;">
            //                                 <div class="form-check" id="radio-row">
            //                                     <input class="form-check-input" type="radio" name="gridRadios" id="radio" value="option1"  checked>
            //                                     <label class="form-check-label" for="gridRadios1">
            //                                         True
            //                                     </label>
            //                                 </div>
            //                                 <div class="form-check" id="radio-row">
            //                                     <input class="form-check-input" type="radio" name="gridRadios" id="radio" value="option1" checked>
            //                                     <label class="form-check-label" for="gridRadios1">
            //                                         False
            //                                     </label>
            //                                 </div>
            //                             </div>
            //                         </div>
            //                     </form>`;
                                
            //             }
            //             else if(this.value == "Multiple Choice"){
            //                 choice.innerHTML =
            //                     `Multiple Choice`;
            //             }
            //             else if(this.value == "Identification"){
            //                 choice.innerHTML =
            //                     `Identification`;
            //             }
            //     });
            // }

            // add Option

            

            const addOption = document.getElementsByClassName('addOptionButton');
            const optionArea = document.getElementsByClassName('questionChoices');
            function testOnly(index){
                alert('Im alive');
            }
            for(var a=0; a<addOption.length; a++){
                addOption[a].addEventListener("click",function() {
                    var optionCreateRoute = "{{route('option.create')}}";
                    var index = this.getAttribute('question-key');
                    var questionType = this.getAttribute('question-type');
                    var htmlContent;
                    alert(index);
                    axios.post(optionCreateRoute,{
                        question_id: this.value,
                        option: 'Untitled option',
                    }).then(function (response){
                        console.log(response.data);
                        
                    })
                        // $.ajaxSetup({
                        //     headers: {
                        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        //     }
                        // });
                        // $.ajax({
                        //     url: optionCreateRoute,
                        //     type: 'POST',
                        //     data: {
                        //         question_id: this.value,
                        //         option: 'Untitled option',
                        //     },
                        //     dataType: 'json',
                        //     success: function(data){
                        //         // console.log('Option added');
                        //         console.log(data);
                        //         optionArea[index].innerHTML += `${data.option}`;
                        //         // window.location.reload();
                        //     },
                        //     error: function(data){
                        //         console.log(data);
                        //         console.log('error');
                        //     },
                        // });
                });
            }

                // function addOption(questionId){
                    
                //     const optionArea = document.getElementsByClassName('questionChoices');
                //     $.ajaxSetup({
                //                 headers: {
                //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                //                 }
                //             });
                //             $.ajax({
                //                 url: optionCreateRoute,
                //                 type: 'POST',
                //                 data: {
                //                     question_id: questionId,
                //                     option: 'Untitled option',
                //                 },
                //                 dataType: 'json',
                //                 success: function(data){
                //                     console.log('Option added');
                //                     console.log(data);
                //                     window.location.reload();
                //                 },
                //                 error: function(data){
                //                     console.log(data);
                //                     console.log('error');
                //                 },
                //             });
                // }
            
            //     const optionButton = document.getElementsByClassName("addOptionButton");
            //     var index;
            //     var optionCreateRoute = "{{route('option.create')}}";
                
            //     for(index = 0; index < optionButton.length; index++){
            //         $(optionButton[index]).click(function(e){
            //             console.log(optionCreateRoute);
            //             addOption(this.value);
            //         });
            //     }
        });
</script>

@stop
