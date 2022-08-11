<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
class StudentEducation extends Model
{
    use HasFactory;

    protected $table = 'student_education';
    protected $primaryKey = 'student_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'last_level',
        'student_reason',
        'answer_type',
        'program_attended',
        'program_literacy',
        'program_attended_year',
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
