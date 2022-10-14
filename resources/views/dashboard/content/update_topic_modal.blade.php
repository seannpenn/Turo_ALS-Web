<div class="modal fade" id="topicUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update topic</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('topic.update')}}" method="post">
        {{ csrf_field() }}
          <div class="mb-3">
            <label for="content_title" class="col-form-label">Topic title</label>
            <input type="text" name="topic_id" class="form-control" id="topic_id">
            <input type="text" name="topic_title" class="form-control" id="topic_title">
          </div>
          <div class="mb-3">
            <label for="Module Description" class="col-form-label">Topic Description</label>
            <textarea class="form-control" name="topic_description" id="topic_description"></textarea>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-warning">Update</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>