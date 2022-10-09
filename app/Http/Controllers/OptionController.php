<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Models\Option;
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
            
            return redirect()->back();
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
            ]);
            return back();
        }
    }

    public function delete($id){
        
        $selectedOption = Option::findOrFail($id);
            
        $selectedOption->delete();
        return redirect()->back();
    }
}
