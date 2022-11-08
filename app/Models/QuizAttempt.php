<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizSummary;
use App\Models\QuizAnswer;
use App\Models\Quiz;
use App\Models\Student;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $table = 'quiz_attempt';
    protected $primaryKey = 'attempt_id';
    // protected $keyType = '';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'quiz_id',
        'student_id',
    ];

    public static function getAll(){
        return self::get();
    }
    public function attemptsbyQuiz($quiz_id){
        return self::where('quiz_id',$quiz_id)->get();
    }

    public function quiz(){
        return $this->belongsTo(Quiz::class, 'quiz_id', 'quiz_id');
    }
    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
    public function quizSummary(){
        return $this->hasOne(QuizSummary::class, 'attempt_id', 'attempt_id');
    }
    public function quizAnswer(){
        return $this->hasMany(QuizAnswer::class, 'attempt_id', 'attempt_id');
    }
}
