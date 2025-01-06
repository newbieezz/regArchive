<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnrollmentLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'school_year_id',
        'department_id',
        'course_id',
        'major_id',
        'section_id',
        'student_status',
        'graduate_studies',
        'required_document',
        'added_by',
        'deleted_by'
    ];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by')->withTrashed();
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by')->withTrashed();
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, )->withTrashed();
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

}
