<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseContent;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Validator;
class CourseContentController extends Controller
{
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
    public function delete($id){
        $selectedCourseContent = CourseContent::findOrFail($id);
        
        $selectedCourseContent->delete();
        return redirect()->to(route('course.showInfo', $selectedCourseContent['course_id']));
    }

}
