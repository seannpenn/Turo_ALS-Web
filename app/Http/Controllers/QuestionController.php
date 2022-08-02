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

    public function update(Request $request){
        $rules = [
            'question' => 'required',
            'choice_a' => 'required',
            'choice_b' => 'required',
            'answer' => 'required'
        ];

        $messages = [
            'question.required' => 'Please input question.',
            'choice_a.required' => 'Please input a choice.',
            'choice_b.required' => 'Please input a choice.',
            'answer.required' => 'Please set an answer for this question.',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);
        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{
            $questionModel = new Question();

            $questionModel->quiz_id = $request['quiz_id'];
            $questionModel->question = $request['question'];
            $questionModel->choice_a = $request['choice_a'];
            $questionModel->choice_b = $request['choice_b'];
            $questionModel->choice_c = $request['choice_c'];
            $questionModel->choice_d = $request['choice_d'];
            $questionModel->answer = $request['answer'];
            $questionModel->save();
            
            
            return back();
        }
    }

    public function delete($id){
        
        $selectedQuestion = Question::findOrFail($id);
            
        $selectedQuestion->delete();
        return redirect()->back();
    }
}
