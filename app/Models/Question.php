<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;
use App\Models\Option;
class Question extends Model
{
    use HasFactory;

    protected $table = 'question';
    protected $primaryKey = 'question_id';
    // protected $keyType = '';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'quiz_id',
        'type',
        'question',

    ];
    public function getAll($quizId){
        return self::where('quiz_id',$quizId)->get();
    }
    // This QUESTION/S belongs to a specific quiz.
    public function quiz(){
        return $this->belongsTo(Quiz::class, 'quiz_id', 'quiz_id');
    }
    public function option(){
        return $this->hasMany(Option::class, 'question_id', 'question_id');
    }
}
