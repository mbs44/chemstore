<?php
// database/seeders/MeasureUnitsTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateTableSeeder extends Seeder
{
    public function run() : void
    {
        // Insert measure units into the measure_units table
        DB::table('states')->insert([
            ['name_sk' => 'Zadaná', 'name_en' => 'Initial' ],
            ['name_sk' => 'Zrušená', 'name_en' => 'Cancelled' ],
            ['name_sk' => 'Potvrdená', 'name_en' => 'Approved' ],
            ['name_sk' => 'Vydaná', 'name_en' => 'Processed' ]
        ]);
    }
}
