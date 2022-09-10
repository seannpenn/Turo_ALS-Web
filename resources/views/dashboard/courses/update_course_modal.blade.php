<div class="modal fade" id="courseUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update course</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="@yield('form-action-update')" method="post">
        {{ csrf_field() }}
          <div class="mb-3">
            <label for="content_title" class="col-form-label">Course title</label>
            <input type="text" name="course_title" class="form-control" id="recipient-name" value="@yield('title-value')">
          </div>
          <div class="mb-3">
            <label for="Module Description" class="col-form-label">Course Description</label>
            <textarea class="form-control" name="course_description" id="message-text">@yield('description-value')</textarea>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-warning">Update</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>