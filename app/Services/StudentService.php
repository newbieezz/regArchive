<?php

namespace App\Services;

use DB;
use Hash;
use Exception;
use Carbon\Carbon;
use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class StudentService
{
    /**
     * @var App\Models\Student
     */
    protected $student;


    /**
     * StudentService constructor.
     *
     * @param App\Models\Student $student
     */
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Retrieves a student by student_id
     */
    public function findByStudentId(int $studentId): Student
    {
        // retrieve the student
        $student = $this->student->where('student_id', $studentId)->first();

        if (!($student instanceof Student)) {
            throw new ModelNotFoundException('Student with ID Number: '.$studentId.' not found!');
        }

        return $student;
    }
}