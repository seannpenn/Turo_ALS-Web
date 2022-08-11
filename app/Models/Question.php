<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;
class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'question_id';
    // protected $keyType = '';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'quiz_id',
        'question',
        'choice_a',
        'choice_b',
        'choice_c',
        'choice_d',
        'answer',
    ];
    // This QUESTION/S belongs to a specific quiz.
    public function quiz(){
        return $this->belongsTo(Quiz::class, 'quiz_id', 'quiz_id');
    }
}
