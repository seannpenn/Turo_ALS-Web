<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\TopicContent;
use App\Models\Topic;
use App\Models\Quiz;
use App\Models\Teacher;
use App\Models\Course;
use Validator;
use Response;
use Illuminate\Support\Facades\Auth;
class TopicContentController extends Controller
{
    //
    
    public function create(Request $request){


            if($request->type == 'html'){
                $topic = Topic::where('topic_id', $request->topic_id)->get()->first();
                $course = $topic->coursecontent->course;
                TopicContent::insertGetId([
                    'topic_id' => $request['topic_id'],
                    'topic_content_title' => $request['topic_content_title'],
                    'type' =>$request['type'],
                    'html' => $request['html'],
                ]);
                return redirect()->route('course.showInfo', $course);
            }

            if($request->type == 'file'){
                $topic = Topic::where('topic_id', $request->topic_id)->get()->first();
                $course = $topic->coursecontent->course->course_id;
                $file = $request->file;
                $originalFileName = $file->getClientOriginalName();
                
                Storage::putFileAs('public/files', $file, $originalFileName);
                TopicContent::insertGetId([
                    'topic_id' => $request['topic_id'],
                    'topic_content_title' => $request['topic_content_title'],
                    'type' =>$request['type'],
                    'file' => $originalFileName,
                ]);
                
                return redirect()->route('course.showInfo', $course);
            }

            if($request->type == 'quiz'){
                $topic = Topic::where('topic_id', $request->topic_id)->get()->first();
                $course = $topic->coursecontent->course;
                TopicContent::insertGetId([
                    'topic_id' => $request['topic_id'],
                    'type' => $request->type,
                    'topic_content_title' => $request['topic_content_title'],
                    'link' =>$request['link'],
                ]);
                return redirect()->route('course.showInfo', $course);
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

    public function viewTopicContent($courseId, $topicContentId){
        $teacherId = Teacher::where('user_id', Auth::id())->get()->first();
        $courseCollection = Course::where('teacher_id', $teacherId->teacher_id)->get();

        $selectedTopicContent = TopicContent::where('topic_content_id',$topicContentId)->get()->first();
        // $file_path = 'storage/files/'.$selectedTopicContent->file;
        // return view('dashboard.courses.view_topic_content')->with(compact('selectedTopicContent', 'file_path'));
        // return view('dashboard.content.display')->with(compact('selectedTopicContent', 'file_path', 'courseCollection'));

        return Response::json([$selectedTopicContent]);
    }
    
    public function update(Request $request){

        dd($request);
       
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
            $topic = Topic::where('topic_id', $request->topic_id)->get()->first();
            $course = $topic->coursecontent->course;
            if($request->type == 'html'){
                
                $updateTopicContent = TopicContent::where('topic_content_id',$request->$topic_content_id);
                $updateTopicContent->update([
                    'topic_content_title' => $request->topic_content_title,
                    'html' => $request->html,
                ]);
                // return redirect()->back();
                return response()->json([
                    "status" => true,
                    "data" => $topic
                ]);
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
