<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'department_id',
        'user_status_id',
        'role',
        'email',
        'scope',
        'password',
        'password_default',
        'employee_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Retrieves the Status of the User
     *
     * @return App\Models\UserStatus
     */
    public function status()
    {
        return $this->belongsTo(UserStatus::class, 'user_status_id');
    }

    /**
     * Retrieves the Department of the User
     *
     * @return App\Models\Department
     */
    public function departments()
    {
        $departmentIds = json_decode($this->department_id, true) ?? [];  // Decode the JSON field into an array of department IDs

        return Department::whereIn('id', $departmentIds)->withTrashed()->get();  // Fetch all departments with matching IDs
    }

    public function scopeByDepartment($query, int $dept)
    {
        return $query->whereRaw('JSON_CONTAINS(department_id, ?)', [json_encode([$dept])])->withTrashed();
    }

}
