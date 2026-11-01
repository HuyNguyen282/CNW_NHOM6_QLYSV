<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        // id các học sinh đã có (StudentSeeder phải chạy trước)
        $studentIds = DB::table('students')->orderBy('id')->pluck('id')->all();

        $users = [
            [
                'name' => 'Quản trị viên',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',               // thêm
                'student_id' => null,            // thêm
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nguyễn Văn An',
                'email' => 'annguyen@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'student',                       // thêm
                'student_id' => $studentIds[0] ?? null,    // thêm
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Trần Thị Bình',
                'email' => 'binhtran@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'student',                       // thêm
                'student_id' => $studentIds[1] ?? null,    // thêm
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        for ($i = 0; $i < 20; $i++) {
            $users[] = [
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('12345678'),
                'role' => 'student',      // thêm
                'student_id' => null,     // thêm
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Thêm mới hoặc cập nhật tài khoản theo email
        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                $user
            );
        }
        $gender = [
            'annguyen@gmail.com' => 'Nam',
            'binhtran@gmail.com'=> 'Nữ',
        ];
        foreach ($gender as $email => $g) {
            $u = DB::table('users')->where('email', $email)->first();
            if ($u && $u->student_id) {
                DB::table('students')->where('id', $u->student_id)->update([
                    'full_name' => $u->name,
                    'gender'    => $g,
                ]);
            }
        }
    }
}
