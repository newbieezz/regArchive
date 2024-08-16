<?php

namespace App\Services;

use DB;
use Hash;
use Exception;
use Carbon\Carbon;
use App\Models\StudentType;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class StudentTypeService
{
    /**
     * @var App\Models\StudentType
     */
    protected $studentType;

    /**
     * UserService constructor.
     *
     * @param App\Models\StudentType $StudentType
     */
    public function __construct(StudentType $studentType)
    {
        $this->studentType = $studentType;
    }

        
    /**
     * List all student$studentType from database
     *
     */
    public function listAll()
    {
        try {
            $studentTypes =  $this->studentType->orderBy('letter_tag')->get();

        } catch (Exception $e) {
            throw $e;
        }

        return $studentTypes;
    }


    /**
     * Creates a new studentType in the database
     *
     * @param array $params
     */
    public function create(array $params): StudentType
    {
        try {
            $studentType = $this->studentType->create($params);

        } catch (Exception $e) {
            throw $e;
        }

        return $studentType;
    }

    /**
     * Updates studentType in the database
     */
    public function update(array $params): StudentType
    {
        // retrieve studentType information
        $studentType = $this->findById($params['id']);
        // perform update
        $studentType->update($params);

        return $studentType;
    }

    
    /**
     * Deletes the major in the database
     */
    public function delete(int $id): bool
    {
        // retrieve studentType
        $studentType = $this->findById($id);

        // perform delete
        $studentType->delete();

        return true;
    }


    /**
     * Retrieves a studentType by id
     */
    public function findById(int $id): StudentType
    {
        // retrieve the studentType
        $studentType = $this->studentType->find($id);

        if (!($studentType instanceof StudentType)) {
            throw new ModelNotFoundException('student Type with ID: '.$id.' not found!');
        }

        return $studentType;
    }
}