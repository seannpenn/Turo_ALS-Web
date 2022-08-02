<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@yield('mode')</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="@yield('form-action')" method="post">
        {{ csrf_field() }}

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">@yield('first-label')</label>
            <input type="text" name="course_title" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">@yield('second-label')</label>
            <textarea class="form-control" name="course_description" id="message-text"></textarea>
          </div>

          <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>