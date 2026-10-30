<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        $faculties = [
            'Khoa Công nghệ thông tin',
            'Khoa Kỹ thuật tài nguyên nước',
            'Khoa Công trình',
            'Khoa Kinh tế và Quản lý',
            'Khoa Điện - Điện tử',
            'Khoa Cơ khí',
            'Khoa Hóa và Môi trường',
            'Khoa Ngoại ngữ',
        ];

        foreach ($faculties as $name) {
            DB::table('faculties')->updateOrInsert(
                ['name' => $name],
                [
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }

        $this->command->info('Đã thêm/cập nhật dữ liệu khoa thành công!');
    }
}