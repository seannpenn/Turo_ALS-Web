<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action=" {{route('topic.create')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="text" name="content_id" class="form-control" value="@yield('content-id-file')">
            <input type="text" name="topic_type" class="form-control" value="file" >

            <div class="mb-3">
                <label for="topic_title" class="col-form-label">Topic Title</label>
                <input type="text" class="form-control" name="topic_title" id="recipient-name">
            </div>
            <div class="mb-3">
                <label for="topic_description" class="col-form-label">Topic Description</label>
                <textarea class="form-control" name="topic_description" id="message-text"></textarea>
            </div>
            <div class="mb-3">
                <label for="topic_title" class="col-form-label">Select File to upload</label>
                <input type="file" class="form-control" name="file_name" id="recipient-name">
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>