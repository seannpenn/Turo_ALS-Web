<div class="text-content">
                                <div class="col-auto">
                                    <div class="card-body">
                                        <form method="post" action="{{route('topicContent.update', $selectedTopicContent->topic_content_id)}}" >
                                        {{ csrf_field() }}
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Topic Title</label>
                                                <input type="text" name="topic_content_title" class="form-control" id="recipient-name" value="{{$selectedTopicContent->topic_content_title}}">
                                                <input type="text" name="type" class="form-control" id="recipient-name" value="html" hidden>
                                                <input type="text" name="topic_id" class="form-control" id="recipient-name" value="{{$selectedTopicContent->topic_id}}" hidden>
                                            </div>
                                                <div class="form-group">
                                                    <textarea class="form-control mt-5" name="html" id="editor" rows="20" >{!! $selectedTopicContent->html !!}</textarea>
                                                </div>
                                                <div class="modal-footer">  
                                                    <button type="submit" class="btn btn-warning">Update</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>