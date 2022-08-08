<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
class StudentEducation extends Model
{
    use HasFactory;

    protected $table = 'student_education';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'studentId',
        'last_level',
        'student_reason',
        'answer_type',
        'program_attended',
        'program_literacy',
        'program_attended_year',
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'studentId', 'studentId');
    }
}
