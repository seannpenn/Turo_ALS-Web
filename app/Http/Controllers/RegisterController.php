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
    public function register(Request $request){

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
            'teacher_fname' => $request['teacher_fname'],
            'teacher_mname' => $request['teacher_mname'],
            'teacher_lname' => $request['teacher_lname'],
            'teacher_number' => $request['teacher_number'],
            'teacher_birth' => $request['teacher_birth'],
        ]);


        if(Auth::attempt($loginCredentials)){
            
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return redirect()->to('login');
    }
}
