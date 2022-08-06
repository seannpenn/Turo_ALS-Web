<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;
use App\Models\Question;
class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quiz';
    protected $primaryKey = 'quiz_id';
    // protected $keyType = '';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'topic_id',
        'quiz_title',
    ];

    public static function getAllQuiz(){
        
        return self::get();
    }
    public function topic(){
        return $this->belongsTo(Topic::class, 'topic_id', 'topic_id');
    }
    public function question(){
        return $this->hasMany(Question::class, 'quiz_id', 'quiz_id');
    }
}
