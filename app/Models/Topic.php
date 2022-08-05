<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
