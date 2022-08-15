<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Programs;
use App\Models\LearningCenter;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\StudentEducation;
use App\Models\StudentFamily;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Validator;
class RegisterController extends Controller
{
    //Teacher registration page
    public function teacherRegistration(){
        $programs = Programs::getAll();
        $locations = LearningCenter::getAll();
        return view('login.teacher_registration')->with(compact('programs', 'locations'));
    }
    
    public function teacherRegister(Request $request){

        $loginCredentials = $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);


        $userId = User::insertGetId([
            'userType' =>$request['userType'],
            'username' => $loginCredentials['username'],
            'email' => $loginCredentials['email'],
            'password' => bcrypt($loginCredentials['password']),
        ]);
        Teacher::create([
            'user_id' => $userId,
            'prog_id' => $request['prog_id'],
            'loc_id' => $request['loc_id'],
            'teacher_fname' => $request->teacher_fname,
            'teacher_mname' => $request['teacher_mname'],
            'teacher_lname' => $request['teacher_lname'],
            'teacher_number' => $request['teacher_number'],
            'teacher_birth' => $request['teacher_birth'],
        ]);
        

        if(Auth::attempt($loginCredentials)){
            
            $request->session()->regenerate();
            return redirect()->intended('/admin/course/all');
        }

        return redirect()->to('teacher.registration');
    }

    //Student registration page
    public function studentRegistration(){
        $programs = Programs::getAll();
        $locations = LearningCenter::getAll();
        return view('login.student_registration')->with(compact('programs', 'locations'));
    }

    public function studentRegister(Request $request){

        $loginCredentials = $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            
        ]);

        $info = $request->validate([
            'student_fname' => 'required',
            'student_lname' => 'required'
        ]);

        $userId = User::insertGetId([
            'userType' =>  $request['userType'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        Student::create([
            'user_id' => $userId,
            'loc_id' => $request->loc_id,
            'student_fname' => $request->student_fname,
            'student_mname' => $request->student_mname,
            'student_lname' => $request->student_lname,
        ]);
        

        if(Auth::attempt($loginCredentials)){ 
            
            $request->session()->regenerate();
            
            return redirect()->to('/student/home');
        }

        return redirect()->to('student.registration');
    }
}
