<?php

namespace Database\Seeders;

use Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Database\Seeder;

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
        $this->_createSystemAdmin();

        // create the system staff
        $this->_createSystemStaff();
    }

    private function _createSystemAdmin(): void
    {
        // retrieve user status
        $status = UserStatus::where('name', config('user.statuses.active'))->first();
        
        // create the system admin
        User::create([
            'first_name' => 'Registrar',
            'last_name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'user_status_id' => $status->id,
            'role' => config('user.roles.admin'),
            'email_verified_at' => Carbon::now(),
        ]);
    }

    private function _createSystemStaff(): void
    {
        // retrieve user status
        $status = UserStatus::where('name', config('user.statuses.active'))->first();
        
        // create the system admin
        User::create([
            'first_name' => 'Registrar',
            'last_name' => 'Staff',
            'email' => 'staff@staff.com',
            'password' => Hash::make('password'),
            'user_status_id' => $status->id,
            'role' => config('user.roles.staff'),
            'email_verified_at' => Carbon::now(),
        ]);
    }
}
