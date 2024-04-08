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

    public function major(){
        return $this->hasMany(Major::class, 'course_id');
    }

    public static function courses(){
        $getCourse = Course::get()->toArray();
        return $getCourse;
    }
}
