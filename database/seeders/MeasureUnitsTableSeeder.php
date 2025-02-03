<?php
// database/seeders/MeasureUnitsTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeasureUnitsTableSeeder extends Seeder
{
    public function run() : void
    {
        // Insert measure units into the measure_units table
        DB::table('measure_units')->insert([
            ['name' => 'gram', 'isoName' => 'g' ],
            ['name' => 'milliliter', 'isoName' => 'ml'],
        ]);
    }
}
