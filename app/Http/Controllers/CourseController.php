<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\Teacher;
use App\Models\Course;
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
            // $college = new College;
            $findTeacher = Teacher::where('teacherId',Auth::id())->get()->first();
            $course= new Course;

        $course->teacher_id = $findTeacher->teacherId;
        $course->course_title = $request->course_title;
        $course->course_description = $request->course_description;
        
        
        $course->save();

        // return redirect()->to(url('students/all'));
        return redirect()->to(route('home'));
        }
    }
}
