<?php

namespace Database\Seeders;


use Carbon\Carbon;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // retrieve user status
        $status = UserStatus::where('name', config('user.statuses.active'))->first();

        // create the system admin
        $this->_createSystemAdmin($status);

        // create the system staff
        $this->_createSystemStaff($status);
    }

    private function _createSystemAdmin($status): void
    {

        // create the system admin
        User::create([
            'first_name' => 'Registrar',
            'last_name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'user_status_id' => $status->id,
            'role' => config('user.roles.admin'),
            'email_verified_at' => Carbon::now(),
            'password_default' => false,
            'employee_id' => null,
        ]);
    }

    private function _createSystemStaff($status): void
    {
        // create the system admin
        User::create([
            'first_name' => 'Registrar',
            'last_name' => 'Staff',
            'email' => 'staff@staff.com',
            'password' => Hash::make('password'),
            'user_status_id' => $status->id,
            'role' => config('user.roles.staff'),
            'email_verified_at' => Carbon::now(),
            'password_default' => true,
            'employee_id' => null,
        ]);
    }
}
