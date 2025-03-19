<?php
// database/seeders/MeasureUnitsTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliesTableSeeder extends Seeder
{
    public function run() : void
    {
        // Insert measure units into the measure_units table
        DB::table('supplies')->insert([
            ['name_sk' => 'Dostatočné', 'name_en' => 'High' ],
            ['name_sk' => 'Nízke', 'name_en' => 'Low' ],
            ['name_sk' => 'Prázdne', 'name_en' => 'Empty' ]
        ]);
    }
}
