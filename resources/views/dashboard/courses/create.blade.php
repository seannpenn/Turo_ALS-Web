<div class="modal fade" id="createCourse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Course</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
        {{ csrf_field() }}

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Course Title</label>
            <input type="text" name="course_title" id="course_title" class="form-control">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Course Description</label>
            <textarea class="form-control" name="course_description" id="course_description"></textarea>
          </div>

          <div class="modal-footer">
              <button type="button" data-bs-dismiss="modal" id="createCourseButton" class="btn btn-warning">Create</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>