<div class="modal fade" id="assignmentModal{{request()->route('courseid')}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Assignment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action=" {{route('assignment.create')}} " method="post">
              {{ csrf_field() }}
              <input type="text" name="course_id" class="form-control" id="recipient-name" value="{{request()->route('courseid')}}">
                <div class="mb-2">
                    <label for="recipient-name" class="col-form-label">Assignment Title</label>
                    <input type="text" name="assignment_title" class="form-control" id="recipient-name">
                </div>
                {{-- <div class="mb-2">
                    <label for="recipient-name" class="col-form-label">Assignment description</label>
                    <input type="text" name="assignment_description" class="form-control" id="recipient-name">
                </div> --}}

              <div class="modal-footer">
                  <button type="reset" class="btn btn-warning">Reset</button>
                  <button type="submit" class="btn btn-primary">Create</button>
              </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>