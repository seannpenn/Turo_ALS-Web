<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Topic;
class CourseContent extends Model
{
    use HasFactory;

    protected $table = 'coursecontent';
    protected $primaryKey = 'content_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'course_id',
        'content_title',
        'content_description',
    ];

    public function course(){
        return $this->belongsTo(Course::class, 'content_id', 'course_id');
    }

    public static function getAllModule(){
        return self::get()->toArray();
    }
    public function topic(){
        return $this->hasMany(Topic::class, 'content_id', 'content_id');
    }
}
