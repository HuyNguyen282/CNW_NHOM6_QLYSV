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
            UserSeeder::class,      
            StudentSeeder::class,   
            ScoreSeeder::class,      
        ]);
    }
}