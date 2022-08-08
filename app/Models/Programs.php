<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    use HasFactory;

    protected $table = 'programs';
    protected $primaryKey = 'prog_id';
    
    public $timestamps = false;

    public static function getAll(){
        return self::all();
    }
}
