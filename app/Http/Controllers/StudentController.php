<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentBackground;
use App\Models\StudentInformation;
use Validator;
class StudentController extends Controller
{
    public function showEnrollmentStatus($id){
        $studentStatus= Student::where('studentId', $id)->get()->status;
        return view('home.student_home')->with(compact('studentStatus')); 
    }
    public function showAllStudents(){
        $studentCollection = Student::getAllStudents();

        return view('dashboard.student_list')->with(compact('studentCollection'));
    }

    public function showStudentApplication($id){
        $studentPersonal= Student::where('studentId', $id)->get()->first();
        $studentInfo = StudentInformation::where('studentId', $studentPersonal['studentId'])->get()->first();
        $studentBack = StudentBackground::where('studentId', $studentPersonal['studentId'])->get()->first();

        return view('dashboard.student_application')->with(compact('studentPersonal', 'studentInfo', 'studentBack'));
    }

    public function approve($id){
        $updateStudentStatus = Student::where('studentId', $id);
        
        $updateStudentStatus->update([
            'status' => 'pending',
        ]);
        
        return redirect()->to(route('students.all'));
    }
}
