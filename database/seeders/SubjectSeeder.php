<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject; // Import model Subject

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Khai báo danh sách 11 môn học và số tín chỉ (hoặc số tiết/tuần) tương ứng
        $subjects = [
            ['name' => 'Toán', 'credits' => 4],
            ['name' => 'Ngữ văn', 'credits' => 4],
            ['name' => 'Tiếng Anh', 'credits' => 3],
            ['name' => 'Vật lý', 'credits' => 2],
            ['name' => 'Hóa học', 'credits' => 2],
            ['name' => 'Sinh học', 'credits' => 2],
            ['name' => 'Lịch sử', 'credits' => 2],
            ['name' => 'Địa lý', 'credits' => 2],
            ['name' => 'Giáo dục công dân', 'credits' => 1],
            ['name' => 'Tin học', 'credits' => 2],
            ['name' => 'Giáo dục thể chất', 'credits' => 1],
        ];

        
        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}