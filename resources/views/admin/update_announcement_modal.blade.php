<div class="modal fade" id="announcementUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Announcement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('announcement.update') }}" method="post">
        {{ csrf_field() }}
          <div class="mb-3">
            <label for="announcement_title" class="col-form-label">Announcement title</label>
            <input type="text" name="announcement_title" class="form-control" id="announcement_title" value="">
          </div>
          <div class="mb-3">
            <input type="text" id="announcement_id" name="announcement_id" class="form-control" value="" readonly>
            <label for="Announcement Description" class="col-form-label">Announcement Description</label>
            <textarea class="form-control" name="announcement_description" id="announcement_description"></textarea>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-warning">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>