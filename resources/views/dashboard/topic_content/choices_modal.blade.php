<style>
    #html-choice-button, #file-choice-button, #quiz-choice-button{
        width: 7rem;
        height: 7rem;
        
    }
    a{
      color: black;
    }
</style>

<div class="modal fade" id="topicChoices" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalToggleLabel">What would you like to create?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="justify-content:center; text-align:center;">
          <button class="btn btn-outline-warning" id="html-choice-button" name="choice-button" data-bs-target="#html-create" data-bs-toggle="modal" data-bs-dismiss="modal">HTML Document</button>
          <button class="btn btn-outline-warning" id="file-choice-button" name="choice-button" data-bs-target="#file-create" data-bs-toggle="modal" data-bs-dismiss="modal">File</button>
          <button class="btn btn-outline-warning" id="quiz-choice-button" name="choice-button" data-bs-target="#quiz-link" data-bs-toggle="modal" data-bs-dismiss="modal">Quiz</button>

      </div>
      
    </div>
  </div>
</div>

<!-- HTML create modal -->
<div class="modal fade" id="html-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
      <button class="btn" data-bs-target="#topicChoices" data-bs-toggle="modal" data-bs-dismiss="modal">< back</button>
      <h5 class="modal-title" id="exampleModalToggleLabel" style="margin-left: 20px;">Create an HTML Document</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
      </div>
        <div class="modal-body" style="justify-content:center; text-align:center; width: 1000px; margin: 0 auto;">
          <form method="post" action="{{route('topicContent.create')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Title</label>
                    <input type="text" name="topic_content_title" class="form-control" id="recipient-name">
                    <input type="text" id= "html_topic_id" name="topic_id" class="form-control" value="" readonly>

                    <input type="text" name="type" class="form-control" value="html" hidden>
                </div>
                <div class="form-group">
                    <textarea class="form-control mt-5" name="html" id="editor" rows="20" ></textarea>
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

<!-- File upload modal -->
<div class="modal fade" id="file-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
      <button class="btn" data-bs-target="#topicChoices" data-bs-toggle="modal" data-bs-dismiss="modal">< back</button>
      <h5 class="modal-title" id="exampleModalToggleLabel" style="margin-left: 20px;">Upload a Document</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
      </div>
        <div class="modal-body" style="justify-content:center; text-align:center; width: 1000px; margin: 0 auto;">
          <form action=" {{route('topicContent.create')}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="text" id="file_topic_id" name="topic_id" class="form-control" value="" readonly>
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

<!-- Link Quiz modal -->
<div class="modal fade" id="quiz-link" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button class="btn" data-bs-target="#topicChoices" data-bs-toggle="modal" data-bs-dismiss="modal">< back</button>
      <h5 class="modal-title" id="exampleModalToggleLabel" style="text-align: center;">Insert a Quiz</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
      </div>
      
        <div class="modal-body">
          <h6>Quizzes</h6>
          <hr>
          <div id="list-quizzes"></div>
        </div>
    </div>
  </div>
</div>