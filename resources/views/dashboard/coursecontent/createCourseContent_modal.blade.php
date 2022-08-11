<div class="modal fade" id="topicModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@yield('mode-topic')</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('content.create')}}" method="post">
        {{ csrf_field() }}
          <div class="mb-3">
            <input type="text" name="course_id" id="courseId" hidden>
            <label for="content_title" class="col-form-label">@yield('first-label-topic')</label>
            <input type="text" class="form-control" name="topic_title" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="content_description" class="col-form-label">@yield('second-label-topic')</label>
            <textarea class="form-control" name="topic_description" id="message-text"></textarea>
          </div>
          <div class="modal-footer">
        <button type="submit" id="contentCreate" class="btn btn-warning">Create Topic</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>