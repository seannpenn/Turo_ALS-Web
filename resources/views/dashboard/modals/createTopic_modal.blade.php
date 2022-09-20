
<div class="modal fade" id="topicCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create topic</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form method="post" action="{{route('topic.create', 5)}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Topic Title</label>
                    <input type="text" name="topic_title" class="form-control" id="recipient-name">
                    <input type="text" name="content_id" class="form-control" id="content_id" value = "@yield('topic_id')">
                </div>
                
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Topic Description</label>
                        <textarea class="form-control mt-5" name="topic_description"></textarea>
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