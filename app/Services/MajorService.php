<?php

namespace App\Services;

use DB;
use Hash;
use Exception;
use Carbon\Carbon;
use App\Models\Major;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class MajorService
{
    /**
     * @var App\Models\Major
     */
    protected $major;

    /**
     * UserService constructor.
     *
     * @param App\Models\Major $user
     */
    public function __construct(Major $major)
    {
        $this->major = $major;
    }

    /**
     * Creates a new major in the database
     *
     * @param array $params
     */
    public function create(array $params): Major
    {
        try {
            $major = $this->major->create($params);

        } catch (Exception $e) {
            throw $e;
        }

        return $major;
    }

    /**
     * Updates major in the database
     */
    public function update(array $params): Major
    {
        // retrieve major information
        $major = $this->findById($params['id']);
        // perform update
        $major->update($params);

        return $major;
    }

    
    /**
     * Deletes the major in the database
     */
    public function delete(int $id): bool
    {
        // retrieve major
        $major = $this->findById($id);

        // perform delete
        $major->delete();

        return true;
    }


    /**
     * Retrieves a major by id
     */
    public function findById(int $id): Major
    {
        // retrieve the major
        $major = $this->major->find($id);

        if (!($major instanceof Major)) {
            throw new ModelNotFoundException('Major with ID: '.$id.' not found!');
        }

        return $major;
    }
}