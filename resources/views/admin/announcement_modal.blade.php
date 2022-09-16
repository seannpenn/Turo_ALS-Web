<div class="modal fade" id="announcementCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Announcement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('announcement.create')}}">
          {{ csrf_field() }}
          <div class="mb-3">
            <label for="announcement_title" class="col-form-label">Announcement Title</label>
            <input type="text" name="announcement_title" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="announcement_description" class="col-form-label">Announcement Description</label>
            <textarea class="form-control mt-2" name="announcement_description"></textarea>
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