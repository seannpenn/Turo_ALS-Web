<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Validator;

class TopicController extends Controller
{
    public function create(Request $request){
        $rules = [
            'quiz_title' => 'required',
        ];

        $messages = [
            'quiz_title.required' => 'Please input a topic title',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);

        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }

        else{
        
            $contentTopic = new Topic();
            $topicId = Topic::insertGetId([
                "content_id" => $request->content_id,
                "topic_title" => $request->quiz_title,
                "topic_description" => $request->topic_description,
                "topic_type" => $request->topic_type,
            ]);
            Quiz::create([
                "topic_id" => $topicId,
                "quiz_title" => $request->quiz_title,
            ]);


            // $contentTopic->content_id = $request->content_id;
            // $contentTopic->topic_title = $request->topic_title;
            // $contentTopic->topic_description = $request->topic_description;
            // $contentTopic->topic_type = $request->topic_type;
            
            // $contentTopic->save();

            return redirect()->back();
        }
    }

    public function delete($topicId){
        $selectedTopic = Topic::findOrFail($topicId);
        
        $selectedTopic->delete();
        return redirect()->back();
    }

    public function viewModuleTopics($topicId){

        $selectedTopic = Topic::where('topic_id',$topicId)->get()->toArray();
        
        return view('dashboard.courses.view_topic')->with(compact('selectedTopic'));
    }
    
}
