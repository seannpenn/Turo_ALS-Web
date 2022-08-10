<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
class Enrollment extends Model
{
    use HasFactory;

    protected $table = 'enrollment';
    protected $primaryKey = 'studentId';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'prod_id',
        'status'
    ];

    public static function getAllEnrollees(){
        return self::get();
    }
    public function student(){
        return $this->belongsTo(Student::class, 'studentId', 'studentId');
    }
}
