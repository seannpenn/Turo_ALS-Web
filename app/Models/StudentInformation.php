<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInformation extends Model
{
    use HasFactory;

    protected $table = 'student_information';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'LRN',
        'student_gender',
        'student_civil',
        'student_placeofbirth',
        'student_birth',
        'street',
        'barangay',
        'city',
        'province',
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
