<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Response;
use App\Models\Question;
use App\Models\Option;
// use App\Events\Questions;
use App\Models\Quiz;
class QuestionController extends Controller
{
    // creation of question
    public function create(Request $request){
        
        $rules = [
            'question' => 'required',
        ];

        $messages = [
            'question.required' => 'Please input question.',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);
        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{

            $questionId = Question::insertGetId([
                'quiz_id' => $request['quiz_id'],
                'question' => $request['question'],
            ]);
            
            Option::create([
                'question_id' => $questionId,
                'option' => "Untitled option",
            ]);
            
            return redirect()->back();
        }
    }
    // updating of question
    public function update(Request $request, $id){
        $rules = [
            'question' => 'required',
        ];

        $messages = [
            'question.required' => 'Please input question.',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);
        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{

            $updateQuestion = Question::where('question_id',$id);
            $updateQuestion->update([
                'question' => $request->question,
                'type' => $request->type
            ]);
            return back();
        }
    }

    // get all questions

    public function getAllQuestions($id){
        $selectedQuiz = Quiz::where('course_id', $courseid)->get();
        $questionCollection = $selectedQuiz->question;
        return Response::json($questionCollection);
    }

    // get single question

    public function getQuestion($id){
        $selectedQuiz = Question::where('question_id', $id)->get();
        return Response::json($selectedQuiz);
    }

    // deleting of question
    public function delete($id){
        
        $selectedQuestion = Question::findOrFail($id);
            
        $selectedQuestion->delete();
        return redirect()->back();
    }
}
