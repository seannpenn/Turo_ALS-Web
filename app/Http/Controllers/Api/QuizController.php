<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Quiz;
use App\Models\Question;
class QuizController extends Controller
{
    //
    public function show($id){
        $topic = Topic::where('topic_id',$id)->get()->first();
        $quiz = $topic->selectedquiz;
        $questions = $quiz->question;

        return response()->json([
            'status' => true,
            'quiz' => $quiz,
            
        ]);
    }
}
