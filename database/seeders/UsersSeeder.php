<?php
// database/seeders/MeasureUnitsTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Insert measure units into the measure_units table
        DB::table('users')->insert([
//            [
//                'username' => 'student',
//                'email' => 'student@gjh.sk',
//                'is_student' => true,
//            ],
            [
                'username' => 'teacher',
                'email' => 'teacher@gjh.sk',
                'is_teacher' => true,
                'is_admin' => true,
                'is_student' => false,
            ],
            [
                'username' => 'oravec',
                'email' => 'oravec@gjh.sk',
                'is_teacher' => true,
                'is_admin' => true,
                'is_student' => false,
            ]
        ]);
    }
}
