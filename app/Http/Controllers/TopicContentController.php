<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\TopicContent;
use App\Models\Topic;
use App\Models\Quiz;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Validator;
use Response;
use Illuminate\Support\Facades\Auth;
class TopicContentController extends Controller
{
    //
    
    public function create(Request $request){


            if($request->type == 'html'){
                $topic = Topic::where('topic_id', $request->topic_id)->get()->first();
                // $course = $topic->coursecontent->course;
                TopicContent::insertGetId([
                    'topic_id' => $request['topic_id'],
                    'topic_content_title' => $request['topic_content_title'],
                    'type' =>$request['type'],
                    'html' => $request['html'],
                ]);
                
            }

            if($request->type == 'file'){
                $topic = Topic::where('topic_id', $request->topic_id)->get()->first();

                $file = $request->file;

                dd($file);
                $originalFileName = $file->getClientOriginalName();
                
                Storage::putFileAs('public/files', $file, $originalFileName);

                TopicContent::insertGetId([
                    'topic_id' => $request['topic_id'],
                    'topic_content_title' => $request['topic_content_title'],
                    'type' =>$request['type'],
                    'file' => $originalFileName,
                ]);
                
                
            }

            if($request->type == 'quiz'){
                $topic = Topic::where('topic_id', $request->topic_id)->get()->first();
                TopicContent::insertGetId([
                    'topic_id' => $request['topic_id'],
                    'type' => $request->type,
                    'topic_content_title' => $request['topic_content_title'],
                    'quiz_link' =>$request['quiz_link'],
                ]);
                
            }
            return redirect()->back();
    }
    
    public function linkContent(Request $request, $id){
        if(TopicContent::has('link',$request['link'])){
            if($request->type == 'quiz'){
                TopicContent::insertGetId([
                    'topic_id' => $request['topic_id'],
                    'topic_content_title' => $request['quiz_title'],
                    'quiz_link' =>$request['quiz_link'],
                ]);
                return redirect()->route('course.showInfo', $course->course_id);
            }
        }
        else{
            return redirect()->back()->withErrors(['exists' => 'Quiz is already linked in this topic']);
        }

    }

    public function viewTopicContent($courseId, $topicContentId){
        $teacherId = Teacher::where('user_id', Auth::id())->get()->first();
        $courseCollection = Course::where('teacher_id', $teacherId->teacher_id)->get();

        $selectedTopicContent = TopicContent::where('topic_content_id',$topicContentId)->get()->first();
        $file_path = 'storage/files/'.$selectedTopicContent->file;

        // dd(asset($file_path));

        return Response::json([$selectedTopicContent, $file_path]);
    }

    public function retainTopicContent($courseId, $topicContentId){
        $teacherId = Teacher::where('user_id', Auth::id())->get()->first();
        $courseCollection = Course::where('teacher_id', $teacherId->teacher_id)->get();

        $selectedTopicContent = TopicContent::where('topic_content_id',$topicContentId)->get()->first();
        $file_path = 'storage/files/'.$selectedTopicContent->file;

        return view('dashboard.content.display')->with(compact('selectedTopicContent', 'file_path', 'courseCollection'));
    }
    
    public function update(Request $request, $id){

            $topic = Topic::where('topic_id', $request->topic_id)->get()->first();
            if($request->type == 'html'){
                
                $updateTopicContent = TopicContent::where('topic_content_id',$id)->get()->first();
                $updateTopicContent->update([
                    'topic_content_title' => $request->topic_content_title,
                    'html' => $request->html,
                ]);
                return redirect()->back();
                // return response()->json([
                //     "status" => true,
                //     "data" => $updateTopicContent
                // ]);
            }
    }
    public function delete($id){
        $selectedTopicContent = TopicContent::findOrFail($id);
        $selectedTopicContent->delete();
        return back();
    }

    public function topicChoices($courseid, $topicid){
        
        return view('dashboard.topic_content.content_choices')->with(compact('topicid'));
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

    //students view
    public function studentViewTopicContent($courseId, $topicContentId){
        $selectedTopicContent = TopicContent::where('topic_content_id',$topicContentId)->get()->first();
        $file_path = 'storage/files/'.$selectedTopicContent->file;

        return Response::json([$selectedTopicContent, $file_path]);
    }
}
