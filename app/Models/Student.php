<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'middle_name',
        'home_address',
        'city_address',
        'contact_no',
        'email',
        'gender',
        'birthdate',
        'birth_address',
        'citizenship',
        'religion',
        'civil_status',
        'fathers_name',
        'fathers_occupation',
        'mothers_name',
        'mothers_occupation',
        'guardians_name',
        'guardian_contact',
        'primary',
        'primary_sy',
        'primary_awards',
        'secondary',
        'secondary_sy',
        'secondary_awards',
        'senior_high',
        'senior_high_sy',
        'senior_high_awards',
    ];

    /**
     * Retrieve all enrollments under this student
     *
     * @return App\Models\Enrollment[]
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class,  'student_id', 'student_id');
    }

}
