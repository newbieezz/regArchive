<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'code',
        'name',
    ];

    public function students()
    {
        return $this->hasManyThrough(Student::class, Enrollment::class, 'department_id', 'student_id', 'id', 'student_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
