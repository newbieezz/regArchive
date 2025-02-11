<?php

namespace App\Services;

use App\Models\Department;
use DB;
use Illuminate\Support\Facades\Hash;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class UserService
{
    /**
     * @var App\Models\User
     */
    protected $user;

    /**
     * UserService constructor.
     *
     * @param App\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Creates a new staff in the database
     *
     * @param array $params
     */
    public function createStaff(array $params): User
    {
        try {
            //dd($params);
            // Convert `B9891;B9892` to an array
            $departmentIds = explode(';', $params['department_id']);
            // Ensure they exist in the departments table
            $validDepartments = Department::whereIn('id', $departmentIds)->pluck('id')->toArray();
            $params['department_id'] = json_encode($validDepartments);
            $params['password'] = Hash::make($params['password']);
            $status = UserStatus::where('name', config('user.statuses.active'))->firstOrFail();
            $params['user_status_id'] = $status->id;
            $params['password_default'] = 1;
            $user = $this->user->create($params);

        } catch (Exception $e) {
            throw $e;
        }

        return $user;
    }

    /**
     * Updates staff in the database
     */
    public function updateStaff(array $params): User
    {
        // retrieve user information
        $user = $this->findById($params['id']);
        $params['department_id'] = $params['department_id'] ?? json_decode($user->department_id);

        if (array_key_exists('password', $params)) {
            $params['password_default'] = false;
            // update user password if provided in request or retain the current password
            $params['password'] = strlen($params['password']) > 0 ?
                Hash::make($params['password']) :
                $user->password;
        }

        if (is_string($params['department_id'])) {
            $departmentIds = explode(';', $params['department_id']);
        } else if (is_array($params['department_id'])) {
            $departmentIds = $params['department_id'];
        } else {
            $departmentIds = [];
        }

        $validDepartments = Department::whereIn('id', $departmentIds)->pluck('id')->toArray();
        $params['department_id'] = json_encode($validDepartments);

        //dd($params);


        // perform update
        $user->update($params);

        return $user;
    }

    /**
     * Updates user status
     */
    public function setStatus(int $id, string $status): User
    {
        // retrieve user information
        $user = $this->findById($id);
        $userStatus = UserStatus::where('name', $status)->firstOrFail();
        $user->user_status_id = $userStatus->id;
        $user->save();
        return $user;
    }

    // Set user/staff scope access
    // public function updateScope(array $params): User
    // {
    //     $user = $this->findById($params['id']);
    //     $user->update($params);
    //     return $user;
    // }

    /**
     * Retrieves a user by id
     */
    public function findById(int $id): User
    {
        // retrieve the user
        $user = $this->user->find($id);

        if (!($user instanceof User)) {
            throw new ModelNotFoundException('User with ID: '.$id.' not found!');
        }

        return $user;
    }

}