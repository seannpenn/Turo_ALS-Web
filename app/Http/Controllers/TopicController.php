<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\CourseContent;
use Illuminate\Support\Facades\Auth;
use Validator;

class TopicController extends Controller
{
    public function create(Request $request){
        $rules = [
            'topic_title' => 'required',
            'topic_description' => 'required',
        ];

        $messages = [
            'topic_title.required' => 'Please input a topic title',
            'topic_description.required' => 'Please input a topic description',

        ];

        $validation = Validator::make($request->input(), $rules, $messages);

        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }

        else{
    
            $contentTopic = new Topic();
            

            $contentTopic->content_id = $request->content_id;
            $contentTopic->topic_title = $request->topic_title;
            $contentTopic->topic_description = $request->topic_description;
            $contentTopic->topic_type = $request->topic_type;
            
            $contentTopic->save();

            return redirect()->back();
        }
    }
    public function viewModule($id){

        $courseContentTopic = Topic::where('content_id',$id)->get()->toArray();

        return view('dashboard.courses.view_module')->with(compact('courseContentTopic'));  
    }
}
