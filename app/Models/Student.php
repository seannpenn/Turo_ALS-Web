<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $primaryKey = 'studentId';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'LRN',
        'student_fname',
        'student_mname',
        'student_lname',
        'student_gender',
        'student_civil',
        'student_birth',
    ];

}
