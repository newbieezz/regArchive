<?php

namespace App\Services;

use DB;
use Hash;
use Exception;
use Carbon\Carbon;
use App\Models\Course;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class CourseService
{
    /**
     * @var App\Models\Course
     */
    protected $course;

    /**
     * UserService constructor.
     *
     * @param App\Models\Course $user
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    /**
     * List all courses from database
     *
     */
    public function listAll()
    {
        try {
            $courses =  $this->course->orderBy('name', 'ASC')->get();
        } catch (Exception $e) {
            throw $e;
        }

        return $courses;
    }

    /**
     * Creates a new course in the database
     *
     * @param array $params
     */
    public function create(array $params): Course
    {
        try {
            $course = $this->course->create($params);

        } catch (Exception $e) {
            throw $e;
        }

        return $course;
    }

    /**
     * Updates course in the database
     */
    public function update(array $params): Course
    {
        // retrieve course information
        $course = $this->findById($params['id']);
        // perform update
        $course->update($params);

        return $course;
    }

    
    /**
     * Deletes the course in the database
     */
    public function delete(int $id): bool
    {
        // retrieve course
        $course = $this->findById($id);

        // perform delete
        $course->delete();

        return true;
    }


    /**
     * Retrieves a course by id
     */
    public function findById(int $id): Course
    {
        // retrieve the course
        $course = $this->course->find($id);

        if (!($course instanceof Course)) {
            throw new ModelNotFoundException('Course with ID: '.$id.' not found!');
        }

        return $course;
    }

    /**
     * Retrieves a courses by department
     */
    public function listByDepartment(int $departmentId)
    {
        // retrieve the course
        $courses = $this->course->where('department_id',  $departmentId)->get();

        return $courses;
    }
}