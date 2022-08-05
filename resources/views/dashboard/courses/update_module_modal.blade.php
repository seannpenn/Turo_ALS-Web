<div class="modal fade" id="moduleUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update module</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="@yield('module-action-update')" method="post">
        {{ csrf_field() }}
          <div class="mb-3">
            <label for="content_title" class="col-form-label">Module title</label>
            <input type="text" name="content_title" class="form-control" id="recipient-name" value="@yield('content-title')">
          </div>
          <div class="mb-3">
            <label for="Module Description" class="col-form-label">Module Description</label>
            <textarea class="form-control" name="content_description" id="message-text">@yield('content-description')</textarea>
          </div>

          <div class="modal-footer">
        
        <button type="submit" class="btn btn-warning">Update</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>