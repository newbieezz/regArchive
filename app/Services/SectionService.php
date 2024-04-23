<?php

namespace App\Services;

use DB;
use Hash;
use Exception;
use Carbon\Carbon;
use App\Models\Section;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class SectionService
{
    /**
     * @var App\Models\Section
     */
    protected $section;

    /**
     * UserService constructor.
     *
     * @param App\Models\Section $Section
     */
    public function __construct(Section $section)
    {
        $this->section = $section;
    }

        
    /**
     * List all section from database
     *
     */
    public function listAll()
    {
        try {
            $sections =  $this->section->orderBy('sched')->get();

        } catch (Exception $e) {
            throw $e;
        }

        return $sections;
    }


    /**
     * Creates a new section in the database
     *
     * @param array $params
     */
    public function create(array $params): Section
    {
        try {
            $section = $this->section->create($params);

        } catch (Exception $e) {
            throw $e;
        }

        return $section;
    }

    /**
     * Updates section in the database
     */
    public function update(array $params): Section
    {
        // retrieve section information
        $section = $this->findById($params['id']);
        // perform update
        $section->update($params);

        return $section;
    }

    
    /**
     * Deletes the major in the database
     */
    public function delete(int $id): bool
    {
        // retrieve section
        $section = $this->findById($id);

        // perform delete
        $section->delete();

        return true;
    }


    /**
     * Retrieves a section by id
     */
    public function findById(int $id): Section
    {
        // retrieve the section
        $section = $this->section->find($id);

        if (!($section instanceof Section)) {
            throw new ModelNotFoundException('Section with ID: '.$id.' not found!');
        }

        return $section;
    }
}