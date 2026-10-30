<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MajorSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Lấy ID khoa theo tên, không giả định ID luôn bắt đầu từ 1
        $faculties = [
            'Khoa Công nghệ thông tin' => [
                'Hệ thống thông tin',
                'Công nghệ thông tin',
                'Khoa học máy tính',
                'Trí tuệ nhân tạo và Khoa học dữ liệu',
                'Kỹ thuật phần mềm',
            ],

            'Khoa Kỹ thuật tài nguyên nước' => [
                'Kỹ thuật tài nguyên nước',
                'Thủy văn học',
            ],

            'Khoa Công trình' => [
                'Kỹ thuật xây dựng công trình thủy',
                'Kỹ thuật xây dựng',
                'Kỹ thuật xây dựng công trình giao thông',
            ],

            'Khoa Kinh tế và Quản lý' => [
                'Quản trị kinh doanh',
                'Kế toán',
                'Kinh tế',
            ],

            'Khoa Điện - Điện tử' => [
                'Kỹ thuật điện',
                'Kỹ thuật điều khiển và tự động hóa',
            ],

            'Khoa Cơ khí' => [
                'Kỹ thuật cơ khí',
                'Kỹ thuật ô tô',
                'Kỹ thuật cơ điện tử',
            ],

            'Khoa Hóa và Môi trường' => [
                'Kỹ thuật môi trường',
                'Công nghệ sinh học',
            ],

            'Khoa Ngoại ngữ' => [
                'Ngôn ngữ Anh',
            ],
        ];

        foreach ($faculties as $facultyName => $majorNames) {
            $facultyId = DB::table('faculties')
                ->where('name', $facultyName)
                ->value('id');

            if (!$facultyId) {
                $this->command->error(
                    "Không tìm thấy khoa: {$facultyName}"
                );
                continue;
            }

            foreach ($majorNames as $majorName) {
                DB::table('majors')->updateOrInsert(
                    ['name' => $majorName],
                    [
                        'faculty_id' => $facultyId,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }

        $this->command->info(
            'Đã thêm/cập nhật dữ liệu ngành thành công!'
        );
    }
}