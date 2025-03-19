<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // UserCustom::factory(10)->create();

        $this->call(UsersSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(MeasureUnitsTableSeeder::class);
        $this->call(DangerousPropertiesTableSeeder::class);
        $this->call(SuppliesTableSeeder::class);
        $this->call(StateTableSeeder::class);
    }
}
