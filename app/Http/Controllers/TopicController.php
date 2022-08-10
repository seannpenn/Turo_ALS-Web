<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Quiz;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Validator;

class TopicController extends Controller
{
    public function create(Request $request){
        
        if($request->topic_type == 'quiz'){
            $rules = [
                'quiz_title' => 'required',
            ];
        }
        else {
            $rules = [
                'topic_title' => 'required',
            ];
        }
        

        $messages = [
            'quiz_title.required' => 'Please input a topic title',
            'topic_title.required' => 'Please input a topic title',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);

        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{
            if($request->topic_type == 'quiz'){

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
                return redirect()->back();
            }
            else if($request->topic_type == 'file'){
                $file = $request->file_name;
                $originalFileName = $file->getClientOriginalName();
                // $file_path = $file->storeAs('files', $originalFileName);
                Storage::putFileAs('public/files', $file, $originalFileName);

                    Topic::create([
                        "content_id" => $request->content_id,
                        "topic_title" => $request->topic_title,
                        "topic_description" => $request->topic_description,
                        "topic_type" => $request->topic_type,
                        "file_name" => $originalFileName
                    ]);
                
                return redirect()->back();
            }
            else{
                Topic::create([
                    "content_id" => $request->content_id,
                    "topic_title" => $request->topic_title,
                    "topic_type" => $request->topic_type,
                    "text_content" => $request->text_content,
                ]);
                return redirect()->back();
            }
            
        }

        
    }

    public function update(Request $request){
        
    }

    public function delete($topicId){
        $selectedTopic = Topic::findOrFail($topicId);
        
        $selectedTopic->delete();
        return redirect()->back();
    }

    public function viewModuleTopics($topicId){

        $selectedTopic = Topic::where('topic_id',$topicId)->get()->first();
        $file_path = 'storage/files/'.$selectedTopic->file_name;
        return view('dashboard.courses.view_topic')->with(compact('selectedTopic', 'file_path'));
    }

    public function storeUploadedFiles(Request $request){
        $file = $request->file_name;
        $originalFileName = $file->getClientOriginalName();

        $path = Storage::putFileAs('Topic/Files', $file, $originalFileName);
    }
    
}
