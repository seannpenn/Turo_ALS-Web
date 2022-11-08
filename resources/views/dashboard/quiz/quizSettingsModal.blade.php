<div class="modal fade" id="quizSettings" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Quiz Settings</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <form action="{{ route('quiz.setup',[ request()->route('courseid') ,request()->route('quizid')]) }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-6">
                            <h2 class="fs-5">Start Date</h2>
                            <input class="form-control" type="date" name="start_date" id="">
                        </div>
                        <div class="col-6">
                            <h2 class="fs-5">End Date</h2>
                            <input class="form-control" type="date" name="end_date" id="">
                        </div>
                    </div>
                    <br>
                    <div class="row g-2">
                        <div class="col-6">
                            <h2 class="fs-5">Start Time</h2>
                            <input class="form-control" type="time" name="start_time" id="" value="time.now()">
                        </div>
                        <div class="col-6">
                            <h2 class="fs-5">End Time</h2>
                            <input class="form-control" type="time" name="end_time" id="">
                        </div>
                    </div>
                    <br>
                    <div class="row g-1">
                        <h2 class="fs-5">Attempts</h2>
                        <div class="col-8">
                            <select class="form-select" aria-label="Default select example" name="attempts">
                                <option selected>Select number of attempts</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row g-1">
                        <h2 class="fs-5">Password</h2>
                        
                        <div class="col-6">
                            <input class="form-control" type="text" name="password" id="" placeholder="quiz password...">
                        </div>
                    </div>

                </div>
                

                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="submit" class="btn btn-primary">Set</button>
                </div>
            </form>
            
        </div>
      
    </div>
  </div>
</div>
