<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmissionText extends Model
{
    use HasFactory;
    protected $table = 'assignment_submission_text';
    protected $primaryKey = 'submission_text_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'submission_id',
        'text',
    ];
}
