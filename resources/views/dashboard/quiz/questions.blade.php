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
                                            <button class="question-button deleteQuestion" style="background-color: transparent;" value="{{ $question->question_id }}" title="Delete Question" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="border:none;"><img src="{{ asset('images/delete.png') }}" alt="" width="20" height="20"></button>
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