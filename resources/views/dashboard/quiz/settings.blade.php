    
    <div style="width: 50%; margin: 50px auto; margin-bottom: 20px;">
        <div class="container text-left">
            <div class="row gy-5">
                <div class="col-6">
                    <h3>Quiz Settings </h3>
                </div>
                <div class="col" >
                    @if($selectedQuiz[0]->status == 'active')
                        <div class="form-check form-switch form-check-reverse">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" @if($selectedQuiz[0]->status == 'active') checked @endif>
                            <label class="form-check-label" for="flexSwitchCheckReverse"><span class="badge text-bg-success" >
                                Active quiz.
                            </span></label>
                        </div>
                    @else
                        <div class="form-check form-switch form-check-reverse">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" @if($selectedQuiz[0]->status == 'active') checked @endif>
                            <label class="form-check-label" for="flexSwitchCheckReverse"><span class="badge text-bg" style="background-color: grey;">
                                Inactive quiz.
                            </span></label>
                        </div>
                    @endif
                </div>
                
            </div>
        </div>
    <hr>
    <br>
            <form action="{{ route('quiz.setup',[ request()->route('courseid') ,request()->route('quizid')]) }}" method="post">

                {{ csrf_field() }}
            <div class="card" style="border: none;">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header"><b>Duration</b></div>
                            <div class="card-body">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <h2 class="fs-5">Start Date</h2>
                                        <input class="form-control" type="date" name="start_date" id="" value="{{$selectedQuiz[0]->start_date}}">
                                    </div>
                                    <div class="col-6">
                                        <h2 class="fs-5">End Date</h2>
                                        <input class="form-control" type="date" name="end_date" id="" value="{{$selectedQuiz[0]->end_date}}">
                                    </div>
                                </div>
                                <br>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <h2 class="fs-5">Start Time</h2>
                                        <input class="form-control" type="time" name="start_time" id="" value="{{$selectedQuiz[0]->start_time}}">
                                    </div>
                                    <div class="col-6">
                                        <h2 class="fs-5">End Time</h2>
                                        <input class="form-control" type="time" name="end_time" id="" value="{{$selectedQuiz[0]->end_time}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header"><b>Attempts</b></div>
                            <div class="card-body">
                                <div class="row g-1">
                                    <h2 class="fs-5">Attempts</h2>
                                    <div class="col-3">
                                        <select class="form-select" aria-label="Default select example" name="attempts">
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header"><b>Security</b></div>
                            <div class="card-body">
                                <div class="row g-1">
                                    <h5>To secure your quiz, please set a password below.</h5>
                                    <p class="fst-italic lh-1">(if you wish to disable quiz password, leave it blank.)</p>
                                    
                                    
                                    <div class="col-3">
                                    <h2 class="fs-5">Password: </h2><input class="form-control" type="text" name="password" id="" placeholder="quiz password..." value="{{$selectedQuiz[0]->password}}">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <nav class="navbar fixed-bottom navbar-dark" style="box-shadow: 0 4px 20px rgb(0 0 0 / 0.2);">
                            <div class="container-fluid" style="width: 50%;">
                                <button class="btn btn-warning" type="submit" style="background-color: orange; color:white;">Save</button>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
                
            </form>
    </div>
        