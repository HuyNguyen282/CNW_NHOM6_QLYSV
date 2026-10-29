<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Score;
use Faker\Factory as Faker;

class ScoreSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

      
        for ($studentId = 1; $studentId <= 100; $studentId++) {
            
            
            for ($subjectId = 1; $subjectId <= 11; $subjectId++) {
                Score::create([
                    'student_id' => $studentId,
                    'subject_id' => $subjectId,
                    'score' => $faker->randomFloat(2, 4, 10), 
                ]);
            }
        }
    }
}