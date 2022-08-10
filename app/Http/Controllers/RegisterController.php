<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\StudentEducation;
use App\Models\StudentFamily;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Validator;
class RegisterController extends Controller
{
    //
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

        return redirect()->to('student.home');
    }

    public function studentRegister(Request $request){

        $loginCredentials = $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);


        User::create([
            'userType' =>  $request['userType'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        
        

        if(Auth::attempt($loginCredentials)){
            
            $request->session()->regenerate();
            
            return redirect()->to('/student/home');
        }

        return redirect()->to('student.registration');
    }
}
