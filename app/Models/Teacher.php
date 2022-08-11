<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\LearningCenter;
class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';
    protected $primaryKey = 'teacher_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'prog_id',
        'loc_id',
        'teacher_fname',
        'teacher_mname',
        'teacher_lname',
        'teacher_birth',
    ];
    // A specific teacher has many course
    public function course(){
        return $this->hasMany(Course::class, 'teacher_id', 'teacher_id');
    }
    // A specific taecher is assigned to a specific location
    public function location(){
        return $this->hasOne(LearningCenter::class, 'loc_id', 'loc_id');
    }
}
