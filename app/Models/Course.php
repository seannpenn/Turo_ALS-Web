<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseContent;
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

    public function coursecontent(){
        return $this->hasMany(CourseContent::class, 'course_id', 'content_id');
    }

    public static function getAllCourses(){
        
        return self::get()->toArray();
    }
    // public function getCourseContents(){
    //     return $this->hasMany(CourseContent::class);
    // }

    public function scopeFilter(Builder $builder, $request)
    {
        return (new CourseFilter($request))->filter($builder);
    }
}
