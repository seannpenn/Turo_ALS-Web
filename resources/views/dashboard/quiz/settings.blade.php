    
    <div style="width: 50%; margin: 50px auto; margin-bottom: 20px;">
                <div class="toast-container position-fixed top-0 start-50 translate-middle-x" style="margin-top: 10px;">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="background-color: white;">
                        <div class="toast-header">
                        <img src="{{ asset('images/correct.png') }}" class="rounded me-2" alt="..." style="height: 20px; width: 20px;">
                        <strong class="me-auto">Success</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Changes Saved.
                        </div>
                    </div>
                </div>
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
        <form id="settingsForm">
        {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header" style="background-color: orange; color:white;"><b>Duration</b></div>
                            <div class="card-body">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <h2 class="fs-5">Start Date</h2>
                                        <input class="form-control" type="date" name="start_date" id="start_date" value="{{$selectedQuiz[0]->start_date}}">
                                    </div>
                                    <div class="col-6">
                                        <h2 class="fs-5">End Date</h2>
                                        <input class="form-control" type="date" name="end_date" id="end_date" value="{{$selectedQuiz[0]->end_date}}">
                                    </div>
                                </div>
                                <br>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <h2 class="fs-5">Start Time</h2>
                                        <input class="form-control" type="time" name="start_time" id="start_time" value="{{$selectedQuiz[0]->start_time}}">
                                    </div>
                                    <div class="col-6">
                                        <h2 class="fs-5">End Time</h2>
                                        <input class="form-control" type="time" name="end_time" id="end_time" value="{{$selectedQuiz[0]->end_time}}">
                                    </div>
                                </div>
                                <br>
                                <div class="row g-2">
                                    <div class="col-4">
                                        <h2 class="fs-5">Time duration for Quiz</h2>
                                            <div class="row">
                                                @php
                                                    $duration = $selectedQuiz[0]->duration;
                                                    $hours = intdiv($duration, 60);
                                                    $minutes = $duration%60;
                                                @endphp
                                                <div class="col">
                                                    <input type="text" name="duration[]" id="duration1" class="form-control" placeholder="hour/s.." aria-label="First name" value="{{$hours}}">
                                                </div>
                                                <div class="col">   
                                                    <input type="text" name="duration[]" id="duration2" class="form-control" placeholder="minute/s.." aria-label="Last name" value="{{$minutes}}">
                                                </div>
                                            </div>
                                        <!-- <input class="form-control" type="time" name="start_time" id="" value="{{$selectedQuiz[0]->duration}}"> -->
                                    </div>
                                    
                                </div>
                            </div>
                    </div>

                    <br>
                    <div class="container text-left">
                        <div class="row">
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-header" style="background-color: orange; color:white;"><b>Attempts</b></div>
                                        <div class="card-body">
                                            <div class="row g-1">
                                                <h2 class="fs-5">Attempts</h2>
                                                <div class="col-3">
                                                    <select class="form-select" aria-label="Default select example" name="attempts" id="attempts">
                                                        <option value="1" selected>1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="col"> 
                                <div class="card h-100">
                                    <div class="card-header" style="background-color: orange; color:white;"><b>Grades</b></div>
                                        <div class="card-body">
                                            <div class="row g-1">
                                                <div class="form-check">
                                                    
                                                        <input class="form-check-input" type="checkbox" name="releaseGrades" id="releaseGrades" id="invalidCheck"  
                                                        @if($selectedQuiz[0]->releaseGrades == 1)
                                                        checked
                                                        @endif
                                                        >
                                                    
                                                    
                                                    <label class="form-check-label" for="invalidCheck">
                                                        Release partial/final grade on quiz submission.
                                                    </label>
                                                    <div class="invalid-feedback">
                                                        You must agree before submitting.
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <br>
                            <div class="card">
                                <div class="card-header" style="background-color: orange; color:white;"><b>Security</b></div>
                                    <div class="card-body">
                                        <div class="row g-1">
                                            <h5>To secure your quiz, please set a password below.</h5>
                                            <p class="fst-italic lh-1">(if you wish to disable quiz password, leave it blank.)</p>
                                            
                                            
                                            <div class="col-3">
                                                <h2 class="fs-5">Password: </h2><input class="form-control" type="text" name="password" id="password" placeholder="quiz password..." value="{{$selectedQuiz[0]->password}}">
                                            </div>
                                            
                                        </div>
                                    </div>
                                <nav class="navbar fixed-bottom navbar-dark" style="box-shadow: 0 4px 20px rgb(0 0 0 / 0.2);">
                                    <div class="container-fluid" style="width: 50%;">
                                        <button class="btn btn-warning" type="button" id ="saveSettings" style="background-color: orange; color:white;">Save</button>
                                    </div>
                                </nav>
                            </div>
                            <br>
                            
        </form>

        <script>
            const toastLiveExample = document.getElementById('liveToast')

        $(document).ready(function(){
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
        });
        </script>
    </div>
        