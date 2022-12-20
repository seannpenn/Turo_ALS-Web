<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;
use App\Models\Question;
use App\Models\TopicContent;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\Auth;
class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quiz';
    protected $primaryKey = 'quiz_id';
    // protected $keyType = '';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'quiz_title',
        'course_id',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'attempts',
        'password',
        'status',
        'releaseGrades',
        'duration',
    ];

    public static function getAllQuizByTopic($topicId){
        return self::where('topic_id', $topicId)->get();
    }

    // return all quizzes created by specific teacher in order to manage it.
    public static function getAllQuiz(){
        return self::get();
    }

    // This quiz belongs to a specific topic.
    public function topic(){
        return $this->belongsTo(Topic::class, 'topic_id', 'topic_id');
    }
    // This specific quiz has many questions.
    public function question(){
        return $this->hasMany(Question::class, 'quiz_id', 'quiz_id');
    }

    public function link(){
        return $this->belongsTo(TopicContent::class, 'link', 'quiz_id');
    }
    
    public function quizAttempt(){
        return $this->hasMany(QuizAttempt::class, 'quiz_id', 'quiz_id')->where('student_id', Auth::user()->student->student_id);
    }
    public function attemptByStudent($studentId){
        return $this->hasMany(QuizAttempt::class, 'quiz_id', 'quiz_id')->where('student_id', $studentId)->get();;
    }
}
