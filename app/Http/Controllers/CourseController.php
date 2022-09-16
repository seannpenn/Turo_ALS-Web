<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Programs;
use App\Models\CourseContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //creating of courses
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
            $teacherId = Teacher::where('user_id', Auth::id())->get()->first();
            $course->teacher_id = $teacherId->teacher_id;
            $course->course_title = $request->course_title;
            $course->course_description = $request->course_description;
            
            $course->save();

            return redirect('teacher/course/all')->with('message', 'Course created successfully');
        }
    }
    // updating of courses
    public function update(Request $request, $id){
        $rules = [
            'course_title' => 'required',
            'course_description' => 'required',
        ];

        $messages = [
            'course_title.required' => 'Please input course title.',
            'course_description.required' => 'Please input course description.',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);


        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{
            $updateCourse = Course::where('course_id',$id);
            $updateCourse->update([
                'course_title' => $request->course_title,
                'course_description' => $request->course_description,
            ]);
            
            return back();
        }
    }
    // deleting of courses
    public function delete($id){
        $selectedCourse = Course::findOrFail($id);
        $selectedCourse->delete();
        return redirect()->to(route('course.all'));
    }

    // displaying courses created by specific teacher
    public function showOwnedCourses(){
        $teacherId = Teacher::where('user_id', Auth::id())->get()->first();
        $ownedCourses = Course::where('teacher_id', $teacherId->teacher_id)->get();

        return view('dashboard.courses.display_course')->with(compact('ownedCourses' ));
        
    }
    // viewing of course created.
    public function showCourse($id){
        $chosenCourse = Course::where('course_id',$id)->get();
        return view('dashboard.courses.view_course')->with(compact('chosenCourse'));  
    }
    public function showAll($id){
        $teacherId = Teacher::where('user_id', Auth::id())->get()->first();
        $courseCollection = Course::where('teacher_id', $teacherId->teacher_id)->get();
        $selectedTopicContent = null;
        return view('dashboard.content.display')->with(compact('courseCollection', 'selectedTopicContent'));
    }
}
