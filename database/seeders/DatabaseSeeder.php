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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Student User',
            'email' => 'student@gjh.sk',
        ]);
        User::factory()->create([
            'name' => 'Teacher User',
            'email' => 'teacher@gjh.sk',
        ]);
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gjh.sk',
        ]);

        $this->call(MeasureUnitsTableSeeder::class);
        $this->call(DangerousPropertiesTableSeeder::class);
        $this->call(StateTableSeeder::class);
    }
}
