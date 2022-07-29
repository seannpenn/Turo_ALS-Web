<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInformation extends Model
{
    use HasFactory;

    protected $table = 'students_information';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'studentId',
        'street',
        'barangay',
        'city',
        'province',
        'student_motherfname',
        'student_mothermname',
        'student_motherlname'
    ];
}
