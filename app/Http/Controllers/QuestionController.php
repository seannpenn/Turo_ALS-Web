<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
class QuestionController extends Controller
{
    public function create(Request $request){

        $loginCredentials = $request->validate([
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

    public function delete($id){
        
        $selectedQuestion = Question::findOrFail($id);
            
        $selectedQuestion->delete();
        return redirect()->back();
    }
}
