<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassRoom; // Import model ClassRoom

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            ['name' => '10A1', 'description' => 'Lớp 10A1 - Ban Tự nhiên'],
            ['name' => '10A2', 'description' => 'Lớp 10A2 - Ban Tự nhiên'],
            ['name' => '10A3', 'description' => 'Lớp 10A3 - Ban Tự nhiên'],
            ['name' => '10D1', 'description' => 'Lớp 10D1 - Ban Xã hội'],
            ['name' => '10D2', 'description' => 'Lớp 10D2 - Ban Xã hội'],
            ['name' => '10D3', 'description' => 'Lớp 10D3 - Ban Xã hội'],

            ['name' => '11A1', 'description' => 'Lớp 11A1 - Ban Tự nhiên'],
            ['name' => '11A2', 'description' => 'Lớp 11A2 - Ban Tự nhiên'],
            ['name' => '11A3', 'description' => 'Lớp 11A3 - Ban Tự nhiên'],
            ['name' => '11D1', 'description' => 'Lớp 11D1 - Ban Xã hội'],
            ['name' => '11D2', 'description' => 'Lớp 11D2 - Ban Xã hội'],
            ['name' => '11D3', 'description' => 'Lớp 11D3 - Ban Xã hội'],

            ['name' => '12A1', 'description' => 'Lớp 12A1 - Ban Tự nhiên'],
            ['name' => '12A2', 'description' => 'Lớp 12A2 - Ban Tự nhiên'],
            ['name' => '12A3', 'description' => 'Lớp 12A3 - Ban Tự nhiên'],
            ['name' => '12D1', 'description' => 'Lớp 12D1 - Ban Xã hội'],
            ['name' => '12D2', 'description' => 'Lớp 12D2 - Ban Xã hội'],
            ['name' => '12D3', 'description' => 'Lớp 12D3 - Ban Xã hội'],
           
        ];

        // Vòng lặp để tạo từng lớp học vào Database
        foreach ($classes as $class) {
            ClassRoom::create($class);
        }
    }
}