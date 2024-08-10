<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'added_by',
        'log_ref_id',
        'type',
        'content',
        'added_by_ref_id',
        'student_ref_id',
        'added_by_employee_id',
        'student_id'
    ];
}
