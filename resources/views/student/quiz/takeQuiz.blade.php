@extends('main')

@section('css-style')
    .layout{
        max-width: 1200px;
        margin: 0 auto;
    }
    .container{
        max-width: 1500px;
        margin: 50px auto;
    }
    #quizContainer{
        zoom: 120%;
    }
@stop

@section('main-content')
@include('navbar/navbar_inside', ['courseId' => request()->route('courseid'), 'topiccontentid' => request()->route('topiccontentid')])
   
        

    <div class="container" id="quizContainer">    
            
        <div class="row justify-content-center" style=" max-width: 1000px; margin: 0 auto;">
            <nav class="navbar" style="margin-bottom: 20px;">
                <div class="container-fluid">
                    <div class="d-flex ">
                        <div class="row">
                            <div class="col-auto" >
                            @php
                                $duration = $chosenQuiz->duration;
                                $hours = intdiv($duration, 60);
                                $minutes = $duration%60;
                            @endphp
                                @if($minutes > 0)
                                <div class="p-2 border bg-light">Time limit: {{$hours}} hour and {{$minutes}} minutes.</div>
                                @else
                                <div class="p-2 border bg-light">Time limit: {{$hours}} hour</div>
                                @endif
                            </div>
                            <div class="col-auto">
                                <div class="p-2 border bg-light">
                                    <div class="time"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        <div class="d-flex" style="font-size: larger;">
            <div class="nav flex-column nav-pills me-3 " id="v-pills-tab" role="tablist" aria-orientation="vertical" style="margin: 0 auto;">
                @foreach($questions as $index => $question)
                    @if($index == 0)
                        <button class="nav-link active " id="{{$question->question_id}}-tab" data-bs-toggle="pill" data-bs-target="#question-{{$question->question_id}}" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">{{$index+1}}</button>
                    @else
                        <button class="nav-link " id="{{$question->question_id}}-tab" data-bs-toggle="pill" data-bs-target="#question-{{$question->question_id}}" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">{{$index+1}}</button>
                    @endif
                @endforeach
            </div>
        <form class="needs-validation" action="{{ route('student.storeAnswers', [request()->route('courseid'), request()->route('quizid')])}}" method="post" style="width: 80%; margin: 0 auto;">
                {{ csrf_field() }}

                <div class="modal fade" id="quizTimeUp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Attention!</h1>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            <div class="tab-content" id="v-pills-tabContent">
            
                @foreach($questions as $index => $question)
                    @if($index == 0)
                        <div class="tab-pane fade active show" id="question-{{$question->question_id}}" role="tabpanel" aria-labelledby="{{$question->question_id}}-tab" tabindex="0">
                            <div class="card mb-3">
                                            
                                            <div class="card-header d-flex">{{$index+1}}.) {{  $question->question }} 
                                                <div class="session-status" style="margin-left:5px;">
                                                    
                                                </div>
                                                    
                                            </div>
                        
                                            <div class="card-body">
                                                @foreach($question->option as $option)
                                                    <div class="form-check">
                                                        @if($question->type != 2 && $question->type != 4)
                                                            @if($question->type == 1)
                                                                @php
                                                                    $sessionKey = "Attempt-".$chosenQuiz->quizAttempt->last()->attempt_id."-Question-".$question->question_id;
                                                                @endphp
                                                                <input class="form-check-input optionAnswer" type="radio" question-type = "{{ $question->type }}" name="questions[{{ $question->question_id }}]" question-index = "{{$index}}" id="optionAnswer" questionid = "{{ $question->question_id }}" value="{{ $option->option_id }}"  required
                                                                    @if( Session($sessionKey)  == $option->option_id)
                                                                        checked 
                                                                    @endif
                                                                >
                                                                
                                                            @elseif($question->type == 3)
                                                                @php
                                                                    $sessionKey = "Attempt-".$chosenQuiz->quizAttempt->last()->attempt_id."-Option-".$option->option_id;
                                                                    $session = Session($sessionKey);
                                                                @endphp
                                                                <input class="form-check-input optionAnswer"  type="checkbox" name="options[{{ $option->option_id}}]" optionid = "{{ $option->option_id}}"  question-index = "{{$index}}" id="exampleRadios2" question-type = "{{$question->type}}" value="{{$question->question_id}}" 
                                                                    @if( $session == $option->option_id )
                                                                        checked 
                                                                    @endif
                                                                >
                                                            @endif
                                                            <label class="form-check-label " for="{{$question->question_id}}">
                                                                {{ $option->option }}
                                                            </label>
                                                        @endif
                                                    </div>
                                                    @if($question->type == 2)
                                                        @php
                                                            $sessionKey = "Attempt-".$chosenQuiz->quizAttempt->last()->attempt_id."-Question-".$question->question_id;
                                                            
                                                        @endphp
                                                        <input class="form-control optionAnswer" type="text" name="questions[{{ $question->question_id }}]" question-index = "{{$index}}" id="optionAnswer"  style="border-top-style: hidden; border-right-style: hidden;border-left-style: hidden;" optionid = "{{ $option->option_id}}" questionid = "{{ $question->question_id }}" question-type = "{{$question->type}}" placeholder="Short answer text" class="form-control" aria-label="Question"  required
                                                        @if(Session::has($sessionKey))
                                                            value="{{Session::get($sessionKey)[1]}}"
                                                        @else
                                                            value =""
                                                        @endif
                                                        >
                                                        @break
                                                    @endif
                                                    @if($question->type == 4)
                                                        <textarea class="form-control optionAnswer" name="questions[{{ $question->question_id }}]" question-index = "{{$index}}" question-type = "{{$question->type}}" placeholder="Enter your answer here..." id="optionAnswer" rows="5" required></textarea>                                                                
                                                    @endif
                                                @endforeach
                                            </div>

                                            <div class="form-group row mb-0">
                                
                            </div>
                            </div>
                            
                        </div>
                    @else
                        <div class="tab-pane fade" id="question-{{$question->question_id}}" role="tabpanel" aria-labelledby="{{$question->question_id}}-tab" tabindex="0">
                            <div class="card mb-3">
                                            
                                            <div class="card-header d-flex">{{$index+1}}.) {{  $question->question }} 
                                                <div class="session-status" style="margin-left:5px;">
                                                    
                                                </div>
                                            </div>
                        
                                            <div class="card-body">
                                                @foreach($question->option as $option)
                                                    <div class="form-check">
                                                        @if($question->type != 2 && $question->type != 4)
                                                            @if($question->type == 1)
                                                                @php
                                                                    $sessionKey = "Attempt-".$chosenQuiz->quizAttempt->last()->attempt_id."-Question-".$question->question_id;
                                                                @endphp
                                                                <input class="form-check-input optionAnswer" type="radio" name="questions[{{ $question->question_id }}]" question-index = "{{$index}}" id="optionAnswer" questionid = "{{ $question->question_id }}" value="{{ $option->option_id }}" question-type = "{{ $question->type }}"  required
                                                                    @if( Session($sessionKey)  == $option->option_id)
                                                                        checked 
                                                                    @endif
                                                                >
                                                                
                                                            @elseif($question->type == 3)
                                                                @php
                                                                    $sessionKey = "Attempt-".$chosenQuiz->quizAttempt->last()->attempt_id."-Option-".$option->option_id;
                                                                    $session = Session($sessionKey);
                                                                @endphp
                                                                <input class="form-check-input optionAnswer"  type="checkbox" name="options[{{ $option->option_id}}]" optionid = "{{ $option->option_id}}"  question-index = "{{$index}}" id="exampleRadios2" question-type = "{{$question->type}}" value="{{$question->question_id}}"
                                                                    @if( $session == $option->option_id )
                                                                        checked 
                                                                    @endif
                                                                >
                                                            @endif
                                                            <label class="form-check-label " for="{{$question->question_id}}">
                                                                {{ $option->option }}
                                                            </label>
                                                        @endif
                                                    </div>
                                                    @if($question->type == 2)
                                                        @php
                                                            $sessionKey = "Attempt-".$chosenQuiz->quizAttempt->last()->attempt_id."-Question-".$question->question_id;
                                                        @endphp
                                                        <input class="form-control optionAnswer" type="text" name="questions[{{ $question->question_id }}]" question-index = "{{$index}}" id="optionAnswer"  style="border-top-style: hidden; border-right-style: hidden;border-left-style: hidden;" optionid = "{{ $option->option_id}}" questionid = "{{ $question->question_id }}" question-type = "{{$question->type}}" placeholder="Short answer text" class="form-control" aria-label="Question"  required
                                                        @if(Session::has($sessionKey))
                                                            value="{{Session::get($sessionKey)[1]}}"
                                                        @else
                                                            value =""
                                                        @endif
                                                        >
                                                        @break
                                                    @endif
                                                    @if($question->type == 4)
                                                        <textarea class="form-control optionAnswer" name="questions[{{ $question->question_id }}]" question-index = "{{$index}}" question-type = "{{$question->type}}" placeholder="Enter your answer here..." id="optionAnswer" rows="5" required></textarea>                                                                
                                                    @endif
                                                @endforeach
                                            </div>
                            </div>
                            @if($questions->count()-1 == $index)
                                <nav class="navbar fixed-bottom navbar-dark"  style="box-shadow: 0 4px 20px rgb(0 0 0 / 0.2); zoom: 100%;">
                                    <div class="container-fluid" id="submitQuizButton" style="width: 50%;">
                                        <button class="btn btn-warning" type="submit" style="background-color: orange; color:white;">Submit</button>
                                    </div>
                                </nav>
                                <!-- <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div> -->
                            @endif
                        </div>
                    @endif
                @endforeach
                
            </div>
        </form>
        </div>
        
        </div>
        
    </div>

    <script>
        // $(window).blur(function() {
        //     alert('You are accessing another page! Mr Bandalan and Mr Gadiane is watching!!');
        // });

        $(document).ready(function(){
            
            // $time = explode(':' )
            var time = "{{$chosenQuiz->duration}}";
            
            var hours = time/ 60;
            var hoursDoubDig = 0;
            var minutes = time%60;
            var minDoubDig = minutes.toString().padStart(2, '0');
            var minDoubDig = 0;
            $('.time').text(hoursDoubDig + ':' + minDoubDig + ':00 time left');
            var seconds = 5;
            // console.log(hours);
            // console.log(minutes);
            
            time = setInterval(() => {
                if(minutes < 0){
                    hoursDoubDig--;
                    minutes=60;
                }
                if(seconds <=0){
                    minutes--;
                    seconds = 60;
                }
                $('.time').text(hoursDoubDig.toString().padStart(2, '0') + ':' + minutes+ ':' + seconds + ' time left');

                seconds--;
                if(hoursDoubDig == 00 && minutes == 0 && seconds == 0){
                    // $("#quizTimeUp").modal('show');
                    // clearInterval(time);
                    $('.time').text('00' + ':' + '00'+ ':' + '00' + ' Time is up!');
                    $('.modal-body').html(`
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <div>
                        Time is up! Please submit your quiz answers now.
                        </div>
                    </div>
                    `);
                    // $( document ).click(function() {
                    //     alert( "clicked!" );
                    // });
                    
                    // alert('Time is up!');
                }
                const d = new Date();
                // console.log(d.getHours() + '' + d.getMinutes() + '' + d.getSeconds());
            }, 1000);
            

            const input = document.getElementsByClassName('optionAnswer');
            const sessionStatus = document.getElementsByClassName('session-status');
            for(x=0;x<input.length;x++){
                $(input[x]).click(function(){
                    
                    var index = this.getAttribute("question-index");
                    var questionType = this.getAttribute("question-type");
                    var saveToSessionRoute = "{{ route('saveAnswerToSession') }}";
                    
                    sessionStatus[index].innerHTML = `
                        <div class="spinner-border" role="status" style="width:20px; height:20px; margin-left:10px;"></div> 
                    `;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                    });
                    if(questionType == 1){
                        var questionid = this.getAttribute("questionid");
                        var optionid = this.value;
                        
                        $.ajax({
                            url: saveToSessionRoute,
                            type: "POST",
                            
                            data: {
                                key: "Attempt-{{$chosenQuiz->quizAttempt->last()->attempt_id}}-Question-"+questionid,
                                questionid: questionid,
                                optionid: optionid,
                                questionType: questionType,
                            },
                            dataType: "json",
                            success: function (response) {
                                console.log(response);
                                sessionStatus[index].innerHTML = ``;
                                sessionStatus[index].innerHTML += `
                                    <p class="card-header-tabs fst-italic" style="margin-left:5px; margin-top:3px; font-size: 15px; color: gray;">    saved.</p>
                                `;
                            },
                            error: function (response) {
                                console.log(response);
                                alert('error');
                            }
                        });
                    }
                    else if(questionType == 3){
                        
                        var optionid = this.getAttribute("optionid");
                        var questionid = this.value;

                        if(this.checked == false){
                            $.ajax({
                                url: saveToSessionRoute,
                                type: "POST",
                                data: {
                                    key: "Attempt-{{$chosenQuiz->quizAttempt->last()->attempt_id}}-Option-"+optionid,
                                    method: "delete",
                                    questionid: questionid,
                                },
                                dataType: "json",
                                success: function (response) {
                                    console.log(response);
                                    sessionStatus[index].innerHTML = ``;
                                    sessionStatus[index].innerHTML += `
                                        <p class="card-header-tabs fst-italic" style="margin-left:5px; margin-top:3px; font-size: 15px; color: gray;">    saved.</p>
                                    `;
                                },
                                error: function (response) {
                                    console.log(response);
                                    alert('error');
                                }
                            });
                        }
                        else{
                            $.ajax({
                                url: saveToSessionRoute,
                                type: "POST",
                                data: {
                                    key: "Attempt-{{$chosenQuiz->quizAttempt->last()->attempt_id}}-Option-"+optionid,
                                    questionid: questionid,
                                    optionid: optionid,
                                    questionType: questionType,
                                },
                                dataType: "json",
                                success: function (response) {
                                    console.log(response);
                                    sessionStatus[index].innerHTML = ``;
                                    sessionStatus[index].innerHTML += `
                                        <p class="card-header-tabs fst-italic" style="margin-left:5px; margin-top:3px; font-size: 15px; color: gray;">    saved.</p>
                                    `;
                                },
                                error: function (response) {
                                    console.log(response);
                                    alert('error');
                                }
                            });
                        }
                    }
                    
                });
                $(input[x]).change(function(){
                    var index = this.getAttribute("question-index");
                    sessionStatus[index].innerHTML = `
                        <div class="spinner-border" role="status" style="width:20px; height:20px; margin-left:10px;"></div> 
                    `;

                    var questionid = this.getAttribute("questionid");
                    var optionid = this.getAttribute("optionid");
                    var questionType = this.getAttribute("question-type");
                    var answerValue = this.value;
                    var saveToSessionRoute = "{{ route('saveAnswerToSession') }}";
                    if(questionType == 2){
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            }
                        });
                        $.ajax({
                            url: saveToSessionRoute,
                            type: "POST",
                            data: {
                                key: "Attempt-{{$chosenQuiz->quizAttempt->last()->attempt_id}}-Question-"+questionid,
                                questionid: questionid,
                                optionid: optionid,
                                questionType: questionType,
                                answer: answerValue,
                            },
                            dataType: "json",
                            success: function (response) {
                                console.log(response);
                                sessionStatus[index].innerHTML = ``;
                                sessionStatus[index].innerHTML += `
                                    <p class="card-header-tabs fst-italic" style="margin-left:5px; margin-top:3px; font-size: 15px; color: gray;">    saved.</p>
                                `;
                            },
                            error: function (response){
                                console.log(response);
                                alert('error');
                            }
                        });
                    }
                });
            }
            
        });
        
    </script>
@stop

