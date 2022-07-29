<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBackground extends Model
{
    use HasFactory;

    protected $table = 'students_background';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'studentId',
        'last_level',
        'program_attended',
        'program_literacy',
        'program_attended_year',
    ];
}
