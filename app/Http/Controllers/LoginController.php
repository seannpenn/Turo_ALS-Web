<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function login(Request $request){
        $loginCredentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($loginCredentials)){
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'username.required' => 'This username entry cannot be blank.',
            'password.required' => 'Empty passwords are not accepted'
        ])->onlyInput('username');
    }

    public function logout(){
        Auth::logout();
        return redirect()->to('login');
    }
}
