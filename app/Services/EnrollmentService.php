<?php

namespace App\Services;

use App\Models\EnrollmentLog;
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
    public function list(array $request, $status=null)
    {
        try {
            $authUser = getLoggedInUser();
            if ($authUser->scope === 2) {
                // Decode the department_id if it's a JSON string
                $departmentIds = json_decode($authUser->department_id, true);

                // Ensure $departmentIds is always an array
                if (!is_array($departmentIds)) {
                    $departmentIds = [$authUser->department_id];
                }
                

                // Query enrollments based on the decoded department IDs
                $enrollments = Enrollment::query()->byDepartments($departmentIds)->status($status);

            } else{
                $enrollments = Enrollment::query()->status($status);
            }
            $filteredEnrollments = $this->searchFilterList($request, $enrollments);
            $filteredEnrollments = $filteredEnrollments->orderBy('id', 'desc');
            return $filteredEnrollments->paginate(config('app.pages'));
        } catch (Exception $e) {
            throw $e;
        }

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
            $params['year_level'] = $params['year_level'] ?? 0;
            $params['semester'] = $params['semester'] ?? 0;
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
        $student_data = $enrollment->student()->first();


        //comparing prev data
        // Fields to compare for $enrollment
        $enrollmentFields = [
            'school_year_id',
            'year_level',
            'semester',
            'department_id',
            'program',
            'course_id',
            'major_id',
            'section_id',
            'student_status',
            'graduate_studies',
        ];

        // Fields to compare for $student_data
        $studentFields = [
            'required_document',
        ];

        // Compare $params with $enrollment
        $enrollmentChanges = [];
        foreach ($enrollmentFields as $field) {
            if (($params[$field] ?? null) != $enrollment->$field) {
                $enrollmentChanges[$field] = [
                    'old' => $enrollment->$field,
                    'new' => $params[$field] ?? null,
                ];
            }
        }

        // Compare $params with $student_data
        $studentChanges = [];
        foreach ($studentFields as $field) {
            if (($params[$field] ?? null) != $student_data->$field) {
                $studentChanges[$field] = [
                    'old' => $student_data->$field,
                    'new' => $params[$field] ?? null,
                ];
            }
        }


        // Check if there are any changes and log the change
        if (!empty($enrollmentChanges) || !empty($studentChanges)) {
            EnrollmentLog::create([
                'added_by' => auth()->id(), // Current logged-in user
                'student_id' => $enrollment->student_id,
                'school_year_id' => $enrollment->school_year_id,
                'department_id' => $enrollment->department_id,
                'course_id' => $enrollment->course_id,
                'major_id' => $enrollment->major_id,
                'section_id' => $enrollment->section_id,
                'student_status' => $enrollment->student_status,
                'graduate_studies' => $enrollment->graduate_studies,
                'required_document' => $student_data->required_document,
            ]);
        }



        // perform update
        $enrollment->update($params);

        //perform update to related student
        $enrollment->student->update($params);
        $enrollment->student->updateDocumentStatus();

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
                    // 'year_level' =>  $enrollmentData['year_level'],
                    // 'semester' =>  $enrollmentData['semester'],
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

    public function refreshEnrollmentStatus(): void
    {
        $allEnrollments = $this->enrollment->with('student')->get();

        foreach ($allEnrollments as $studentEnrollment) {
            $studentEnrollment->student->updateDocumentStatus();
        }
    }

}
