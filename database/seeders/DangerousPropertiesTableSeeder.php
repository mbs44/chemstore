<?php
// database/seeders/MeasureUnitsTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DangerousPropertiesTableSeeder extends Seeder
{
    public function run() : void
    {
        // Insert measure units into the measure_units table
        DB::table('dangerous_properties')->insert([
            ['name_sk' => 'Oheň', 'name_en' => 'Fire' ],
            ['name_sk' => 'Kyselina', 'name_en' => 'Acid' ],
            ['name_sk' => 'Zásada', 'name_en' => 'Alkaline' ],
            ['name_sk' => 'Výbušnina', 'name_en' => 'Explosive' ]
        ]);
    }
}
