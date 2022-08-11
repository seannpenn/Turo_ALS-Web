<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\LearningCenter;
use App\Models\Programs;
use App\Models\Student;
use App\Models\StudentInformation;
use App\Models\StudentEducation;
use App\Models\StudentFamily;
use Validator;
class StudentController extends Controller
{
    // enroll student
    public function enroll(Request $request){
        $studentId = Auth::user()->student->student_id;
        $locId = Auth::user()->student->loc_id;

        $backgroundCredentials = $request->validate([
            'prog_id' => 'required',
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

        Enrollment::insertGetId([
            'student_id' => $studentId,
            'prog_id' => $request['prog_id'],
            'loc_id' => $locId,
        ]);

        StudentInformation::create([
            'student_id' => $studentId,
            'LRN' => $request['LRN'],
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
            'student_id' => $studentId,
            'student_compfname' => $request['student_compfname'],
            'student_compmname' => $request['student_compmname'],
            'student_complname' => $request['student_complname'],
            'student_motherfname' => $request['student_motherfname'],
            'student_mothermname' => $request['student_mothermname'],
            'student_motherlname' => $request['student_motherlname'],
        ]);
        StudentEducation::create([
            'student_id' => $studentId,
            'last_level' => $request['last_level'],
            'student_reason' => $request['student_reason'],
            'answer_type' => $request['answer_type'],
            'program_attended' => $request['program_attended'],
            'program_literacy' => $request['program_literacy'],
            'program_attended_year' => $request['program_attended_year'],
        ]);

        return redirect()->to('/student/home');
    }
    // show student enrollment status
    public function enrollmentPage(){
        $enrollmentModel = new Enrollment;
        $enrolleeInfo = $enrollmentModel->where('student_id', Auth::user()->student->student_id)->get()->first();
        return view('enrollment.student_enrollment')->with(compact('enrolleeInfo'));
    }
    // show enrollment form
    public function enrollForm(){
        $programs = Programs::getAll();
        $locations = LearningCenter::getAll();
        $student = Auth::user()->student;
        return view('enrollment.student_enrollment_form')->with(compact('programs', 'locations', 'student'));
    }


    // For admine functions

    // Manage Enrollment application from students
    public function showAllStudents(){
        $studentCollection = Student::getAllStudents();
        $enrollees = Enrollment::getAllEnrollees();

        $enrollees = Enrollment::getEnrolleesByLocProg(Auth::user()->teacher->loc_id, Auth::user()->teacher->prog_id);    

        return view('dashboard.student_list')->with(compact('enrollees'));
    }

    public function showStudentApplication($id){
        $studentApplication= Student::where('student_id', $id)->get()->first();
        return view('dashboard.student_application')->with(compact('studentApplication'));
    }
    // approving student's application
    public function approve($id){
        $updateEnrollmentStatus = Enrollment::where('student_id', $id);
        $studentLRN = StudentInformation::where('student_id', $id)->get()->first();

        if($studentLRN->LRN != null){
            $updateEnrollmentStatus->update([
                'status' => 'approved',
            ]);

            return redirect()->to(route('students.all'));
        }
        else{
            return redirect()->back()->with('error', 'Please provide LRN to student first');
        }
    }
    // provide student an LRN if they dont have one.
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
            $provideStudentLRN = StudentInformation::where('student_id', $id);

            $provideStudentLRN->update([
                'LRN' => $request->LRN,
            ]);
            return redirect()->back();
        }
        
    }
}
