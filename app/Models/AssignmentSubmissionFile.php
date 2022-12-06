<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmissionFile extends Model
{
    use HasFactory;
    protected $table = 'assignment_submission_file';
    protected $primaryKey = 'submission_file_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'submission_id',
        'path',
    ];
}
