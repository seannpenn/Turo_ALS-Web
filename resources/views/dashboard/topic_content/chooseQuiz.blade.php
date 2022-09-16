<!-- List of quizzes -->
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Quizzes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            @if(!empty($quizCollection))
                <div class="container text-center" style="height: 200px;">
                    <form action="{{route('topicContent.create')}}" method="post">
                    {{ csrf_field() }}
                        @foreach($quizCollection as $quiz)
                            <div class="p-2">
                                <input type="text" class="form-control" name="type" id="recipient-name" value="quiz" hidden>
                                <input type="text" name="topic_id" class="form-control" value="{{$topic_id}}" hidden>
                                <input type="text" name="topic_content_title" class="form-control" value="{{$quiz->quiz_title}}" hidden>
                                <input type="text" name="link" class="form-control" value="{{ $quiz->quiz_id }}" hidden>
                                <button type="submit" class="quiz-select">
                                    {{ $quiz->quiz_id }}
                                    {{ $quiz->quiz_title }}
                                </button>
                            </div> 
                        @endforeach
                    </form>
                </div>
            @else
                <h2>No created quizes..</h2>
            @endif
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#topicChoices" data-bs-toggle="modal">Back to first</button>
      </div>
    </div>
  </div>
</div>
