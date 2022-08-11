<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Programs;
class Enrollment extends Model
{
    use HasFactory;

    protected $table = 'enrollment';
    protected $primaryKey = 'student_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'prog_id',
        'status'
    ];

    public static function getEnrolleesByLocProg($locId, $progId){
        $byLocation = self::where('loc_id', $locId);
        return $byLocation->where('prog_id', $progId)->get();
    }
    public static function getAllEnrollees(){
        return self::get();
    }
    // This enrollment belongs to a student.
    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
    // Each enrollment has a program on what the student is enrolling for.
    public function program(){
        return $this->hasOne(Programs::class, 'prog_id', 'prog_id');
    }
}
