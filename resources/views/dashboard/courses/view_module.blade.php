

@section('main-content')

    @if(count($courseContentTopic) != 0)
        @foreach($courseContentTopic as $topic)
            <div class="card" role="button" href="#multiCollapseExample1" style="margin:5px;">
                <div class="card-body">
                    <h5>{{$topic['topic_title']}}</h5>
                    <h9>{{$topic['topic_description']}}</h9>
                                                            
                </div>
                <div class="action-delete" style="margin:2px;">
                    <td class="icons"><a href="{{ route('content.delete',$content['content_id']) }}" title="Delete Module"><img src="{{ asset('images/delete.png') }}" alt=""></a></td>
                </div>
                <div class="action" style="margin:2px;">
                    <div class="icons" onclick="showTopicInput( {{$content['content_id']}}); getModuleId({{$content['content_id']}});"><a  title="Add topic"><img src="{{ asset('images/add.png') }}" alt="" ></a></div>
                </div>
                                    
            </div>
        @endforeach
    @else
        <h1>No topics for this module</h1>
    @endif

@stop