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
        $updateStudentStatus = Student::where('studentId', $id)->get()->first();
        if($updateStudentStatus->LRN != null){
            $updateStudentStatus->update([
                'status' => 'approved',
            ]);

            return redirect()->to(route('students.all'));
        }
        else{
            return redirect()->back()->with('error', 'Please provide LRN to student first');
        }
        
        
    }

    public function provideLRN(Request $request, $id){
        $rules = [
            'LRN' => 'required',
        ];
        $messages = [
            'LRN.required' => 'Please input a student LRN.',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);
        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{
            $provideStudentLRN = Student::where('studentId', $id);

            $provideStudentLRN->update([
                'LRN' => $request->LRN,
            ]);
            return redirect()->back();
        }
        
    }
}
