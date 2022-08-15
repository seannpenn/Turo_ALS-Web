<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Teacher login
    public function teacherLogin(Request $request){
        $loginCredentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($loginCredentials)){
            $request->session()->regenerate();
            // User is automatically logged out when they log in to a wrong portal.
            if(Auth::user()->userType == 2){
                Auth::logout();
                return redirect()->to('/student/login')->with('error', 'You are not allowed to gain Admin access.');
            }
            else if(Auth::user()->userType == 0){
                return redirect()->to(route('users.all'));
            }
            return redirect()->to(route('course.all'));
        }

        return back()->withErrors([
            'username.required' => 'This username entry cannot be blank.',
            'password.required' => 'Empty passwords are not accepted'
        ])->onlyInput('username');
    }
    // Student login
    public function studentLogin(Request $request){
        $loginCredentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($loginCredentials)){
            $request->session()->regenerate();
            if(Auth::user()->userType == 1){
                Auth::logout();
                return redirect()->to('/student/login');
            }
            return redirect()->to(route('student.home'));
        }

        return back()->withErrors([
            'username.required' => 'This username entry cannot be blank.',
            'password.required' => 'Empty passwords are not accepted'
        ])->onlyInput('username');
    }


    public function logout(){
        if(Auth::user()->userType == 1){
            Auth::logout();
            return redirect()->to('/teacher');
        }
        else if(Auth::user()->userType == 2){
            Auth::logout();
            return redirect()->to('/student/login');
        }
        else{
            Auth::logout();
            return redirect()->to('/teacher');
        }
    }
}
