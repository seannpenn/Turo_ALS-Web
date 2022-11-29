<div class="modal fade" id="html-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalToggleLabel" style="margin-left: 20px;">Create an HTML Document</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
      </div>
        <div class="modal-body" style="justify-content:center; text-align:center; width: 1000px; margin: 0 auto;">
          <form method="post" action="{{route('topicContent.create')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Title</label>
                    <input type="text" name="topic_content_title" class="form-control" id="recipient-name">
                    <input type="text" name="type" value="html" hidden>
                    <input type="text" id= "html_topic_id" name="topic_id" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <textarea class="form-control mt-5" name="html" id="editor1" rows="20" ></textarea>
                </div>
                <div class="modal-footer">
                  <!-- <button type="reset" class="btn btn-warning">Reset</button> -->
                  <button type="submit" class="btn btn-warning" data-bs-dismiss="modal">Create</button>
                </div>
          </form>
        </div>
    </div>
  </div>
</div>