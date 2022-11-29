
@foreach($selectedQuiz as $quiz)
        <div class="row" style="margin: 20px auto;">
            <div class="col-sm-10">
                <form action="{{ route('quiz.update', $selectedQuiz[0]->quiz_id) }}" method="post" style="width: 50%; margin: 0 auto;">
                {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="text" style="height:50px; background-color: transparent; border:none;" class="form-control" name="quiz_title" id="quiz_title" value="Quiz title:" disabled>
                        </div>
                        
                        <div class="col-sm-8">
                            <input type="text" style="height:50px;" class="form-control" name="quiz_title" id="quiz_title" value="{{$quiz->quiz_title}}">
                        </div>
                        
                    </div>
                </form>
            </div>
            <!-- <div class="col-sm-2">
                <button data-bs-toggle="modal" title="Quiz Settings" data-bs-target="#quizSettings" style="background-color: transparent; border:none; height:50px;">
                    <img src="{{ asset('images/settings.png') }}"  alt="" width="30" height="30" style="margin-right: 10px;">
                </button>
            </div> -->
        </div>
            @section('quiz_id')
                {{$quiz->quiz_id}}
            @stop
        @endforeach

        @if($selectedQuiz[0]->question->count() != 0)
        <br>    
            <div class="questions" id="questions" style="background-color: yellow;">
                    @foreach($selectedQuiz[0]->question as $key => $question)
                            <div class="card text-center questionContainer" id="question-container" style="width: 50%; margin: 0 auto; margin-bottom: 20px;" question-id="{{$question->question_id}}">
                                <div class="card-header" style="background-color: orange;">
                                    <div class="row align-items-center">
                                        <div class="col">
                                        question id: {{ $question->question_id }}
                                        </div>
                                        <div class="col" style="text-align: right;">
                                        <label for="" >Points:</label>
                                        </div>
                                        <div class="col" style="justify-content: right; text-align:right;">
                                            <input type="text" style="height:40px; width: 100px;" class="form-control point" placeholder="points" value="{{ $question->points }}" question-id="{{$question->question_id}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body " >
                                    <div class="row g-3 optionArea">
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control question_id" id="question_id" placeholder="Question" aria-label="Question" value="{{ $question->question_id }}" hidden>
                                            <input type="text" style="height:45px;" class="form-control question" placeholder="Question" aria-label="Question" value="{{ $question->question }}" question-id="{{$question->question_id}}">
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
                                                        @if($question->type != 2 && $question->type != 4 )
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
                                                                <input type="text" class="form-control option" option-id = "{{$option->option_id}}" value="{{$option->option}}" style="border-top-style: hidden; border-right-style: hidden;border-left-style: hidden;" placeholder="Input question answer here" class="form-control" aria-label="Question" value="">
                                                                
                                                                <span class="input-group-text" style="background-color: transparent; border: none;">
                                                                    @if($option->isCorrect == 1)
                                                                        <input type="checkbox" class="isCorrect" value="{{$option->option_id}}" aria-label="..." title="Set answer" checked>
                                                                    @else
                                                                    <input type="checkbox" class="isCorrect" value="{{$option->option_id}}" aria-label="..." title="Set answer">
                                                                    @endif
                                                                </span>
                                                                <span class="input-group-text" style="background-color: transparent;border: none;">
                                                                    <button type="button" class="form-check-label deleteOption" style="border:none; background-color: transparent;" value="{{$option->option_id}}" title="Delete Option" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img src="{{ asset('images/close.png') }}" alt="" width="20" height="20"></button>
                                                                </span>
                                                                
                                                            
                                                        @endif

                                                        @if($question->type == 4)
                                                                <textarea class="form-control" placeholder="Paragraph Answer" id="floatingTextarea" rows="5" disabled></textarea>                                                                
                                                        @endif

                                                        @if($question->type != 2 && $question->type != 4)
                                                            <span class="input-group-text" style="background-color: transparent; ">
                                                                @if($option->isCorrect == 1)
                                                                    <input type="checkbox" class="isCorrect" value="{{$option->option_id}}" aria-label="..." title="Set answer" checked>
                                                                @else
                                                                <input type="checkbox" class="isCorrect" value="{{$option->option_id}}" aria-label="..." title="Set answer">
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
                                                                @if($question->type != 2 && $question->type != 4)
                                                                    <button type="button" style="border:none; background-color: transparent;" class="addOptionButton" value="{{ $question->question_id }}"><img src="{{ asset('images/add.png') }}" alt="" width="20" height="20">Add option</button>
                                                                @endif
                                                                @if($question->type == 2)
                                                                    <p class="fs-6 fw-bold">Set answer by using comma (,) as separator.</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-end">
                                        <div class="d-flex justify-content-right">
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
            <div class="container-fluid" style="width: 50%;">
                <button type="button" class="create-button" id="createQuestion">Add Question</button>
            </div>
        </nav>