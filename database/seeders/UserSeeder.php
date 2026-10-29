<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 1. Tạo tài khoản Giáo viên 
        User::create([
            'name' => 'Giáo viên',
            'username' => 'teacher', 
            'email' => 'teachern@school.edu.vn',
            'password' => Hash::make('password123'),
            'role' => 'admin', 
            'student_id' => null,
        ]);

       
        for ($i = 1; $i <= 100; $i++) {
            User::create([
                'name' => 'Học sinh ' . $i,
                'username' => 'student' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'email' => 'student' . $i . '@school.edu.vn',
                'password' => Hash::make('123456'),
                'role' => 'student',
                'student_id' => $i, 
            ]);
        }
    }
}