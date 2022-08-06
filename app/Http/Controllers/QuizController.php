<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Topic;
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
    public function manage(){
        $quizCollection = Quiz::getAllQuiz();
        return view('dashboard.quiz.manage')->with(compact('quizCollection'));  
    }
    public function manageQuestions($id){
        
    }

    // for questions

    public function createQuestion(Request $request){
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
}
