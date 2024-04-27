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
     * List all Students with filters
     *
     * @param array $params
     */
    public function list(array $request)
    {
        try {
            $students = Student::query();
            $filteredStudents = $this->searchFilterList($request, $students);
            return $filteredStudents->paginate(config('app.pages'));
        } catch (Exception $e) {
            throw $e;
        }

        return $enrollment;
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

    public function searchFilterList($conditions, $query)
    {
        // if student_query is provided
        if (array_key_exists('student_query', $conditions) && checkSearchHasValue($conditions['student_query'])) {
            $query = $query->where(function ($innerQuery) use ($conditions) {
                $innerQuery->where('student_id', 'LIKE', "%{$conditions['student_query']}%")
                ->orWhere('first_name', 'LIKE', "%{$conditions['student_query']}%")
                ->orWhere('last_name', 'LIKE', "%{$conditions['student_query']}%")
                ->orWhere('middle_name', 'LIKE', "%{$conditions['student_query']}%");
            });
        }

        // if school_year is provided
        if (array_key_exists('school_year', $conditions) && checkSearchHasValue($conditions['school_year'])) {
            $query = $query->whereHas('enrollments', function ($innerQuery) use ($conditions) {
                $innerQuery->where('school_year_id',  intval($conditions['school_year']))->latest();
            });
        }

        // if semester is provided
        if (array_key_exists('semester', $conditions) && checkSearchHasValue($conditions['semester'])) {
            $query = $query->whereHas('enrollments', function ($innerQuery) use ($conditions) {
                $innerQuery->where('semester_id',  intval($conditions['semester']))->latest();
            });
        }

        // if department is provided
        if (array_key_exists('department', $conditions) && checkSearchHasValue($conditions['department'])) {
            $query = $query->whereHas('enrollments', function ($innerQuery) use ($conditions) {
                $innerQuery->where('department_id',  intval($conditions['department']))->latest();
            });
        }

        // if course is provided
        if (array_key_exists('course', $conditions) && checkSearchHasValue($conditions['course'])) {
            $query = $query->whereHas('enrollments', function ($innerQuery) use ($conditions) {
                $innerQuery->where('course_id',  intval($conditions['course']))->latest();
            });
        }

        // if major is provided
        if (array_key_exists('major', $conditions) && checkSearchHasValue($conditions['major'])) {
            $query = $query->whereHas('enrollments', function ($innerQuery) use ($conditions) {
                $innerQuery->where('major_id',  intval($conditions['major']))->latest();
            });
        }

        // if year_level is provided
        if (array_key_exists('year_level', $conditions) && checkSearchHasValue($conditions['year_level'])) {
            $query = $query->whereHas('enrollments', function ($innerQuery) use ($conditions) {
                $innerQuery->where('year_level',  intval($conditions['year_level']))->latest();
            });
        }
        
        // if section is provided
        if (array_key_exists('section', $conditions) && checkSearchHasValue($conditions['section'])) {
            $query = $query->whereHas('enrollments', function ($innerQuery) use ($conditions) {
                $innerQuery->where('section_id',  intval($conditions['section']))->last();
            });
        }
        return $query;
    }

}