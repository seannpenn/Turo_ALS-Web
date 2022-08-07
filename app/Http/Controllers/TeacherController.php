<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Course;
class TeacherController extends Controller
{
    public function testing(){
       $teacherCollection = Teacher::all();
       $courseCollection = Course::all();

       return view('testing')->with(compact('teacherCollection', 'courseCollection'));
    }
}
