<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // 1. Nhóm bảng cha (Không chứa khóa ngoại) 
            ClassRoomSeeder::class, 
            SubjectSeeder::class,   

            // 2. Nhóm bảng con cấp 1
            StudentSeeder::class,  

            // 3. Nhóm bảng con cấp 2
            UserSeeder::class,     
            ScoreSeeder::class,     //
        ]);
    }
}
