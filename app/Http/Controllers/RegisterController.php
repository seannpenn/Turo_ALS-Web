<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
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
            return redirect()->intended('teacher.home');
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
        Teacher::create([
            'user_id' => $userId,
            'student_fname' => $request->student_fname,
            'student_mname' => $request['student_mname'],
            'student_lname' => $request['student_lname'],
            'student_number' => $request['student_number'],
            'student_birth' => $request['student_birth'],
        ]);


        if(Auth::attempt($loginCredentials)){
            
            $request->session()->regenerate();
            return redirect()->intended('student.home');
        }

        return redirect()->to('student.login');
    }
}
