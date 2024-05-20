<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'department_id',
    ];

    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function majors(){
        return $this->hasMany(Major::class, 'course_id');
    }

    public function scopeByDepartment($query, int $dept)
    {
        return $query->where('department_id', $dept);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->hasManyThrough(Student::class, Enrollment::class, 'department_id', 'student_id', 'id', 'student_id');
    }
    
}
