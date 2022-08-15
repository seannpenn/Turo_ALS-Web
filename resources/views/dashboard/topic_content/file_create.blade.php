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
        <form action=" {{route('topicContent.create')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="text" name="topic_id" class="form-control" value="{{$topic_id}}" hidden>
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
@stop