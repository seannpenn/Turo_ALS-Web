<div class="modal fade" id="moduleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create module</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post">
        {{ csrf_field() }}
        <input type="course_id" name="course_id" id="course_id" value="{{request()->route('courseid')}}" hidden>
          <div class="mb-3">
            <label for="content_title" class="col-form-label">Module title</label>
            <input type="text" name="content_title" id="content_title" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="Module Description" class="col-form-label">Module Description</label>
            <textarea class="form-control" name="content_description" id="content_description"></textarea>
          </div>

          <div class="modal-footer">
        
        <button type="button" data-bs-dismiss="modal" class="btn btn-warning" id="createModuleButton">Create</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>