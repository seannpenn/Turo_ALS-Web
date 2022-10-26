<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Option;
use App\Models\QuizAttempt;

class QuizAnswer extends Model
{
    use HasFactory;

    protected $table = 'quiz_answers';
    protected $primaryKey = 'quiz_answer_id';
    // protected $keyType = '';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'attempt_id',
        'student_id',
        'question_id',
        'option_id',
        'isCorrect'
    ];

    public function option($optionId){
        return self::where('option_id',$optionId)->get();
    }
    public function quizAttempt(){
        return $this->belongsTo(QuizAttempt::class, 'attempt_id', 'attempt_id');
    }
    public function options(){
        return $this->belongsTo(Option::class, 'option_id', 'option_id'); 
    }
}
