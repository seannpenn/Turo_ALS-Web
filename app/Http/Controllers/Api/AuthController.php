<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
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

            return response()->json([
                'status' =>true,
                'message' => 'User Created',
                'token' => 'gsdgfhgdfhdfhdfhfdhdfhdfhdf'
            ]);

            // if(Auth::attempt($loginCredentials)){
            
            //     $request->session()->regenerate();
            //     return redirect()->intended('teacher.home');
            // }
    
            // return redirect()->to('t-login');

    }

    public function StudentLogin(Request $request){
        $loginCredentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        if(Auth::attempt($loginCredentials)){
            $user = User::where('username', $request->username)->get()->first();
            $request->session()->regenerate();

            return response()->json([
                'status' => true,
                'message' => 'Logged in user',
                'token' => $request->session()->token(),
                'user' => $user,
            ]);
            
        }
        
        return response()->json([
            'status' => false,
            'message' => "Error loggin in ",
        ]);
        

    }
    public function logout(){
        if(Auth::user()->userType == 0){
            Auth::logout();
            return response()->json([
                'status' => true,
                'message' => "Logged out."
            ]);
        }
    }

}
