<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
class QuizController extends Controller
{
    // creation of quiz
    public function create(Request $request){
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

            $quiz->teacher_id = Auth::user()->teacher->teacher_id;
            $quiz->quiz_title = $request->quiz_title;
            $quiz->course_id = $request->course_id;
            $quiz->save();

            return back();
        }
    }
    // editing of quiz
    public function edit($courseid, $id){
        $selectedQuiz = Quiz::where('quiz_id',$id)->get();
            
        return view('dashboard.quiz.edit')->with(compact('selectedQuiz'));
    }
    public function update($id, Request $request){
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
        $quizCollection = Quiz::where('teacher_id', Auth::user()->teacher->teacher_id)->get();
        return view('dashboard.quiz.manage')->with(compact('quizCollection'));  
    }
    public function getAllQuizzes($courseid){
        $quizCollection = Quiz::where('course_id', $courseid)->get();
        return Response::json($quizCollection);
    }

}
