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

            $teacherId = Teacher::where('user_id', Auth::id())->get()->first();
            $course->teacher_id = $teacherId->teacher_id;
            $course->course_title = $request->course_title;
            $course->course_description = $request->course_description;
            
            $course->save();

            return redirect('admin/course/all')->with('message', 'Course created successfully');
        }
    }

    public function showCourse($id){
        
        $chosenCourse = Course::where('course_id',$id)->get()->toArray();
        $courseContent = CourseContent::where('course_id',$id)->get()->toArray();
        $courseId = $id;
        return view('dashboard.courses.view_course')->with(compact('chosenCourse', 'courseContent', 'courseId'));  
    }

    public function showOwnedCourses(){
        $userData = Auth::user();
        $teacherId = Teacher::where('user_id', Auth::id())->get()->first();
        $ownedCourses = Course::where('teacher_id', $teacherId->teacher_id)->get()->toArray();
        
        return view('dashboard.courses.display_course')->with(compact('ownedCourses'));
        
    }
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
    public function delete($id){
        $selectedCourse = Course::findOrFail($id);
        
        $selectedCourse->delete();
        return redirect()->to(route('course.all'));
    }
}
