<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
class Option extends Model
{
    use HasFactory;

    protected $table = 'option';
    protected $primaryKey = 'option_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'question_id',
        'option',
        'isCorrect',

    ];
    public static function getAllOption($questionId){
        return self::get()->where('question_id', $questionId);
    }
    public function question(){
        return $this->belongsTo(Question::class, 'question_id', 'question_id');
    }

}
