<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';
    protected $primaryKey = 'teacherId';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'teacher_fname',
        'teacher_mname',
        'teacher_lname',
        'teacher_birth',
    ];
}
