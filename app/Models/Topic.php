<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseContent;
use App\Models\Quiz;
class Topic extends Model
{
    use HasFactory;
    protected $table = 'topics';
    protected $primaryKey = 'topic_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'content_id',
        'topic_title',
        'topic_description',
        'topic_type',
        'text_content',
        'file_name'
    ];

    public static function getAllTopic(){
        return self::get()->toArray();
    }

    public function coursecontent(){
        return $this->belongsTo(CourseContent::class, 'content_id', 'content_id');
    }
    public function selectedquiz(){
        return $this->hasOne(Quiz::class, 'topic_id', 'topic_id');
    }
}
