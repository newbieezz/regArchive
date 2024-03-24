<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRecords = [
            ['id' => 1,'name'=>'Veloso','type'=>'superadmin',
                'email'=>'admin@admin.com','password'=>'$2a$12$IEVhzwmNT5N6VRqxWuS5wuS2wCeSoRu37mpfIpV9/VGR5teCVvBCW'],
        ];
        Admin::insert($adminRecords);
    }
}
