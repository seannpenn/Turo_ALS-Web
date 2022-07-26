<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
class StudentFamily extends Model
{
    use HasFactory;

    protected $table = 'student_family';
    protected $primaryKey = 'student_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'student_compfname',
        'student_compmname',
        'student_complname',
        'student_motherfname',
        'student_mothermname',
        'student_motherlname'
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
