<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Question;
class QuizController extends Controller
{
    public function show($id){
        $course = Course::where('course_id',$id)->get()->first();
        $quiz = $course->quiz;

        return response()->json([
            'status' => true,
            'quizzes' => $quiz,
        ]);
    }

    public function getQuestion($id){
        $quiz = Quiz::where('quiz_id',$id)->get()->first();
        $question = Question::where('quiz_id',$quiz->quiz_id)->get()->first();
        $questions = $quiz->question;

        return response()->json([
            'status' => true,
            'questions' => $questions,
        ]);
    }
    public function getOption($id){
        // $options = Option::where('question_id',$id)->get();
        $question = Question::where('question_id',$id)->get()->first();
        $options = $question->option;
        // $questions = $quiz->question;

        return response()->json([
            'status' => true,
            'options' => $options,
        ]);
    }
}
