<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizAttempt;

class QuizSummary extends Model
{
    use HasFactory;

    protected $table = 'quiz_summary';
    protected $primaryKey = 'quiz_summary_id';
    // protected $keyType = '';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'attempt_id',
        'total_score',
        'total_points',
    ];

    public function QuizAttempt(){
        return $this->belongsTo(QuizAttempt::class, 'attempt_id', 'attempt_id');
    }
}
