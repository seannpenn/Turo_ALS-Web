<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\StudentBackground;
use App\Models\StudentInformation;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Validator;
class RegisterController extends Controller
{
    //
    public function teacherRegister(Request $request){

        $loginCredentials = $request->validate([
            'userType' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);


        $userId = User::insertGetId([
            'userType' =>$loginCredentials['userType'],
            'username' => $loginCredentials['username'],
            'email' => $loginCredentials['email'],
            'password' => bcrypt($loginCredentials['password']),
        ]);
        Teacher::create([
            'user_id' => $userId,
            'teacher_fname' => $request->teacher_fname,
            'teacher_mname' => $request['teacher_mname'],
            'teacher_lname' => $request['teacher_lname'],
            'teacher_number' => $request['teacher_number'],
            'teacher_birth' => $request['teacher_birth'],
        ]);
        
        

        if(Auth::attempt($loginCredentials)){
            
            $request->session()->regenerate();
            return redirect()->intended('/admin/home');
        }

        return redirect()->to('t-login');
    }

    public function studentRegister(Request $request){

        $loginCredentials = $request->validate([
            'userType' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);


        $userId = User::insertGetId([
            'userType' =>$loginCredentials['userType'],
            'username' => $loginCredentials['username'],
            'email' => $loginCredentials['email'],
            'password' => bcrypt($loginCredentials['password']),
        ]);
        $studentId = Student::insertGetId([
            'user_id' => $userId,
            'LRN' => $request['LRN'],
            'student_fname' => $request['student_fname'],
            'student_mname' => $request['student_mname'],
            'student_lname' => $request['student_lname'],
            'student_gender' => $request['student_gender'],
            'student_civil' => $request['student_civil'],
            'student_birth' => $request['student_birth'],
        ]);
        StudentInformation::create([
            'studentId' => $studentId,
            'street' => $request['street'],
            'barangay' => $request['barangay'],
            'city' => $request['city'],
            'province' => $request['student_fname'],
            'student_motherfname' => $request['student_motherfname'],
            'student_mothermname' => $request['student_mothermname'],
            'student_motherlname' => $request['student_motherlname'],
        ]);
        StudentBackground::create([
            'studentId' => $studentId,
            'last_level' => $request['last_level'],
            'program_attended' => $request['program_attended'],
            'program_literacy' => $request['program_literacy'],
            'program_attended_year' => $request['program_attended_year'],
        ]);


        if(Auth::attempt($loginCredentials)){
            
            $request->session()->regenerate();
            return redirect()->intended('/student/home');
        }

        return redirect()->to('student.login');
    }
}
