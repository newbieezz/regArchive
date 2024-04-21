<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'school_year_id',
        'year_level',
        'semester',
        'department_id',
        'program',
        'course_id',
        'major_id',
        'section',
        'student_status',
        'enrollment_status',
        'date_enrolled',
    ];

    /**
     * Retrieves the student of the enrollment
     *
     * @return App\Models\Student
     */
    public function student()
    {
        return $this->belongsTo(Student::class,  'student_id', 'student_id');
    }
    
    /**
     * Retrieves the schoolyear of the enrollment
     *
     * @return App\Models\SchoolYear
     */
    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    /**
     * Retrieves the department of the enrollment
     *
     * @return App\Models\Department
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Retrieves the course of the enrollment
     *
     * @return App\Models\Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    
    /**
     * Retrieves the major of the enrollment
     *
     * @return App\Models\Major
     */
    public function major()
    {
        return $this->belongsTo(Major::class);
    }
    
}
