<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Topic;
use App\Models\Quiz;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Validator;

class TopicController extends Controller
{
    // create topics inside modules
    public function create(Request $request){
        
        $rules = [
            'topic_title' => 'required',
        ];
        
        $messages = [
            'quiz_title.required' => 'Please input a topic title',
            'topic_title.required' => 'Please input a topic title',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);

        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{
                Topic::create([
                    "content_id" => $request->content_id,
                    "topic_title" => $request->topic_title,
                    "topic_description" => $request->topic_description,
                ]);
                return redirect()->back();
        }
    }
    public function update(Request $request){
        $rules = [
            'topic_title' => 'required',
        ];
        
        $messages = [
            'topic_title.required' => 'Please input a topic title',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);


        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{

            $updateTopic = Topic::where('topic_id',$request->topic_id);
            $updateTopic->update([
                'topic_title' => $request->topic_title,
                'topic_description' => $request->topic_description,
            ]);

            return redirect()->back();
        }
    }
    // deleting a topic
    public function delete($topicId){
        $selectedTopic = Topic::findOrFail($topicId);
        $selectedTopic->delete();
        return redirect()->back();
    }

    public function viewTopic($courseid, $topicId){

        $teacherId = Teacher::where('user_id', Auth::id())->get()->first();
        $courseCollection = Course::where('teacher_id', $teacherId->teacher_id)->get();

        return view('dashboard.content.display')->with(compact('courseCollection'));
    }

    // viewing of topics.
    // public function viewModuleTopics($topicId){

    //     $selectedTopic = Topic::where('topic_id',$topicId)->get()->first();
    //     $file_path = 'storage/files/'.$selectedTopic->file_name;
    //     return view('dashboard.courses.view_topic')->with(compact('selectedTopic', 'file_path'));
    // }

    // public function storeUploadedFiles(Request $request){
    //     $file = $request->file_name;
    //     $originalFileName = $file->getClientOriginalName();

    //     $path = Storage::putFileAs('Topic/Files', $file, $originalFileName);
    // }
    
}
