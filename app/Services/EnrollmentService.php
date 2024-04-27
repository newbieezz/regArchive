<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Hash;
use Exception;
use Carbon\Carbon;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;  
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentImportClass;

class EnrollmentService
{
    /**
     * @var App\Models\Enrollment
     */
    protected $enrollment;


    /**
     * EnrollmentService constructor.
     *
     * @param App\Models\Enrollment $enrollment
     */
    public function __construct(Enrollment $enrollment)
    {
        $this->enrollment = $enrollment;
    }

    /**
     * List all Enrollments with filters
     *
     * @param array $params
     */
    public function list(array $request)
    {
        try {
            $enrollments = Enrollment::query();
            $filteredEnrollments = $this->searchFilterList($request, $enrollments);
            return $filteredEnrollments->paginate(config('app.pages'));
        } catch (Exception $e) {
            throw $e;
        }

        return $enrollment;
    }

    /**
     * Creates a new Enrollment in the database
     *
     * @param array $params
     */
    public function create(array $params): Enrollment
    {

        DB::beginTransaction();
        try {
            //Add student record
            $student = Student::updateOrCreate(['student_id' =>  $params['student_id']], $params);

            // Create the enrollment
            $params['date_enrolled'] = Carbon::now();
            $params['student_id'] = $student->student_id;
            $enrollment = $this->enrollment->create($params);
            
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }

        return $enrollment;
    }

    /**
     * Updates enrollment in the database
     */
    public function update(array $params): Enrollment
    {
        // retrieve schoolYear information
        $enrollment = $this->findById($params['id']);
        // perform update
        $enrollment->update($params);

        //perform update to related student
        $enrollment->student->update($params);

        return $enrollment;
    }

    /**
     * Retrieves a Enrollment by id
     */
    public function findById(int $id): Enrollment
    {
        // retrieve the enrollment
        $enrollment = $this->enrollment->find($id);

        if (!($enrollment instanceof Enrollment)) {
            throw new ModelNotFoundException('Enrollment with ID: '.$id.' not found!');
        }

        return $enrollment;
    }

    public function searchFilterList($conditions, $query)
    {
        // if student_query is provided
        if (array_key_exists('student_query', $conditions) && checkSearchHasValue($conditions['student_query'])) {
            $query = $query->where(function ($innerQuery) use ($conditions) {
                $innerQuery->whereHas('student', function ($query) use ($conditions) {
                    $query->where('student_id', 'LIKE', "%{$conditions['student_query']}%")
                        ->orWhere('first_name', 'LIKE', "%{$conditions['student_query']}%")
                        ->orWhere('last_name', 'LIKE', "%{$conditions['student_query']}%")
                        ->orWhere('middle_name', 'LIKE', "%{$conditions['student_query']}%");
                });
            });
        }

        // if school_year is provided
        if (array_key_exists('school_year', $conditions) && checkSearchHasValue($conditions['school_year'])) {
            $query = $query->where('school_year_id', intval($conditions['school_year']));
        }

        // if semester is provided
        if (array_key_exists('semester', $conditions) && checkSearchHasValue($conditions['semester'])) {
            $query = $query->where('semester', intval($conditions['semester']));
        }

        // if department is provided
        if (array_key_exists('department', $conditions) && checkSearchHasValue($conditions['department'])) {
            $query = $query->where('department_id', intval($conditions['department']));
        }

        // if course is provided
        if (array_key_exists('course', $conditions) && checkSearchHasValue($conditions['course'])) {
            $query = $query->where('course_id', intval($conditions['course']));
        }

        // if major is provided
        if (array_key_exists('major', $conditions) && checkSearchHasValue($conditions['major'])) {
            $query = $query->where('major_id', intval($conditions['major']));
        }

        // if year_level is provided
        if (array_key_exists('year_level', $conditions) && checkSearchHasValue($conditions['year_level'])) {
            $query = $query->where('year_level', intval($conditions['year_level']));
        }
        
        // if section is provided
        if (array_key_exists('section', $conditions) && checkSearchHasValue($conditions['section'])) {
            $query = $query->where('section_id', intval($conditions['section']));
        }
        return $query;
    }

    public function uploadStudents(array $params){
        $file = $params['file'];
        $params['date_enrolled'] = Carbon::now();
        $enrollmentData = array_diff_key($params, array_flip(['file', '_token']));

        // Initialize an instance of StudentImportClass
        $import = new StudentImportClass();
        Excel::import($import, $file);
        $formattedData = $import->getFormattedData();

        DB::beginTransaction();
        try {
            foreach ($formattedData as $item) {
                $filteredItem = array_filter($item);
                //Add student record
                $student = Student::updateOrCreate(['student_id' =>  $filteredItem['student_id']], $filteredItem);

                // Create the enrollment
                $enrollmentData['student_id'] = $student->student_id;
                $enrollment = $this->enrollment->updateOrCreate([
                    'student_id' =>  $enrollmentData['student_id'],
                    'school_year_id' =>  $enrollmentData['school_year_id'],
                    'year_level' =>  $enrollmentData['year_level'],
                    'semester' =>  $enrollmentData['semester'],
                    'department_id' =>  $enrollmentData['department_id'],
                    'course_id' =>  $enrollmentData['course_id']
                ], $enrollmentData);
                
                DB::commit();
            }
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
 
        return true;
    }

}
