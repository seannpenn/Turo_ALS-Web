<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseContent;
use App\Models\TopicContent;
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

    ];

    public static function getAllTopic(){
        return self::get()->toArray();
    }

    // These topic/s belongs to a specific coursecontent/module
    public function coursecontent(){
        return $this->belongsTo(CourseContent::class, 'content_id', 'content_id');
    }

    public function selectedquiz(){
        return $this->hasOne(Quiz::class, 'topic_id', 'topic_id');
    }
    public function topiccontent(){
        return $this->hasMany(TopicContent::class, 'topic_id', 'topic_id');
    }
}
