<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\TopicContent;


class TopicContentController extends Controller
{
    public function getTopicContent($id){
        $topic = Topic::where('topic_id',$id)->get()->first();
        // $topicContent = TopicContent::where('topic_id',$topic->topic_id)->get()->first();
        $topicContents = $topic->topiccontent;

        return response()->json([
            'status' => true,
            'topicContents' => $topicContents,
        ]);
    }
}
