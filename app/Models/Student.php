<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Programs;
use App\Models\StudentEducation;
use App\Models\Enrollment;
use App\Models\StudentFamily;
class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $primaryKey = 'studentId';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'studentId',
        'user_id',
        'LRN',
        'student_fname',
        'student_mname',
        'student_lname',
        'student_gender',
        'student_civil',
        'student_placeofbirth',
        'student_birth',
        'street',
        'barangay',
        'city',
        'province',
        'status',
    ];
    public static function getAllStudents(){
        return self::get();
    }
    public function getPrograms(){
        return Programs::all();
    }
    public function education(){
        return $this->hasOne(StudentEducation::class, 'studentId', 'studentId');
    }
    public function family(){
        return $this->hasOne(StudentFamily::class, 'studentId', 'studentId');
    }
    public function enrollment(){
        return $this->hasOne(Enrollment::class, 'studentId', 'studentId');
    }
}
