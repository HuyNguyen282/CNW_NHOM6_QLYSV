<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ScoreSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        // Lấy danh sách 200 sinh viên đầu tiên
        $students = DB::table('students')
            ->whereIn('student_code', array_map(
                fn($i) => 'SV' . str_pad($i, 4, '0', STR_PAD_LEFT),
                range(1, 200)
            ))
            ->get();

        // Lấy danh sách môn học
        $subjects = DB::table('subjects')->pluck('id');

        // Kiểm tra dữ liệu
        if ($students->isEmpty()) {
            $this->command->error('Chưa có sinh viên!');
            return;
        }

        if ($subjects->isEmpty()) {
            $this->command->error('Chưa có môn học! ');
            return;
        }

        // Tạo điểm cho từng sinh viên ở các môn học
        foreach ($students as $student) {
            foreach ($subjects as $subjectId) {
                DB::table('scores')->updateOrInsert(
                    [
                        'student_id' => $student->id,
                        'subject_id' => $subjectId,
                    ],
                    [
                        
                        'score' => $faker->randomFloat(2, 5.5, 10),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }

        $this->command->info('Đã cập nhật điểm cho sinh viên!');
    }
}