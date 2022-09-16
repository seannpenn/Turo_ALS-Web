<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'announcement';
    protected $primaryKey = 'announcement_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'date',
        'announcement_title',
        'announcement_description',
    ];

    public static function getAllAnnouncements(){
        return self::get();
    }
}
