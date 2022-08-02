<div class="modal fade" id="questionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Question</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" action="{{ route('question.create') }}" method="post">
        {{ csrf_field() }}
            <input type="text" class="form-control" name="quiz_id" value="@yield('quiz_id')" hidden>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Question</label>
                <input type="text" name="question" class="form-control" id="inputAddress" placeholder="Input question...">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Option A</label>
                <div class="input-group-text">
                    <input type="radio" value="A" aria-label="Radio button for following text input" name="answer" id="radio-button-a" style="margin: 5px;">
                    <input type="text" name="choice_a" class="form-control" aria-label="Text input with radio button" id="input1">

                </div>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Option B</label>
                <div class="input-group-text">
                    <input type="radio" value="B" aria-label="Radio button for following text input" name="answer" id="radio-button-b" style="margin: 5px;">
                    <input type="text" name="choice_b" class="form-control" aria-label="Text input with radio button" id="input2">

                </div>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Option C</label>
                <div class="input-group-text">
                    <input type="radio" value="C" aria-label="Radio button for following text input" name="answer" id="radio-button-c" style="margin: 5px;">
                    <input type="text" name="choice_c" class="form-control" aria-label="Text input with radio button" id="input3">

                </div>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Option D</label>
                <div class="input-group-text">
                    <input type="radio" value="D" aria-label="Radio button for following text input" name="answer" id="radio-button-d" style="margin: 5px;">
                    <input type="text" name="choice_d" class="form-control" aria-label="Text input with radio button" id="input4">

                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
      
    </div>
  </div>
</div>