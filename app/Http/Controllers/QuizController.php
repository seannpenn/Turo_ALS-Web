<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Quiz;
class QuizController extends Controller
{
    
    public function create(Request $request, $topicId){
        $rules = [
            'quiz_title' => 'required',
        ];

        $messages = [
            'quiz_title.required' => 'Please input a quiz title',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);

        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{
    
            $quiz = new Quiz();

            $quiz->topic_id = $topicId;
            $quiz->quiz_title = $request->quiz_title;
            
            $course->save();

            return back();
        }
    }
    public function manage(){
        $quizCollection = Quiz::getAllQuiz();
        return view('dashboard.quiz.manage')->with(compact('quizCollection'));  
    }
}
