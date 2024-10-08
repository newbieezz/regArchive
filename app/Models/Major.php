<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_id',
    ];

    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function scopeByCourse($query, int $courseId)
    {
        return $query->where('course_id', $courseId);
    }
}
