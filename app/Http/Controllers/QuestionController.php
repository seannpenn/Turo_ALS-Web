<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Models\Question;
class QuestionController extends Controller
{
    // creation of question
    public function create(Request $request){
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
    // updating of question
    public function update(Request $request, $id){
        $rules = [
            'question' => 'required',
            'choice_a' => 'required',
            'choice_b' => 'required',
            'choice_c' => 'required',
            'choice_d' => 'required',
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

            $updateQuestion = Question::where('question_id',$id);
            $updateQuestion->update([
                'question' => $request->question,
                'choice_a' => $request->choice_a,
                'choice_b' => $request->choice_b,
                'choice_c' => $request->choice_c,
                'choice_d' => $request->choice_d,
                'answer' => $request->answer,
                
            ]);
            return back();
        }
    }
    // deleting of question
    public function delete($id){
        
        $selectedQuestion = Question::findOrFail($id);
            
        $selectedQuestion->delete();
        return redirect()->back();
    }
}
