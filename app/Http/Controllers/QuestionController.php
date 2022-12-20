<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Response;
use App\Models\Question;
use App\Models\Option;
use App\Models\QuizAnswer;
use App\Models\QuizSummary;
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
                'type' => $request->type,
                'points' => $request->points,
            ]);
            return response()->json($updateQuestion->get()->first());
        }
    }
    // public function updatePoint(Request $request, $id){
    //     $selectedQuestion = Question::where('question_id',$id);
            
    //     $selectedQuestion->update([
    //         'points' => $request->points
    //     ]);
    //     return Response::json($selectedQuestion);
    // }

    public function markAnswer(Request $request, $answer_id){
        $chosenAnswer = QuizAnswer::where('quiz_answer_id',$answer_id)->get()->first();
        $quizSummary = QuizSummary::where('attempt_id',$chosenAnswer->attempt_id)->get()->first();

        $chosenAnswer->update([
            'points' => $request->points,
        ]);
        $quizSummary->update([
            'total_score' => $quizSummary->total_score+=$chosenAnswer->points,
        ]);

        return Response::json($chosenAnswer);
    }

    // get all questions

    public function getAllQuestions($id){
        $questionModel = new Question;
        $questions = $questionModel->getAll($id);
        
        
        // $selectedQuiz = Question::where('quiz_id', $id)->get();
        // $questionCollection = $selectedQuiz->question;
        // echo json_encode($selectedQuiz);
        return Response::json($questions);
    }

    // get single question

    public function getQuestion($id){
        $selectedQuestion = Question::where('question_id', $id)->get()->first();
        return response()->json($selectedQuestion);
    }

    // deleting of question
    public function delete($id){
        
        $selectedQuestion = Question::findOrFail($id);
            
        $selectedQuestion->delete();
        return response()->json($selectedQuestion);
    }
}
