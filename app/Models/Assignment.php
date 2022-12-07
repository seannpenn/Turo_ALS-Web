<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Auth;
class Assignment extends Model
{
    use HasFactory;

    protected $table = 'assignment';
    protected $primaryKey = 'assignment_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'assignment_title',
        'assignment_description',
        'course_id',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'status',
        'points',
        'submission_type',
        'multiple_submissions'
    ];

    public static function getAllAssignment(){
        return self::get();
    }

    public function getAssignmentByCourse($course_id)
    {
        return self::where('course_id',$course_id)->get();
    }

    public function submissions(){
        return $this->hasMany(AssignmentSubmission::class, 'assignment_id', 'assignment_id')->where('student_id', Auth::user()->student->student_id);
    }
    public function submissionByStudent($studentId){
        return $this->hasMany(AssignmentSubmission::class, 'assignment_id', 'assignment_id')->where('student_id', $studentId)->get();
    }
}
