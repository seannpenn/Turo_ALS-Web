
<style>
    .addOption:hover{
        background-color: yellow;
        cursor:pointer;
    }
</style>
<div class="container">
        <div class="row" style="justify-content:left;">
                <form class="row g-3" action="{{ route('quiz.update', $selectedQuiz[0]->quiz_id) }}" method="post" style="width: 600px;">
                    {{ csrf_field() }}
                    <div class="col-auto">
                      <label for="staticEmail2" class="visually-hidden">Quiz title:</label>
                      <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Quiz title:" style="width: 100px;">
                    </div>
                    <div class="col-auto">
                      <label for="inputPassword2" class="visually-hidden">Password</label>
                      <input type="text" class="form-control" id="inputPassword2" placeholder="Password" value="{{$selectedQuiz[0]->quiz_title}}">
                    </div>
                    <div class="col-auto">
                      <button type="submit" class="btn btn-primary mb-3">Apply</button>
                    </div>
                </form>
        </div>
            @section('quiz_id')
                {{$selectedQuiz[0]->quiz_id}}
            @stop

        @if($selectedQuiz[0]->question->count() != 0)
        <br>    
            <div class="questions" id="questions">
                <table class="table">
                    <button class="btn btn-md btn-primary" 
                            id="addBtn" type="button">
                            Add new question
                    </button>
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">question</th>
                        <th scope="col">question type</th>
                        <th scope="col">Answer</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>
            </div>
        @else
            <div class="d-grid gap-2 col-2 mx-auto" >
                <h2>Add questions..</h2>
            </div>
        @endif
</div>