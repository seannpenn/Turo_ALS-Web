<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TopicContent;
class TopicContent extends Model
{
    use HasFactory;

    protected $table = 'topic_content';
    protected $primaryKey = 'topic_content_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'topic_id',
        'topic_content_title',
        'type',
        'html',
        'file',
        'quiz_link'

    ];
    public function topic(){
        return $this->belongsTo(Topic::class, 'topic_id', 'topic_id');
    }
    public function quiz(){
        return $this->hasOne(Quiz::class, 'quiz_link', 'quiz_id');
    }
}
