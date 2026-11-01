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

        // Lấy danh sách 200 sinh viên đầu tiên, kèm theo thông tin lớp và ngành học của sinh viên đó
        $students = DB::table('students')
            ->join('class_rooms', 'students.class_room_id', '=', 'class_rooms.id')
            ->whereIn('student_code', array_map(
                fn($i) => 'SV' . str_pad($i, 4, '0', STR_PAD_LEFT),
                range(1, 200)
            ))
            ->select('students.id as student_id', 'class_rooms.major_id')
            ->get();

        // Kiểm tra dữ liệu sinh viên
        if ($students->isEmpty()) {
            $this->command->error('Chưa có sinh viên!');
            return;
        }

        
        // Tạo điểm cho từng sinh viên 
        foreach ($students as $student) {
            // Lấy ra các ID môn học thuộc đúng ngành của sinh viên thông qua bảng trung gian major_subject
            $subjectIds = DB::table('major_subject')
                ->where('major_id', $student->major_id)
                ->pluck('subject_id');

            if ($subjectIds->isEmpty()) {
                continue; 
            }

            foreach ($subjectIds as $subjectId) {
                DB::table('scores')->updateOrInsert(
                    [
                        'student_id' => $student->student_id,
                        'subject_id' => $subjectId,
                    ],
                    [
                        'score'      => $faker->randomFloat(2, 4, 10),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
               
            }
        }

      
    }
}