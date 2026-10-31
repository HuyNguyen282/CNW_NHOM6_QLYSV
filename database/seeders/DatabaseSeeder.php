<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            FacultySeeder::class,
            MajorSeeder::class,
            ClassRoomSeeder::class,
            SubjectSeeder::class,
            StudentSeeder::class,
            UserSeeder::class,
            ScoreSeeder::class,
        ]);
    }
}
