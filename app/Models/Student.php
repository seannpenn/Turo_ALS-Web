<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Programs;
use App\Models\LearningCenter;
use App\Models\StudentEducation;
use App\Models\StudentInformation;
use App\Models\Enrollment;
use App\Models\QuizSummary;
use App\Models\QuizAnswer;
use App\Models\StudentFamily;
class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $primaryKey = 'student_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'loc_id',
        'student_fname',
        'student_mname',
        'student_lname',
    ];
    public static function getAllStudents(){
        return self::get();
    }
    public function getPrograms(){
        return Programs::all();
    }
    // Access with the education background of the student
    public function education(){
        return $this->hasOne(StudentEducation::class, 'student_id', 'student_id');
    }
    // Access with the family background of the student
    public function family(){
        return $this->hasOne(StudentFamily::class, 'student_id', 'student_id');
    }
    // Access with student's information
    public function information(){
        return $this->hasOne(StudentInformation::class, 'student_id', 'student_id');
    }
    
    public function enrollment(){
        return $this->hasOne(Enrollment::class, 'student_id', 'student_id');
    }
    public function quizAttempt(){
        return $this->hasMany(QuizAttempt::class, 'student_id', 'student_id');
    }
    public function quizAttemptByStudentByQuiz($studentid, $quizid){
        return QuizAttempt::where('student_id',$studentid)->where('quiz_id',$quizid)->get();
    }

    public function assignmenSubmissionByStudent($studentid, $quizid){
        
    }
}
