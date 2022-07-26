<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function create(Request $request){
        $rules = [
            'course_title' => 'required',
            'course_description' => 'required',
        ];

        $messages = [
            'course_title.required' => 'Please input a course title',
            'course_description.required' => 'Please input a course description',

        ];

        $validation = Validator::make($request->input(), $rules, $messages);

        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{
    
            $course = new Course();

            $course->teacher_id = Auth::id();
            $course->course_title = $request->course_title;
            $course->course_description = $request->course_description;
            
            $course->save();

            return redirect()->to(route('course.all'));
        }
    }

    public function showCourse($id){
        
        $chosenCourse = Course::where('course_id',$id)->get()->toArray();
        $courseContent = CourseContent::where('course_id',$id)->get()->toArray();
        
        return view('dashboard.courses.view_course')->with(compact('chosenCourse', 'courseContent'));  
    }

    public function showOwnedCourses(){
        $userData = Auth::user();
        $ownedCourses = Course::where('teacher_id', Auth::id())->get()->toArray();
        
        return view('dashboard.courses.display_course')->with(compact('ownedCourses'));
        
    }
    public function delete($id){
        $selectedCourse = Course::findOrFail($id);
        
        $selectedCourse->delete();
        return redirect()->to(route('course.all'));
    }
}
