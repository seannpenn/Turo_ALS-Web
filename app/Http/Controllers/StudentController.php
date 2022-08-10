<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\StudentEducation;
use App\Models\StudentFamily;
use Validator;
class StudentController extends Controller
{
    public function enroll(Request $request){

        $backgroundCredentials = $request->validate([
            'student_fname' => 'required',
            'student_lname' => 'required',
            'student_gender' => 'required',
            'student_civil' => 'required',
            'student_birth' => 'required',
            'student_placeofbirth' => 'required',
            'street' => 'required',
            'barangay' => 'required',
            'city' => 'required',
            'province' => 'required',
            'student_motherfname' => 'required',
            'student_motherlname' => 'required',
            'student_compfname' => 'required',
            'student_complname' => 'required',
            'last_level' => 'required',
            'student_reason' => 'required',
            'answer_type' => 'required',

        ]);

        $studentId = Student::insertGetId([
            'user_id' => Auth::id(),
            'LRN' => $request['LRN'],
            'student_fname' => $request['student_fname'],
            'student_mname' => $request['student_mname'],
            'student_lname' => $request['student_lname'],
            'student_gender' => $request['student_gender'],
            'student_civil' => $request['student_civil'],
            'student_birth' => $request['student_birth'],
            'student_placeofbirth' => $request['student_placeofbirth'],
            'street' => $request['street'],
            'barangay' => $request['barangay'],
            'city' => $request['city'],
            'province' => $request['province'],
        ]);
        StudentFamily::create([
            'studentId' => $studentId,
            'student_compfname' => $request['student_compfname'],
            'student_compmname' => $request['student_compmname'],
            'student_complname' => $request['student_complname'],
            'student_motherfname' => $request['student_motherfname'],
            'student_mothermname' => $request['student_mothermname'],
            'student_motherlname' => $request['student_motherlname'],
        ]);
        StudentEducation::create([
            'studentId' => $studentId,
            'last_level' => $request['last_level'],
            'student_reason' => $request['student_reason'],
            'answer_type' => $request['answer_type'],
            'program_attended' => $request['program_attended'],
            'program_literacy' => $request['program_literacy'],
            'program_attended_year' => $request['program_attended_year'],
        ]);

        return redirect()->to('/student/home');
    }
    public function showEnrollmentStatus($id){
        $studentStatus= Student::where('studentId', $id)->get()->status;
        return view('home.student_home')->with(compact('studentStatus')); 
    }
    public function showAllStudents(){
        $studentCollection = Student::getAllStudents();

        return view('dashboard.student_list')->with(compact('studentCollection'));
    }

    public function showStudentApplication($id){
        $studentApplication= Student::where('studentId', $id)->get()->first();
        
        return view('dashboard.student_application')->with(compact('studentApplication'));
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
