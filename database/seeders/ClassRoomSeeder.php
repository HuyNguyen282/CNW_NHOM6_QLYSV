<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ClassRoomSeeder extends Seeder
{
public function run(): void
{
    $faker = Faker::create('vi_VN');

    // Danh sách ngành
    $majors = [
        1  => ['code' => 'HTTT', 'name' => 'Hệ thống thông tin'],
        2  => ['code' => 'CNTT', 'name' => 'Công nghệ thông tin'],
        3  => ['code' => 'KHMT', 'name' => 'Khoa học máy tính'],
        4  => ['code' => 'TTNT', 'name' => 'Trí tuệ nhân tạo và Khoa học dữ liệu'],
        5  => ['code' => 'KTPM', 'name' => 'Kỹ thuật phần mềm'],
        6  => ['code' => 'TNN', 'name' => 'Kỹ thuật tài nguyên nước'],
        7  => ['code' => 'TV', 'name' => 'Thủy văn học'],
        8  => ['code' => 'CX', 'name' => 'Kỹ thuật xây dựng công trình thủy'],
        9  => ['code' => 'XD', 'name' => 'Kỹ thuật xây dựng'],
        10 => ['code' => 'GT', 'name' => 'Kỹ thuật xây dựng công trình giao thông'],
        11 => ['code' => 'QTKD', 'name' => 'Quản trị kinh doanh'],
        12 => ['code' => 'KT', 'name' => 'Kế toán'],
        13 => ['code' => 'KTN', 'name' => 'Kinh tế'],
        14 => ['code' => 'D', 'name' => 'Kỹ thuật điện'],
        15 => ['code' => 'TDH', 'name' => 'Kỹ thuật điều khiển và tự động hóa'],
        16 => ['code' => 'CK', 'name' => 'Kỹ thuật cơ khí'],
        17 => ['code' => 'OT', 'name' => 'Kỹ thuật ô tô'],
        18 => ['code' => 'CDT', 'name' => 'Kỹ thuật cơ điện tử'],
        19 => ['code' => 'MT', 'name' => 'Kỹ thuật môi trường'],
        20 => ['code' => 'SH', 'name' => 'Công nghệ sinh học'],
        21 => ['code' => 'NNA', 'name' => 'Ngôn ngữ Anh'],
    ];

    $classRooms = [];

    // Mỗi ngành có một lớp thuộc các khóa 68, 67, 66 và 65
    foreach ($majors as $majorId => $major) {
        foreach ([68, 67, 66, 65] as $course) {
            $createdAt = $faker->dateTimeBetween('-2 years', 'now');

            $classRooms[] = [
                'name' => $course . $major['code'] . '1',
                'description' => 'Khóa ' . $course . ' - ' . $major['name'],
                'major_id' => $majorId,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }
    }

    // Thêm mới hoặc cập nhật lớp đã tồn tại
    foreach ($classRooms as $classRoom) {
        DB::table('class_rooms')->updateOrInsert(
            [
                'name' => $classRoom['name'],
                'major_id' => $classRoom['major_id'],
            ],
            $classRoom
        );
    }
}


}