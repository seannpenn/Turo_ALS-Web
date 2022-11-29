<div class="modal fade" id="file-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalToggleLabel" style="margin-left: 20px;">Upload a Document</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
      </div>
        <div class="modal-body" style="justify-content:center; text-align:center; width: 1000px; margin: 0 auto;">
          <form action=" {{route('topicContent.create')}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="text" id="file_topic_id" name="topic_id" class="form-control" readonly>
              <input type="text" name="type" class="form-control" value="file" hidden>

              <div class="mb-3">
                  <label for="topic_title" class="col-form-label">Title</label>
                  <input type="text" class="form-control" name="topic_content_title" id="recipient-name">
              </div>
              <div class="mb-3">
                  <label for="topic_title" class="col-form-label">Select File to upload</label>
                  <input type="file" class="form-control" name="file" id="recipient-name" >
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