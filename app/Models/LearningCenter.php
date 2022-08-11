<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningCenter extends Model
{
    use HasFactory;

    protected $table = 'learning_center';
    protected $primaryKey = 'loc_id';
    
    public $timestamps = false;

    public static function getAll(){
        return self::all();
    }
}
