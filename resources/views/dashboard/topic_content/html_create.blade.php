@extends('main')

@section('css-style')
    .form-content{
        margin: 0 auto;
        margin-top: 50px;
        width: 500px;
        height: 300px;
        border: 1 solid;
        text-align:center;
    }
    form{
        justify-content:center;
        
    }
    
@stop


@section('main-content')
    <div class="form-content">
    <form method="post" action="{{route('topicContent.create')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Title</label>
                <input type="text" name="topic_content_title" class="form-control" id="recipient-name">
                <input type="text" name="topic_id" class="form-control" value="{{$topic_id}}" hidden>

                <input type="text" name="type" class="form-control" value="html" hidden>
            </div>
            <div class="form-group">
                <textarea class="form-control mt-5" name="html" id="editor" rows="20" ></textarea>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@stop