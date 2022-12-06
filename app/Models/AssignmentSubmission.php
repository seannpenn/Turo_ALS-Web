<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssignmentSubmissionFile;
use App\Models\AssignmentSubmissionText;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
class AssignmentSubmission extends Model
{
    use HasFactory;
    protected $table = 'assignment_submission';
    protected $primaryKey = 'submission_id';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'assignment_id',
        'student_id',
        'submission_type',
        'total_score',
    ];

    public function submission_file(){
        return $this->hasOne(AssignmentSubmissionFile::class, 'submission_id', 'submission_id');
    }

    public function submission_text(){
        return $this->hasOne(AssignmentSubmissionText::class, 'submission_id', 'submission_id');
    }
    public function assignment(){
        return $this->belongsTo(Assignment::class, 'assignment_id', 'assignment_id')->where('student_id', Auth::user()->student->student_id);
    }
    
}
