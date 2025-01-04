<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use HasFactory, SoftDeletes;

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
        'course_id',
        'major_id',
        'section_id',
        'student_status',
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
        return $this->belongsTo(Department::class,)->withTrashed();
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

    /**
     * Retrieves the section and program of the enrollment
     *
     * @return App\Models\Section
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    

    public function scopeStatus($query, $status = null)
    {
        if($status){
            return $query->whereHas('student', function ($query) use ($status) {
                $query->where('is_complete', $status === 'complete');
            });
        }
        return $query;
    }

    public function scopeByDepartment($query, $department_id)
    {
            return $query->whereHas('student', function ($query) use ($department_id) {
                $query->where('department_id', $department_id );
            });

    }

    public function scopeByDepartments($query, array $deptIds)
    {
        return $query->whereIn('department_id', $deptIds);
    }
}
