<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');
        $ho = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Hoàng', 'Huỳnh', 'Phan', 'Vũ', 'Võ', 'Đặng', 'Bùi', 'Đỗ', 'Hồ', 'Ngô', 'Dương', 'Lý'];
        
        $demNam = ['Văn', 'Hữu', 'Công', 'Quang', 'Minh', 'Đình', 'Xuân', 'Ngọc', 'Đức', 'Thế', 'Tuấn', 'Gia'];
        $tenNam = ['Anh', 'Bảo', 'Cường', 'Dũng', 'Đạt', 'Đức', 'Hải', 'Hiếu', 'Hoàng', 'Huy', 'Hùng', 'Khang', 'Khoa', 'Kiên', 'Lâm', 'Long', 'Minh', 'Nam', 'Phong', 'Phúc', 'Quân', 'Sơn', 'Thắng', 'Thành', 'Tiến', 'Tùng', 'Việt', 'Vinh'];
        
        $demNu = ['Thị', 'Ngọc', 'Thùy', 'Thu', 'Phương', 'Thanh', 'Bích', 'Hồng', 'Mai', 'Kim', 'Diễm', 'Bảo'];
        $tenNu = ['An', 'Châu', 'Chi', 'Diệp', 'Dung', 'Hà', 'Hân', 'Hoa', 'Huyền', 'Hương', 'Lan', 'Linh', 'Ly', 'Mai', 'My', 'Ngân', 'Ngọc', 'Nhi', 'Nhung', 'Oanh', 'Phương', 'Quyên', 'Quỳnh', 'Thảo', 'Thu', 'Thủy', 'Tiên', 'Trang', 'Trâm', 'Uyên', 'Vân', 'Vy', 'Yến'];

        for ($i = 1; $i <= 100; $i++) {
            // Random giới tính trước
            $gender = $faker->randomElement(['Nam', 'Nữ']);

            // Ghép tên dựa theo giới tính để đảm bảo logic
            if ($gender === 'Nam') {
                $fullName = $faker->randomElement($ho) . ' ' . $faker->randomElement($demNam) . ' ' . $faker->randomElement($tenNam);
            } else {
                $fullName = $faker->randomElement($ho) . ' ' . $faker->randomElement($demNu) . ' ' . $faker->randomElement($tenNu);
            }

            Student::create([
                'student_code' => 'HS' . date('Y') . str_pad($i, 3, '0', STR_PAD_LEFT),
                'full_name' => $fullName,
                'dob' => $faker->dateTimeBetween('2006-01-01', '2008-12-31')->format('Y-m-d'),
                'gender' => $gender,
                'address' => $faker->address,
                'class_room_id' => $faker->numberBetween(1, 18),
            ]);
        }
    }
}