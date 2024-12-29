<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Hash;
use Exception;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\Department;
use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;
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
    public function list(array $request, $status = null)
    {
        try {
            $authUser = getLoggedInUser();
            if($authUser->role === config('user.roles.staff') && $authUser->scope === 2){
                $students = Student::query()->byDepartment($authUser->department_id)->status($status);
            } else{
                $students = Student::query()->status($status);
            }
            $filteredStudents = $this->searchFilterList($request, $students);
            return $filteredStudents->paginate(config('app.pages'));
        } catch (Exception $e) {
            throw $e;
        }

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

    public function getReports(){
        try {
            $studentCount = Student::count(); // Count all students
            $departments = Department::withCount('students')->get();
            
            $highSchoolReport = Student::select('secondary AS school_name', DB::raw('count(*) as students_count'))
            ->groupBy('school_name')
            ->having('school_name', '!=', '')
            ->get();
            
            $seniorHighReport = Student::select('senior_high AS school_name', DB::raw('count(*) as students_count'))
            ->groupBy('school_name')
            ->having('school_name', '!=', '')
            ->get();

            $reports = [
                "studentReport" => [
                    "studentCount" => $studentCount,
                    "departments" => $departments,
                ],
                "schoolReports" => [
                    "highSchool" => $highSchoolReport,
                    "seniorHigh" => $seniorHighReport,
                ],
            ];
            return $reports;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function departmentStudentReport(){
        try {
            // Count all students
            $studentCount = Student::count();

            // Get departments with the count of students in each
            $departments = Department::select('code')->withCount('students')->get();

            // Calculate the percentage of students in each department
            $departments = $departments->map(function ($department) use ($studentCount) {
                $department->student_percentage = ($studentCount > 0) ? ($department->students_count / $studentCount) * 100 : 0;
                return $department;
            });

            return [
                "total" => $studentCount,
                "departments" => $departments,
            ];

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function enrollmentReport(Request $request){
        try {
            $sy = $request->input('schoolYear', null);
            $enrollment = Enrollment::query();
            if($sy){
                $enrollment->where('school_year_id', $sy);
            }

            $totalEnrollees = $enrollment->count();

            $totalSemesterEnrollees =  $enrollment->select('semester', DB::raw('count(*) as total'))
            ->groupBy('semester')
            ->having('semester', '!=', '')
            ->get();

            $departmentEnrolles = Department::withCount('enrollments');
            if($sy){
                $departmentEnrolles = $departmentEnrolles->whereHas('enrollments', function ($innerQuery) use ($sy) {
                    $innerQuery->where('school_year_id', $sy);
                });
            }
            
            $departmentEnrolles = $departmentEnrolles->get();



            $departmentEnrolles = $departmentEnrolles->map(function ($deptEnrollee) {
                // Retrieve courses along with the count of students for each department
                $courses = Course::select('code')->where('department_id', $deptEnrollee->id)
                                ->withCount('enrollments')
                                ->get();

                // Attach the courses information to the current item
                $deptEnrollee->courses = $courses;

                return $deptEnrollee;
            });

            $reports = [
                "totalEnrollees" => $totalEnrollees,
                "totalSemesterEnrollees" => $totalSemesterEnrollees,
                "departmentEnrolles" => $departmentEnrolles
            ];

            return $reports;
            
        } catch (Exception $e) {
            throw $e;
        }
    }


    public function documentReport(Request $request){
        try {
            $department = $request->input('department', null);
            $courses = Course::query();
            if($department){
                $courses->where('department_id', $department);
            }

            $allCourse = $courses->get();

            $complete = $allCourse->map(function ($course) {
                // Count students who have completed in the course
                $course->total = Student::where('is_complete', true)->whereHas('enrollments', function ($innerQuery) use ($course) {
                    $innerQuery->where('course_id', $course->id)
                       ->where('department_id', $course->department_id);
                })->count();
                
                return $course;
            });

            $incomplete = $allCourse->map(function ($course) {
                // Count students who have not completed in the course
                $course->total = Student::where('is_complete', false)->whereHas('enrollments', function ($innerQuery) use ($course) {
                    $innerQuery->where('course_id', $course->id)
                       ->where('department_id', $course->department_id);
                })->count();
            
                return $course;
            });

            return $reports = [
                'complete' => $complete,
                'incomplete' => $incomplete,
            ];
            
        } catch (Exception $e) {
            throw $e;
        }
    }

    // public function documentReport(Request $request){
    //     try {
    //         $department = $request->input('department', null);
    //         $courses = Course::query();
    //         if($department){
    //             $courses->where('department_id', $department);
    //         }
    
    //         $allCourse = $courses->get();
    
    //         $complete = $allCourse->map(function ($course) {
    //             // Count students who have completed in the course
    //             $course->completed_count = Student::where('is_complete', true)->whereHas('enrollments', function ($innerQuery) use ($course) {
    //                 $innerQuery->where('course_id', $course->id)
    //                    ->where('department_id', $course->department_id);
    //             })->count();
                
    //             return $course;
    //         });
    
    //         $incomplete = $allCourse->map(function ($course) {
    //             // Count students who have not completed in the course
    //             $course->incomplete_count = Student::where('is_complete', false)->whereHas('enrollments', function ($innerQuery) use ($course) {
    //                 $innerQuery->where('course_id', $course->id)
    //                    ->where('department_id', $course->department_id);
    //             })->count();
            
    //             return $course;
    //         });
    
    //         return $reports = [
    //             'complete' => $complete,
    //             'incomplete' => $incomplete,
    //         ];
            
    //     } catch (Exception $e) {
    //         throw $e;
    //     }
    // }
}