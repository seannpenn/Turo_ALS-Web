<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentBackground;
use App\Models\StudentInformation;
use Validator;
class StudentController extends Controller
{
    public function showAllStudents(){
        $studentCollection = Student::getAllStudents();

        return view('dashboard.student_list')->with(compact('studentCollection'));
    }

    public function showStudentApplication($id){
        $studentPersonal= Student::where('studentId', $id)->get()->first();
        $studentInfo = StudentInformation::where('studentId', $student['studentId'])->get()->first();
        $studentBack = StudentBackground::where('studentId', $student['studentId'])->get()->first();

        return view('student_information')->with(compact('studentPersonal', 'studentInfo', 'studentBack'));
    }
}
