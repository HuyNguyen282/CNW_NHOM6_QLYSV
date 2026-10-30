<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        // Danh sách tên đệm phổ biến của người Việt
        $middleNames = [
            'Văn', 'Thị', 'Minh', 'Hoàng', 'Ngọc',
            'Đức', 'Quang', 'Thu', 'Thanh', 'Hải',
            'Gia', 'Phương', 'Khánh', 'Bảo', 'Anh',
            'Tuấn', 'Xuân', 'Hồng', 'Mạnh', 'Thành'
        ];

        // Lấy danh sách ID lớp học thực tế trong database
        $classRoomIds = DB::table('class_rooms')
            ->pluck('id')
            ->toArray();

        if (empty($classRoomIds)) {
            $this->command->error(
                'Không tìm thấy lớp học. Hãy chạy ClassRoomSeeder trước!'
            );

            return;
        }

        for ($i = 1; $i <= 200; $i++) {

            // Mã sinh viên từ SV0001 đến SV0200
            $studentCode = 'SV' . str_pad($i, 4, '0', STR_PAD_LEFT);

            // Tạo họ tên bằng Faker, không sử dụng tiền tố xưng hô
            $fullName = $faker->lastName() . ' '
                      . $middleNames[array_rand($middleNames)] . ' '
                      . $faker->firstName();

            // Ngày sinh trong khoảng 18 đến 25 tuổi
            $dob = $faker->dateTimeBetween('-25 years', '-18 years')
                         ->format('Y-m-d');

            // Giới tính
            $gender = $faker->randomElement(['Nam', 'Nữ']);

            // Địa chỉ tại Việt Nam
            $address = $faker->address();

            // Chọn một lớp học đang tồn tại
            $classRoomId = $faker->randomElement($classRoomIds);

            // Thêm mới hoặc cập nhật sinh viên theo mã sinh viên
            DB::table('students')->updateOrInsert(
                ['student_code' => $studentCode],
                [
                    'full_name'    => $fullName,
                    'dob'          => $dob,
                    'gender'       => $gender,
                    'address'      => $address,
                    'class_room_id' => $classRoomId,
                    'updated_at'   => now(),
                    'created_at'   => now(),
                ]
            );
        }

        $this->command->info(
            'Đã thêm/cập nhật thành công 200 sinh viên!'
        );
    }
}

