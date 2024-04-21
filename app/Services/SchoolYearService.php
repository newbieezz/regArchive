<?php

namespace App\Services;

use DB;
use Hash;
use Exception;
use Carbon\Carbon;
use App\Models\SchoolYear;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class SchoolYearService
{
    /**
     * @var App\Models\SchoolYear
     */
    protected $schoolYear;

    /**
     * UserService constructor.
     *
     * @param App\Models\SchoolYear $SchoolYear
     */
    public function __construct(SchoolYear $schoolYear)
    {
        $this->schoolYear = $schoolYear;
    }

        
    /**
     * List all schoolYear from database
     *
     */
    public function listAll()
    {
        try {
            $schoolYears =  $this->schoolYear->orderBy('year', 'DESC')->get();

        } catch (Exception $e) {
            throw $e;
        }

        return $schoolYears;
    }


    /**
     * Creates a new schoolYear in the database
     *
     * @param array $params
     */
    public function create(array $params): SchoolYear
    {
        try {
            $schoolYear = $this->schoolYear->create($params);

        } catch (Exception $e) {
            throw $e;
        }

        return $schoolYear;
    }

    /**
     * Updates schoolYear in the database
     */
    public function update(array $params): SchoolYear
    {
        // retrieve schoolYear information
        $schoolYear = $this->findById($params['id']);
        // perform update
        $schoolYear->update($params);

        return $schoolYear;
    }

    
    /**
     * Deletes the major in the database
     */
    public function delete(int $id): bool
    {
        // retrieve schoolYear
        $schoolYear = $this->findById($id);

        // perform delete
        $schoolYear->delete();

        return true;
    }


    /**
     * Retrieves a schoolYear by id
     */
    public function findById(int $id): SchoolYear
    {
        // retrieve the schoolYear
        $schoolYear = $this->schoolYear->find($id);

        if (!($schoolYear instanceof SchoolYear)) {
            throw new ModelNotFoundException('SchoolYear with ID: '.$id.' not found!');
        }

        return $schoolYear;
    }
}