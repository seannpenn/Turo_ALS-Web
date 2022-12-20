<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Question;
use App\Models\QuizAnswer;
use Response;
class OptionController extends Controller
{
    //
    public function create(Request $request){
        
        $rules = [
            'question_id' => 'required',
            'option' => 'required'
        ];

        $messages = [
            'question_id.required' => 'Question ID missing',
            'option.required' => 'option missing'
        ];

        $validation = Validator::make($request->input(), $rules, $messages);
        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{
            $optionModel = new Option();

            $optionModel->question_id = $request['question_id'];
            $optionModel->option = $request['option'];
            $optionModel->save();
            
            return Response::json($optionModel);
        }
    }

    // updating of option
    public function update(Request $request, $id){
        $rules = [
            'option' => 'required',
        ];

        $messages = [
            'option.required' => 'Please input question.',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);
        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{

            $updateOption = Option::where('option_id',$id);
            $updateOption->update([
                'option' => $request->option,
                // 'isCorrect' => $request->isCorrect,
            ]);
            return Response::json($updateOption);
        }
    }
    public function getOptions($questionId){
        $optionModel = new Option;
        $options = $optionModel->getAllOption($questionId);
        // $selectedQuiz = Question::where('quiz_id', $id)->get();
        // $questionCollection = $selectedQuiz->question;
        // echo json_encode($selectedQuiz);
        return Response::json($options);
    }
    public function delete($id){
        
        $selectedOption = Option::findOrFail($id);
            
        $selectedOption->delete();
        return response()->json($selectedOption);
    }
    public function deleteAll($id){
        $optionModel = new Option;
        $OptionCollection = $optionModel->getAllOption($id);
        $question = Question:: where('question_id', $id)->get()->first();
        foreach ($OptionCollection as $option) {
            $option->delete();
        }
        // return redirect()->back();
        return response()->json($question);
    }
    public function setAnswer(Request $request, $id){
        $updateOption = Option::where('option_id',$id);
        $question = Question:: where('question_id', $updateOption->first()->question_id)->get()->first();
            $updateOption->update([
                'isCorrect' => $request->isCorrect,
            ]);
            return response()->json($question);
    }

    public function considerAnswer(Request $request, $id){
        $answer = QuizAnswer::where('quiz_answer_id',$id)->get()->first();
        $answer->update([
            'isCorrect' => $request->isCorrect,
        ]);
        return Response::json($answer);
    }
}
