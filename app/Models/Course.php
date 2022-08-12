<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseContent;
use App\Models\Teacher;
use App\Models\Programs;
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

    public static function getAllCourses(){
        return self::get()->toArray();
    }
    
    public function filter($prog_id)
    {
        return self::where('prog_id',$prog_id)->get();
    }
    
    // This COURSE/S belongs to a specific teacher.
    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id', 'teacher_id');
    }

    // This COURSE has many coursecontent/modules.
    public function coursecontent(){
        return $this->hasMany(CourseContent::class, 'course_id', 'course_id');
    }
    

}
