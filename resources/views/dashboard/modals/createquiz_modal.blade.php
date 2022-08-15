<div class="modal fade" id="quizModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Quiz</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action=" {{route('quiz.store')}} " method="post">
            {{ csrf_field() }}

            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Quiz Title</label>
                <input type="text" name="quiz_title" class="form-control" id="recipient-name">
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