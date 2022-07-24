<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $primaryKey = 'course_id';
    // protected $keyType = '';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'teacher_id',
        'course_title',
        'course_description',
    ];
}
