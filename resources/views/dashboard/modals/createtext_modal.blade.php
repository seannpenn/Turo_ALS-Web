<div class="modal fade" id="textModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Text</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card-body">
                <form method="post" action="{{route('topic.create')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Topic Title</label>
                    <input type="text" name="topic_title" class="form-control" id="recipient-name">
                    <input type="text" name="content_id" class="form-control" value="@yield('content-id-text')" hidden>

                    <input type="text" name="topic_type" class="form-control" value="text" hidden>
                </div>
                    <div class="form-group">
                        <textarea class="form-control mt-5" name="text_content" id="editor" rows="20" ></textarea>
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
</div>