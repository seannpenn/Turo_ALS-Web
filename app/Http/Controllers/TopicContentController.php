<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\TopicContent;
use App\Models\Topic;
use App\Models\Quiz;
use Validator;
use Illuminate\Support\Facades\Auth;
class TopicContentController extends Controller
{
    //
    
    public function create(Request $request){
        $topic = Topic::where('topic_id', $request->topic_id)->get()->first();
        $course = $topic->coursecontent->course;

            if($request->type == 'html'){
                TopicContent::insertGetId([
                    'topic_id' => $request['topic_id'],
                    'topic_content_title' => $request['topic_content_title'],
                    'type' =>$request['type'],
                    'html' => $request['html'],
                ]);
                return redirect()->route('course.showInfo', $course->course_id);
            }

            if($request->type == 'file'){
                $file = $request->file;
                $originalFileName = $file->getClientOriginalName();
                
                Storage::putFileAs('public/files', $file, $originalFileName);
                TopicContent::insertGetId([
                    'topic_id' => $request['topic_id'],
                    'topic_content_title' => $request['topic_content_title'],
                    'type' =>$request['type'],
                    'file' => $originalFileName,
                ]);
                return redirect()->route('course.showInfo', $course->course_id);
            }

            if($request->type == 'quiz'){
                TopicContent::insertGetId([
                    'topic_id' => $request['topic_id'],
                    'type' => $request->type,
                    'topic_content_title' => $request['topic_content_title'],
                    'link' =>$request['link'],
                ]);
                return redirect()->route('course.showInfo', $course->course_id);
            }
            
    }
    
    public function linkContent(Request $request, $id){

        if($request->type == 'quiz'){
            TopicContent::insertGetId([
                'topic_id' => $request['topic_id'],
                'topic_content_title' => $request['quiz_title'],
                'link' =>$request['link'],
            ]);
            return redirect()->route('course.showInfo', $course->course_id);
        }
    }

    public function viewTopicContent($topicContentId){

        $selectedTopicContent = TopicContent::where('topic_content_id',$topicContentId)->get()->first();
        $file_path = 'storage/files/'.$selectedTopicContent->file;
        return view('dashboard.courses.view_topic_content')->with(compact('selectedTopicContent', 'file_path'));

    }
    
    public function update(Request $request, $id){

        $topic = Topic::where('topic_id', $request->topic_id)->get()->first();
        $course = $topic->coursecontent->course;
       
        $rules = [
            'topic_content_title' => 'required',
        ];
        
        $messages = [
            'topic_content_title.required' => 'Please input a topic title',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);

        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{
            if($request->type == 'html'){
                
                $updateTopicContent = TopicContent::where('topic_content_id',$id);
                $updateTopicContent->update([
                    'topic_content_title' => $request->topic_content_title,
                    'html' => $request->html,
                ]);
                return redirect()->route('course.showInfo', $course->course_id);
            }
        }
    }
    public function delete($id){
        $selectedTopicContent = TopicContent::findOrFail($id);
        $selectedTopicContent->delete();
        return redirect()->back();
    }

    public function createHtml($id){
        $topic_id = $id;
        return view('dashboard.topic_content.html_create')->with(compact('topic_id'));
    } 
    public function createFile($id){
        $topic_id = $id;
        return view('dashboard.topic_content.file_create')->with(compact('topic_id'));
    }
    public function createLink($id){
        $topic_id = $id;
        $quizCollection = Quiz::where('teacher_id', Auth::user()->teacher->teacher_id)->get();
        return view('dashboard.topic_content.chooseQuiz')->with(compact('topic_id', 'quizCollection'));
    }
}
