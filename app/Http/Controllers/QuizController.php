<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use App\Models\Quiz;
use Redirect;
use App\Models\Question;
use App\Models\QuizAnswer;
use App\Models\QuizSummary;
use App\Models\Option;
use App\Models\Topic;
use App\Models\QuestionType;
use App\Models\QuizAttempt;
use App\Models\Enrollment;
use App\Models\Student;
use Carbon\Carbon;
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

    public function delete($quizid){
        $chosenQuiz = Quiz::findOrFail($quizid);
        $chosenQuiz->delete();
        return back();
    }
    public function activateorDeactivate($quizid){
        $validateOptionCorrectAnswer = 0;
        $activateQuiz = Quiz::where('quiz_id',$quizid)->get()->first();
        $questions = $activateQuiz->question;
        foreach($questions as $question){
            foreach($question->option as $option){
                if($option->isCorrect){
                    $validateOptionCorrectAnswer++;
                }
            }
        }
        if($activateQuiz->start_date != null && $activateQuiz->end_date != null && 
            $activateQuiz->start_time != null && $activateQuiz->end_time != null &&
            $activateQuiz->duration != null && $validateOptionCorrectAnswer >= $questions->count()){

            if($activateQuiz->status == 'active'){
                $activateQuiz->update([
                    'status' => 'inactive',
                ]);
                return Response::json($activateQuiz);
            }
            else{
                $activateQuiz->update([
                    'status' => 'active',
                ]);
                return Response::json($activateQuiz);
            }
        }else{
            return Response::json(array(
                'msg' => 'Incorrect!',
                'error' => $validateOptionCorrectAnswer
            ), 404);
        }
            
    }
    // editing of quiz
    public function edit($courseid, $quizid){
        $selectedQuiz = Quiz::where('quiz_id',$quizid)->get();
        $types = QuestionType::getAllType();
        $students = Enrollment::getEnrolleesByLocProg(Auth::user()->teacher->loc_id, Auth::user()->teacher->prog_id);
        $studentAttempt = QuizAttempt::getAll();
        $questions = $selectedQuiz[0]->question;
        $correctAnswers =[];

        foreach($questions as $question){
            foreach($question->option as $option){
                if($question->type == 2){
                    $correctAnswers = explode(', ', $option->option);
                    // echo $spliceCorrectAnswer;
                }
            }
            
        }

        // $quizAttempt = QuizAttempt::where('quiz_id', $quizid)->get()->last();
        // echo $selectedQuiz[0]['start_date'];

        // dd($quizid);
        return view('dashboard.quiz.edit')->with(compact(['selectedQuiz', 'types', 'students', 'questions', 'correctAnswers']));
    }

    public function quizSetup($courseid, $quizid, Request $request){
        // $data = $request->all();
        $startDate=  Carbon::parse($request->start_date)->isoFormat('MMMM DD YYYY');
        $endDate=  Carbon::parse($request->end_date)->isoFormat('MMMM DD YYYY');
        // echo $request->start_time;
        // $startTime = Carbon::createFromFormat('H:i:s',$request->start_time)->format('g:i A');
        // echo $startTime;
        // $endTime = Carbon::createFromFormat('H:i:s',$request->start_time)->format('g:i A');
        // dd($request);
        $setupQuiz = Quiz::where('quiz_id',$quizid)->get()->first();

        $hours = $request->duration[0] * 60; //hours in minutes
        $duration = $hours + $request->duration[1]; //total duration in minutes
        $setupQuiz->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'attempts' => $request->attempts,
            'password' => $request->password,
            'releaseGrades' => $request->releaseGrades,
            'duration' => $duration,
        ]);

        return back();
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
    public function manage($courseid){
        $quizCollection = Quiz::where('teacher_id', Auth::user()->teacher->teacher_id)->where('course_id', $courseid)->get();
        return view('dashboard.quiz.manage')->with(compact('quizCollection'));  
    }
    public function getEntireQuizzes(){
        $quizCollection = Quiz::getAllQuiz();
        return Response::json($quizCollection);
    }
    public function getAllQuizzes($courseid){
        $quizCollection = Quiz::where('course_id', $courseid)->get();
        return Response::json($quizCollection);
    }
    public function viewStudentAttempt($courseid, $quizid, $studentid){
        $studentData = Student::where('student_id', $studentid)->get();
        $quizAttempt = QuizAttempt::where('quiz_id', $quizid)->where('student_id', $studentid)->get();
        $selectedQuiz = Quiz::where('quiz_id', $quizid)->get();
        $correctAnswers =[];

        foreach($selectedQuiz[0]->question as $question){
            foreach($question->option as $option){
                if($question->type == 2){
                    $correctAnswers = explode(', ', $option->option);
                    // echo $spliceCorrectAnswer;
                }
            }
            
        }
        return view('dashboard.quiz.viewStudentAttempt')->with(compact('quizAttempt', 'studentData', 'selectedQuiz', 'correctAnswers'));
    }

    // get quizzes for student

    public function getQuizzes($courseid){
        $quizCollection = Quiz::where('course_id', $courseid)->where('status', 'active')->get();
        $quizCollection->each(function ($quiz){
            // echo Carbon::parse($quiz->start_date)->isoFormat('MMMM DD YYYY');
            // echo Carbon::parse($quiz->end_date)->isoFormat('MMMM DD YYYY');
            // echo Carbon::createFromFormat('H:i',$quiz->start_time)->format('H:i A');
            // echo Carbon::createFromFormat('H:i',$quiz->end_time)->format('H:i A');
        });
        // dd($courseid);

        // $startDate = Carbon::parse($selectedQuiz[0]['start_date'])->isoFormat('MMMM DD YYYY');
        // echo $startDate;
        // $endDate = Carbon::parse($selectedQuiz[0]['end_date'])->isoFormat('MMMM DD YYYY');
        // echo $endDate;
        // $startTime = Carbon::createFromFormat('H:i',$selectedQuiz[0]['start_time'])->format('h:i A');
        // echo $startTime;
        // $endTime = Carbon::createFromFormat('H:i',$selectedQuiz[0]['end_time'])->format('h:i A');
        // echo $endTime;

        // $settingsData = [
        //     'start_date' => $startDate,
        //     'end_date' => $endDate,
        //     // 'start_time' => $startTime,
        //     // 'end_time' => $endTime,
        //     'attempts' => $selectedQuiz[0]['attempts'],
        //     'status' => $selectedQuiz[0]['status'],
        //     'password' => $selectedQuiz[0]['password'],
        // ];
        return view('student.quiz.display')->with(compact('quizCollection'));
    }
    public function viewQuiz($courseid,$quizid){
        $chosenQuiz = Quiz::where('quiz_id', $quizid)->get();
        return view('student.quiz.viewQuiz')->with(compact('chosenQuiz'));
    }
    public function takeQuiz($courseid,$quizid, Request $request){
        
        
        $chosenQuiz = Quiz::where('quiz_id', $quizid)->get()->first();
        if($chosenQuiz->password != null){
            if($chosenQuiz->password == $request->quizPass){
                $questions = $chosenQuiz->question;

                $quizAttempt = QuizAttempt::where('quiz_id', $quizid)->where('student_id', Auth::user()->student->student_id)->get()->last();
                // if($quizAttempt != null){
                //     $restricted = "You have already taken this quiz.";
                //     return view('student.quiz.takeQuiz')->with(compact(['chosenQuiz', 'questions', 'restricted']))->with('message', 'You have already taken this quiz.');
                // }
                // else{
                    QuizAttempt::insertGetId([
                        'quiz_id' => $quizid,
                        'student_id' => Auth::user()->student->student_id,
                    ]);
                    return view('student.quiz.takeQuiz')->with(compact(['chosenQuiz', 'questions']))->with('message');
                // }
            }
            else{
                return redirect()->back()->withErrors(['wrongPassword' => 'Password is not correct.']);
            }
        }
        else{
                $questions = $chosenQuiz->question;

                $quizAttempt = QuizAttempt::where('quiz_id', $quizid)->where('student_id', Auth::user()->student->student_id)->get();
                if($quizAttempt->count() == $chosenQuiz->attempts){
                    $restricted = "You have already taken this quiz.";
                    return view('student.quiz.takeQuiz')->with(compact(['chosenQuiz', 'questions', 'restricted']))->with('message', 'You have already taken this quiz.');
                }
                else{
                    QuizAttempt::insertGetId([
                        'quiz_id' => $quizid,
                        'student_id' => Auth::user()->student->student_id,
                    ]);
                    return view('student.quiz.takeQuiz')->with(compact(['chosenQuiz', 'questions']))->with('message');
                }
        }
        
        
    }

    // post quiz answers

    public function storeAnswers($courseid,$quizid, Request $request){
       
        $quizAttempt = QuizAttempt::where('quiz_id', $quizid)->get()->last();
        
        $input = $request->collect();
        
        $attempt = QuizAttempt::where('quiz_id', $quizid)->where('student_id', Auth::user()->student->student_id)->get()->last();
        $request->collect('questions')->each(function ($option,$question) {
            $attempt = QuizAttempt::where('quiz_id', request()->route('quizid'))->where('student_id', Auth::user()->student->student_id)->get()->last();
            $questionData = Question::where('question_id', $question)->get()->first();
            $optionData = Option::where('option_id',$option)->get()->first();
            
            if((int)$option == 0){
                QuizAnswer::create([
                    'attempt_id' => $attempt->attempt_id,
                    'student_id' => Auth::user()->student->student_id,
                    'question_id' => $question,
                    'isCorrect' => $optionData->isCorrect??null,
                    'textAnswer' => $option
                ]);
            }
            else{
                QuizAnswer::create([
                    'attempt_id' => $attempt->attempt_id,
                    'student_id' => Auth::user()->student->student_id,
                    'question_id' => $question,
                    'option_id' => $option,
                    'isCorrect' => $optionData->isCorrect,
                    'points' => $optionData->isCorrect == 0 ? 0: $questionData->points,
                ]);
            }
            
            echo $question,$option . '\n';
        });
        
        $request->collect('options')->each(function($question,$option){
            $attempt = QuizAttempt::where('quiz_id', request()->route('quizid'))->where('student_id', Auth::user()->student->student_id)->get()->last();
            $optionData = Option::where('option_id',$option)->get()->first();
            $questionData = Question::where('question_id', $question)->get()->first();
            QuizAnswer::create([
                'attempt_id' => $attempt->attempt_id,
                'student_id' => Auth::user()->student->student_id,
                'question_id' => $question,
                'option_id' => $option,
                'isCorrect' => $optionData->isCorrect,
                'points' => $optionData->isCorrect == 0 ? 0: $questionData->points,
            ]);

            echo $question,$option . '\n';
        });
        $quiz = Quiz::where('quiz_id', $quizid)->get()->first();
        $totalPoints = 0;
        $totalScore = 0;
        $correctCount = 0;
        $optionCorrect = 0;
        $incorrectCount = 0;
        $questions = $quiz->question;
        $correctAnswers =[];

        foreach($questions as $question){
            foreach($question->option as $option){
                if($question->type == 2){
                    $correctAnswers = explode(', ', $option->option);
                }
            }
        }
        
        foreach($quiz->question as $question){

            foreach($question->option as $option){
                if($option->isCorrect){
                    $optionCorrect++;
                }
                if($question->type == 1){
                    foreach($attempt->quizAnswer as $answer){
                        if($answer->question_id == $option->question_id){
                            if($answer->isCorrect){
                                $correctCount++;
                            }
                        }
                        
                    }
                }
                else if($question->type == 3){
                    foreach($attempt->quizAnswer as $answer){
                        // if($answer->isCorrect){
                        //     $correctCount++;
                        // }
                            if($answer->option_id == $option->option_id){
                                if($answer->isCorrect && $option->isCorrect){
                                    $correctCount++;
                                }
                                else{
                                    $incorrectCount++;
                                }
                            }
                    }

                    
                }
                else if($question->type == 2){
                    foreach($attempt->quizAnswer as $answer){
                        foreach($correctAnswers as $correctanswer){
                            if($answer->textAnswer === $correctanswer){
                                $totalScore+=$question->points;
                            }
                        }
                    }
                }
                
                // foreach($attempt->quizAnswer as $answer){
                //     if($option->answer){
                //         if($answer->option_id == $option->option_id){
                //             if($answer->isCorrect){
                //                 $correctCount++;
                //             }
                //             else{
                //                 $incorrectCount++;
                //             }
                //         }
                //     }
                //     else{
                //         foreach($correctAnswers as $correctanswer){
                //             if($answer->textAnswer === $correctanswer){
                //                 $totalScore+=$question->points;
                //             }
                //         }
                //     }
                // }
            }
            $totalPoints +=$question->points;

            if($optionCorrect == $correctCount){
                if($incorrectCount == 0){
                    $totalScore+=$question->points;
                }
                
            }
            // if($optionCorrect > 1){
            //     if($incorrectCount == 0){
            //         if($correctCount ==  $optionCorrect){
            //             $totalScore+=$question->points;
            //         }
            //     }
                
            // }
            // else{
            //     if($incorrectCount == 0){
            //         $totalScore+=$question->points;
            //     }
            // }
        }

        // for checkboxes
        

        echo $totalScore;

        $result = QuizSummary::create([
                'attempt_id'=> $attempt->attempt_id,
                'total_score' => $totalScore,
                'total_points' => $totalPoints
            ]);
        
        return redirect()->route('student.viewQuiz', [request()->route('courseid'), $quizid]);
    }

    
    public function saveAnswerToSession(Request $request){
        $selectedQuestion = Question::where('question_id',$request->questionid)->get()->first();
        if($request->method == "delete"){
            $request->session()->forget($request->key);
            return Response::json($selectedQuestion);
        }
        else{
            if($request->questionType == 1){
                $request->session()->put($request->key, $request->optionid);
            }
            else if($request->questionType == 3){
                $request->session()->put($request->key, $request->optionid);
            }
            else if($request->questionType == 2){
                $request->session()->put($request->key, [$request->optionid, $request->answer]);
            }
            return Response::json($selectedQuestion);
        }

        
    }

    public function recalculateScore($quizid){
        $selectedQuiz = Quiz::where('quiz_id', $quizid)->get()->first();
        $students = Enrollment::getEnrolleesByLocProg(Auth::user()->teacher->loc_id, Auth::user()->teacher->prog_id);
        // foreach($students as $student){
        //     echo $student->student->quizAttemptByStudentByQuiz($student->student_id, $quizid)->quizAnswer;
        // }
        $totalPoints = 0;
        $totalScore = 0;
        $correctAnswers =[];
        $attempt = new QuizAttempt;
        $quizAttempts = $attempt->attemptsbyQuiz($quizid);

        // $quizAttempt->each(function($attempt){
        //     echo $attempt->quizSummary;
            
        //     echo $attempt->student->quizAttempt->quizAnswer;
        //     foreach($attempt->student->quizAttempt->quizAnswer as $answer){
        //         echo $answer->questions;
        //     }
        // });
        
            
            foreach($selectedQuiz->question as $question){
                foreach($question->option as $option){
                    if($question->type == 2){
                        $correctAnswers = explode(', ', $option->option);
                    }
                }
            }
        
            foreach($selectedQuiz->question as $question){
                $answer = $question->getAnswerByQuestionStudent($question->question_id, 3);
                if($answer->isCorrect == 1 ){
                    $totalScore+=$question->points;
                }
                foreach($question->option as $option){
                    if($answer->option_id ==  $option->option_id){
                        
                        if($answer->isCorrect !=  $option->isCorrect){
                            $updateAnswer = QuizAnswer::where('quiz_answer_id', $answer->quiz_answer_id)->get()->first();
                            $updateAnswer->update([
                                'isCorrect' => $option->isCorrect
                            ]);

                            $updateScore = QuizSummary::where('attempt_id', 30)->get()->first();
                            $updateScore->update([
                                'total_score' => $option->$totalScore,
                            ]);
                            echo 'Wrong answer';
                        }
                        else if ($answer->isCorrect ==  $option->isCorrect){
                            echo 'Correct answer';
                        }
                        
                        
                        // QuizAnswer::create([
                        //     'attempt_id' => $attempt->attempt_id,
                        //     'student_id' => Auth::user()->student->student_id,
                        //     'question_id' => $question,
                        //     'option_id' => $option,
                        //     'isCorrect' => $isCorrect->isCorrect
                        // ]);
                    }
                    

                        // foreach($correctAnswers as $correctanswer){
                        //     if($option->answerbyQuestion->textAnswer === $correctanswer){
                        //         $totalScore+=$question->points;
                        //     }
                        // }
                }
                $totalPoints +=$question->points;
            }
        echo $totalScore .'/'. $totalPoints;
    }

    public function viewResult($courseid,$quizid){
        $chosenQuiz = Quiz::where('quiz_id', $quizid)->get()->first();
        $questions = $chosenQuiz->question;
        $correctAnswers =[];

        foreach($questions as $question){
            foreach($question->option as $option){
                if($question->type == 2){
                    $correctAnswers = explode(', ', $option->option);
                    // echo $spliceCorrectAnswer;
                }
            }
            
        }

        $quizAttempt = QuizAttempt::where('quiz_id', $quizid)->where('student_id', Auth::user()->student->student_id)->get();
        
        return view('student.quiz.viewResult')->with(compact(['chosenQuiz', 'questions', 'correctAnswers', 'quizAttempt']));
    }

}
