<div class="modal fade modal-dialog modal-lg" id="assignmentUpdateModal{{request()->route('courseid')}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Assignment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action=" {{route('assignment.update', request()->route('courseid'))}} " method="post">
              {{ csrf_field() }}
              <input type="text" name="course_id" class="form-control" id="recipient-name" value="{{request()->route('courseid')}}">
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

              <div class="modal-footer">
                  <button type="reset" class="btn btn-warning">Reset</button>
                  <button type="submit" class="btn btn-primary">Create</button>
              </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>