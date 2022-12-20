<div class="container" style="margin: 50px auto;">
    <table class="table table-hover table table-bordered" style="width: 100%;">
        <thead>
            <th scope="col" class="text-left">Student's attempts</th>
            <th scope="col">No. of attempts </th>
            {{-- <th scope="col" class="text-center">Actions</th> --}}
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td width="75%" class="text-left p-3">
                        @if($student->student->quizAttemptByStudentByQuiz($student->student->student_id, request()->route('quizid'))->count() == 0)
                            {{ $student->student->student_lname }}, {{ $student->student->student_fname }} {{ $student->student->student_mname }}
                        @else
                            <a href="/teacher/course/{{ request()->route('courseid') }}/quiz/{{ request()->route('quizid') }}/student/{{ $student->student_id }}/attempts">
                                {{ $student->student->student_lname }}, {{ $student->student->student_fname }} {{ $student->student->student_mname }}
                            </a>
                        @endif
                        
                    </td>
                    <td class="text-center">
                        @if($student->student->quizAttemptByStudentByQuiz($student->student->student_id, request()->route('quizid'))->count() == 0)
                            No attempts yet.
                        @else
                            <span class="badge text-bg-success" style="width: 50px; height:20px;">
                                {{ $student->student->quizAttemptByStudentByQuiz($student->student->student_id, request()->route('quizid'))->count() }}
                            </span>
                        @endif
                        
                    </td>
                    {{-- <td class="text-center">
                        <button>Action</button>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- <div class="container justify-content-center p-5">
        <h2>Students done attempting the quiz</h2>
        <hr>
    @foreach($students as $student)
        @if($student->student->quizAttemptByStudentByQuiz($student->student_id, $selectedQuiz[0]->quiz_id)->count() != 0)
        <button type="button" class="btn btn-outline-warning students" style="border-radius: 0;">{{ $student->student->student_lname }}, {{ $student->student->student_fname }} {{ $student->student->student_mname }}</button>
    
        <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    
                @foreach($student->student->quizAttemptByStudentByQuiz($student->student_id, $selectedQuiz[0]->quiz_id) as $index => $attempt)
                    <div class="p-3">
                        Attempt {{$index+1}}
                    </div>
                    @foreach($selectedQuiz[0]->question as $index => $question)
                        @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->option_id == null && $question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->isCorrect == null && $question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->points == null)
                            <span class="badge text-bg-success" style="font-size: 20px;">
                                Partial Score : {{$attempt->quizSummary->total_score}} / {{$attempt->quizSummary->total_points}}
                            </span>
                        @break
                        @else
                             <span class="badge text-bg-success" style="font-size: 20px;">
                                Final Score : {{$attempt->quizSummary->total_score}} / {{$attempt->quizSummary->total_points}}
                            </span>
                            @break
                        @endif
                    @endforeach
                    
                    <div class="card m-3">
                        <div class="card-body">
                                @foreach($selectedQuiz[0]->question as $index => $question)
                                        <div class="card mb-3">
                                            <div class="card ">
                                                <div class="card-header">{{$index+1}}.) {{  $question->question }}
                                                    <div class="float-end">{{$question->points}} point/s</div>
                                                </div>
                                                <div class="card-body">
                                                    @foreach($question->option as $option)
                                                        @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id))
                                                            <div class="form-check">
                                                                @if($question->type != 2)
                                                                    @if($question->type == 1)
                                                                        @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->option_id == $option->option_id)
                                                                            @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->isCorrect)
                                                                                <div class="alert-warning" style="background-color: lightgreen;">
                                                                                    <input class="form-check-input" type="radio" checked disabled>
                                                                                    <label class="form-check-label" for="{{$question->question_id}}">
                                                                                        {{ $option->option }} 
                                                                                    </label>
                                                                                </div>
                                                                            @else
                                                                                <div class="alert-warning" style="background-color: #FFCCCB;">
                                                                                    <input class="form-check-input" type="radio" checked disabled>
                                                                                    <label class="form-check-label" for="{{$question->question_id}}">
                                                                                        {{ $option->option }} 
                                                                                    </label>
                                                                                </div>
                                                                            @endif
                                                                        @else
                                                                            @if($option->isCorrect)
                                                                                <div class="alert-warning" style="background-color: lightgreen;">
                                                                                    <input class="form-check-input" type="radio" disabled>
                                                                                    <label class="form-check-label" for="{{$question->question_id}}">
                                                                                        {{ $option->option }} 
                                                                                    </label>
                                                                                </div>
                                                                            @else
                                                                                <div class="alert-warning">
                                                                                    <input class="form-check-input" type="radio" disabled>
                                                                                    <label class="form-check-label" for="{{$question->question_id}}">
                                                                                        {{ $option->option }} 
                                                                                    </label>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    @elseif($question->type == 3)
                                                                        @if($option->answer)
                                                                            @if($option->answer->isCorrect)
                                                                                <div class="alert-warning" style="background-color: lightgreen;">
                                                                                    <input class="form-check-input"  type="checkbox" name="options[{{ $option->option_id}}]" id="exampleRadios2" value="{{$question->question_id}}" disabled checked>
                                                                                    <label class="form-check-label" for="{{$question->question_id}}">
                                                                                        {{ $option->option }}
                                                                                    </label>
                                                                                </div>
                                                                            @else
                                                                                <div class="alert-warning" style="background-color: #FFCCCB;">
                                                                                    <input class="form-check-input"  type="checkbox" name="options[{{ $option->option_id}}]" id="exampleRadios2" value="{{$question->question_id}}" disabled checked>
                                                                                    <label class="form-check-label" for="{{$question->question_id}}">
                                                                                        {{ $option->option }}
                                                                                    </label>
                                                                                </div>
                                                                            @endif
                                                                        @else
                                                                            @if($option->isCorrect == 1)
                                                                                <div class="alert-success" style="background-color: lightgreen;">
                                                                                    <input class="form-check-input"  type="checkbox" name="options[{{ $option->option_id}}]" id="exampleRadios2" value="{{$question->question_id}}" disabled>
                                                                                    <label class="form-check-label" for="{{$question->question_id}}">
                                                                                        {{ $option->option }}
                                                                                    </label>
                                                                                </div>
                                                                            @else
                                                                                <input class="form-check-input"  type="checkbox" name="options[{{ $option->option_id}}]" id="exampleRadios2" value="{{$question->question_id}}" disabled>
                                                                                <label class="form-check-label" for="{{$question->question_id}}">
                                                                                    {{ $option->option }}
                                                                                </label>
                                                                            @endif
                                                                        @endif

                                                                    @elseif($question->type == 4)
                                                                        <textarea class="form-control" placeholder="Enter your answer here..." id="floatingTextarea" rows="4" disabled>{{$question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->textAnswer}}</textarea>                                                                
                                                                    @endif
                                                                @else
                                                                <div class="row g-0 text-center">
                                                                    <div class="col-sm-6 col-md-8">
                                                                        <input type="text" class="form-control option" id="option" placeholder="Question" aria-label="Question"  value="{{$question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->textAnswer}}">
                                                                    </div>
                                                                    <div class="col-6 col-md-4"><button class="btn btn-primary consider" isCorrect="{{$question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->isCorrect}}" value="{{$question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->quiz_answer_id}}" @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->isCorrect) hidden @endif>consider</button></div>
                                                                </div>
                                                                     
                                                                @endif
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="card-footer">
                                                @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id))
                                                    @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->isCorrect || $question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->option_id == null)
                                                        @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->option_id == null)
                                                                    @if($question->type == 4)
                                                                    <div class="d-flex justify-content-end">
                                                                        <div class="p">
                                                                            <div class="input-group">
                                                                                @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->points == null)
                                                                                    <input type="number" min="0" max="{{$question->points}}" class="form-control givenPoint" id="{{$index}}" size="2" value="{{$question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->points}}">
                                                                                    <span class="input-group-text">/5</span>
                                                                                    <button class="btn btn-primary mark" id="{{$index}}" style="background-color: orange; border: 1px solid orange;" value="{{$question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->quiz_answer_id}}">Mark</button>
                                                                                @else
                                                                                    <h6>Given score: {{$question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->points}}</h6>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                            @foreach($correctAnswers as $correctanswer)
                                                                @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->textAnswer == $correctanswer || $question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->isCorrect)
                                                                    <span class="input-group-text" style="color:green; background-color:transparent;border-style: hidden;">
                                                                        <img src="{{ asset('images/correct.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                        Student got the correct answer.
                                                                    </span>
                                                                    
                                                                    @if($question->type == 2)
                                                                        Other possible answers: 
                                                                        @foreach($correctAnswers as $correctanswer)
                                                                            @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->textAnswer != $correctanswer)
                                                                                {{$correctanswer}}, 
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                    
                                                                    @break
                                                                @else
                                                                    <span class="input-group-text" style="color:red; background-color:transparent;border-style: hidden;">
                                                                        <img src="{{ asset('images/wrong.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                        Student got the wrong answer.
                                                                    </span>

                                                                    @if($question->type == 2)
                                                                        Correct answers: 
                                                                        @foreach($correctAnswers as $correctanswer)
                                                                            @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->textAnswer != $correctanswer)
                                                                                {{$correctanswer}}, 
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                    @break
                                                                @endif
                                                                
                                                            @endforeach
                                                        @else
                                                                @php
                                                                    $testCount = 0;
                                                                    $countTesting = 0;
                                                                @endphp

                                                                @foreach($attempt->quiz->question as $index => $question)
                                                                    @if($question->type == 3)
                                                                        @foreach($question->option as $option)
                                                                            @if($option->isCorrect)
                                                                                @if($option->answer)
                                                                                    @if($option->answer->isCorrect)
                                                                                        @php $testCount++; @endphp
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                            @if($option->answer)
                                                                                @if(!$option->answer->isCorrect)
                                                                                    @php $countTesting++; @endphp
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach

                                                            @if($countTesting == 0)
                                                                <span class="input-group-text" style="color:green; background-color:transparent;border-style: hidden;">
                                                                    <img src="{{ asset('images/correct.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                    Student got the correct answer.
                                                                </span>
                                                            @else
                                                                <span class="input-group-text" style="color:red; background-color:transparent;border-style: hidden;">
                                                                    <img src="{{ asset('images/wrong.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                                    Student got the wrong answer.
                                                                </span>
                                                            @endif
                                                        @endif
                                                    @else   
                                                        <span class="input-group-text" style="color:red; background-color:transparent;border-style: hidden;">
                                                            <img src="{{ asset('images/wrong.png') }}"  alt="" width="20" height="20" style="margin-right: 10px;">
                                                            Student got the wrong answer.
                                                        </span>
                                                        @if($question->type == 2)
                                                            Correct answers:
                                                            @foreach($correctAnswers as $correctanswer)
                                                                @if($question->getAnswerByQuestionStudent($question->question_id, $student->student_id)->textAnswer != $correctanswer)
                                                                    {{$correctanswer}}, 
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            Correct answer is:
                                                            @foreach($question->option as $option)
                                                                @if($option->isCorrect == 1)
                                                                     {{$option->option }}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                @endforeach

                            
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        </div>
        @endif
    @endforeach
    </div>
    <div class= "container justify-content-center p-5">
        <h2>Students not yet attempted the Quiz</h2>
        <hr>
        @foreach($students as $student)
            @if($student->student->quizAttemptByStudentByQuiz($student->student_id, $selectedQuiz[0]->quiz_id)->count() == 0)
            <button type="button" class="btn btn-outline-warning students" style="border-radius: 0;">{{ $student->student->student_lname }}, {{ $student->student->student_fname }} {{ $student->student->student_mname }}</button>
            @endif
        @endforeach
    </div>
</div> --}}
  <style>
    .students {
    cursor: pointer;
    padding: 18px;
    width: 100%;
    text-align: left;
    outline: none;
    border-color: orange;
    font-size: 15px;
    }

    .content, .students:hover {
    background-color: orange;
    }

    /* .students:after {
    content: '\002B';
    width: 20px;
    height: 20px;
    color: black;
    font-weight: bold;
    float: right;
    margin-left: 5px;
    }

    .active:after {
    content: "\2212";
    } */

    .content {
    padding: 0 18px;
    display: none;
    overflow: hidden;
    background-color: #f1f1f1;
    }
    </style>


  <script>
    $(document).ready(function(){
        var coll = document.getElementsByClassName("students");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
            });
        }

            var considerButton = document.getElementsByClassName('consider');

            for(var index = 0;index<considerButton.length; index++){
                $(considerButton[index]).click(function(e){
                    
                    var isCorrect= this.getAttribute("isCorrect");
                    var considerAnswerRoute = "{{route('answer.consider', ":answerid")}}";
                    considerAnswerRoute = considerAnswerRoute.replace(':answerid', this.value);
                    console.log(considerAnswerRoute);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                    });

                    $.ajax({
                        type: "post",
                        url: considerAnswerRoute,
                        data: {
                            'isCorrect': isCorrect == 1 ? 0:1,
                        },
                        dataType: "json",
                        success: function (response) {
                            console.log('success');
                            console.log(response);
                            if(response.isCorrect == 1){
                                alert('This answer was considered.')
                            }
                            window.location.reload();
                        },
                        error: function(response){
                            console.log('error');
                            console.log(response);
                        }
                    });
                });
            }

            const markButton = document.getElementsByClassName('mark');
            const givenPoint = document.getElementsByClassName('givenPoint');
            
            for(var index = 0;index<markButton.length; index++){
                $(markButton[index]).on('click', markButton[index], function () {
                    
                    alert(givenPoint[$(markButton).index(this)].value + ' ----- ' + this.value);
                    alert('Score'+ givenPoint[$(markButton).index(this)].value + ' will be given to this answer.Are you sure you want to proceed?');
                    var markAnswerRoute = "/teacher/quizAnswer/" + this.value;
                    console.log(markAnswerRoute);
                    var point = givenPoint[$(markButton).index(this)].value;
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                    });
                    $.ajax({
                        type: "post",
                        url: markAnswerRoute,
                        data: {
                            points: point,
                        },
                        dataType: "json",
                        success: function (response) {
                            console.log('success');
                            // window.location.reload();
                        },
                        error: function(response){
                            console.log(response);
                            console.log('error');
                        },
                        
                    });
                    
                });
            }

    });
  </script>


