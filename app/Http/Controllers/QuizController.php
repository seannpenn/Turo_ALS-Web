<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuizAnswer;
use App\Models\QuizSummary;
use App\Models\Option;
use App\Models\Topic;
use App\Models\QuestionType;
use App\Models\QuizAttempt;
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
        $types = QuestionType::getAllType();
        
        return view('dashboard.quiz.edit')->with(compact(['selectedQuiz', 'types']));
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
            return Response::json($updateQuiz);
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

    // get quizzes for student

    public function getQuizzes($courseid){
        $quizCollection = Quiz::where('course_id', $courseid)->get();
        return view('student.quiz.display')->with(compact('quizCollection'));
    }
    public function viewQuiz($courseid,$quizid){
        $chosenQuiz = Quiz::where('quiz_id', $quizid)->get();
        return view('student.quiz.viewQuiz')->with(compact('chosenQuiz'));
    }
    public function takeQuiz($courseid,$quizid){
        
        $chosenQuiz = Quiz::where('quiz_id', $quizid)->get()->first();
        $questions = $chosenQuiz->question;

        $quizAttempt = QuizAttempt::where('quiz_id', $quizid)->get()->first();
        if($quizAttempt != null){
            $restricted = "You have already taken this quiz.";
            return view('student.quiz.takeQuiz')->with(compact(['chosenQuiz', 'questions', 'restricted']))->with('message', 'You have already taken this quiz.');
        }
        else{
            QuizAttempt::insertGetId([
                'quiz_id' => $quizid,
            ]);
            return view('student.quiz.takeQuiz')->with(compact(['chosenQuiz', 'questions']))->with('message');
        }
        

        
    }

    // post quiz answers

    public function storeAnswers($courseid,$quizid, Request $request){
        
        $input = $request->collect();
        
        $attempt = QuizAttempt::where('quiz_id', $quizid)->get()->last();
        $request->collect('questions')->each(function ($option,$question) {
            $attempt = QuizAttempt::where('quiz_id', request()->route('quizid'))->get()->last();
            $isCorrect = Option::where('option_id',$option)->get()->first();

            QuizAnswer::create([
                'attempt_id' => $attempt->attempt_id,
                'student_id' => Auth::user()->student->student_id,
                'question_id' => $question,
                'option_id' => $option,
                'isCorrect' => $isCorrect->isCorrect
            ]);

            echo $question,$option . '\n';
        });
        
        $request->collect('options')->each(function($question,$option){
            $attempt = QuizAttempt::where('quiz_id', request()->route('quizid'))->get()->last();
            $isCorrect = Option::where('option_id',$option)->get()->first();

            QuizAnswer::create([
                'attempt_id' => $attempt->attempt_id,
                'student_id' => Auth::user()->student->student_id,
                'question_id' => $question,
                'option_id' => $option,
                'isCorrect' => $isCorrect->isCorrect
            ]);

            echo $question,$option . '\n';
        });
        // dd($input);
        $totalPoints = QuizAnswer::where('attempt_id', 1)->where('isCorrect', 1)->get();
        $result = QuizSummary::create([
                'attempt_id'=> $attempt->attempt_id,
                'total_score' => $totalPoints->count(),
            ]);
        
        $totalScore = $totalPoints->count();
        return redirect()->route('student.viewQuiz', [request()->route('courseid'), $quizid])->with('totalScore');
    }

    public function viewResult($courseid,$quizid){
        $chosenQuiz = Quiz::where('quiz_id', $quizid)->get()->first();
        $questions = $chosenQuiz->question;

        $quizAttempt = QuizAttempt::where('quiz_id', $quizid)->get()->last();
        $QuizAnswers = $quizAttempt->quizAnswer;
        return view('student.quiz.viewResult')->with(compact(['chosenQuiz', 'questions', 'QuizAnswers']));
    }

}
