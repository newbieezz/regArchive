<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Hash;
use Exception;
use Carbon\Carbon;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

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
}