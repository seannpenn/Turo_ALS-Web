<div class="modal fade modal-dialog" id="markAssignment{{$submission->submission_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Mark Assignment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          {{ csrf_field() }}
        <div class="modal-body">
            <div class="container">
                <div class="row g-2">
                  <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Score</label>
                    <input type="email" class="form-control" id="total_score" name="total_score" value="">
                  </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="submitScore" value="{{$submission->submission_id}}" data-bs-dismiss="modal" class="btn btn-primary float-end">Mark</button>
        </div>
      </div>
    </div>
  </div>