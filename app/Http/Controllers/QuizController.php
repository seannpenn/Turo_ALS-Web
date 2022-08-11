<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Topic;
class QuizController extends Controller
{
    // creation of quiz
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
    // editing of quiz
    public function edit($id){
        $selectedQuiz = Quiz::where('quiz_id',$id)->get();
            
        return view('dashboard.quiz.edit')->with(compact('selectedQuiz'));
    }
    public function update(Request $request, $id){
        $rules = [
            'quiz_title' => 'required',
        ];

        $messages = [
            'quiz_title.required' => 'Please input quiz title.',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);


        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{
            $updateQuiz = Quiz::where('quiz_id',$id)->get()->first();
            $topic = Topic::where('topic_id', $updateQuiz['topic_id']);
            $updateQuiz->update([
                'quiz_title' => $request->quiz_title,
            ]);
            $topic->update([
                'topic_title' => $request->quiz_title,
            ]);
            
            return back();
        }
    }
    // manage all quizzes created by the teacher
    public function manage(){
        $quizCollection = Quiz::getAllQuiz();
        return view('dashboard.quiz.manage')->with(compact('quizCollection'));  
    }

}
