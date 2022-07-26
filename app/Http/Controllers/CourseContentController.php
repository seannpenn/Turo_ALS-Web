<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseContent;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Topic;
use App\Models\TopicContent;
use Illuminate\Support\Facades\Auth;
use Validator;
use Response;
class CourseContentController extends Controller
{
    // creating of course content
    public function create(Request $request){
        $rules = [
            'content_title' => 'required',
            'content_description' => 'required',
        ];

        $messages = [
            'content_title.required' => 'Please input a course title',
            'content_description.required' => 'Please input a course description',

        ];

        $validation = Validator::make($request->input(), $rules, $messages);

        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }

        else{
    
            $courseContent = new CourseContent();
            

            $courseContent->course_id = $request->course_id;
            $courseContent->content_title = $request->content_title;
            $courseContent->content_description = $request->content_description;
            
            $courseContent->save();

            return redirect()->to(route('course.showInfo',$request->course_id));
        }
    }
    // updating of course content
    public function update(Request $request, $id){
        $rules = [
            'content_title' => 'required',
            'content_description' => 'required',
        ];

        $messages = [
            'content_title.required' => 'Please input course title.',
            'content_description.required' => 'Please input course description.',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);


        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{
            $updateCourse = CourseContent::where('course_id',$id);
            $updateCourse->update([
                'content_title' => $request->content_title,
                'content_description' => $request->content_description,
            ]);
            
            return back();
        }
    }
    // deleting of course content
    public function delete($id){
        $selectedCourseContent = CourseContent::findOrFail($id);
        
        $selectedCourseContent->delete();
        return redirect()->to(route('course.showInfo', $selectedCourseContent->course_id));
    }
    public function getModules($courseid){
        $course = Course::where('course_id', $courseid)->get()->first();
        $modules = $course->coursecontent;

        return Response::json($modules);
    }
    // viewing of course content
    public function viewModule($courseid, $contentId){

        $teacherId = Teacher::where('user_id', Auth::id())->get()->first();
        $courseCollection = Course::where('teacher_id', $teacherId->teacher_id)->get();

        return view('dashboard.content.display')->with(compact('courseCollection'));
    }

    //viewing of course content
    // public function studentCourseContent($id){

    //     $selectedModule = CourseContent::where('content_id', $id)->get();

    //     return view('student.student_coursecontent')->with(compact('selectedModule'));
    // }

}
