<?php

namespace App\Services;

use DB;
use Hash;
use Exception;
use Carbon\Carbon;
use App\Models\Department;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class DepartmentService
{
    /**
     * @var App\Models\Department
     */
    protected $department;

    /**
     * UserService constructor.
     *
     * @param App\Models\Department $user
     */
    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    /**
     * Creates a new department in the database
     *
     * @param array $params
     */
    public function create(array $params): Department
    {
        try {
            $department = $this->department->create($params);

        } catch (Exception $e) {
            throw $e;
        }

        return $department;
    }

    /**
     * Updates department in the database
     */
    public function update(array $params): Department
    {
        // retrieve department information
        $department = $this->findById($params['id']);
        // perform update
        $department->update($params);

        return $department;
    }

    
    /**
     * Deletes the department in the database
     */
    public function delete(int $id): bool
    {
        // retrieve department
        $department = $this->findById($id);

        // perform delete
        $department->delete();

        return true;
    }


    /**
     * Retrieves a department by id
     */
    public function findById(int $id): Department
    {
        // retrieve the user
        $department = $this->department->find($id);

        if (!($department instanceof Department)) {
            throw new ModelNotFoundException('Department with ID: '.$id.' not found!');
        }

        return $department;
    }
}