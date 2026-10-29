<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        // Danh sách môn học theo từng ngành
        $subjectsByMajor = [
            'Hệ thống thông tin' => [
                'Cơ sở dữ liệu',
                'Phân tích và thiết kế hệ thống thông tin',
                'Hệ thống thông tin quản lý',
                'Kho dữ liệu và khai phá dữ liệu',
                'Phân tích nghiệp vụ',
            ],

            'Công nghệ thông tin' => [
                'Nhập môn công nghệ thông tin',
                'Lập trình web',
                'Mạng máy tính',
                'An toàn thông tin',
                'Điện toán đám mây',
            ],

            'Khoa học máy tính' => [
                'Trí tuệ nhân tạo cơ bản',
                'Thuật toán nâng cao',
                'Học máy',
                'Xử lý ngôn ngữ tự nhiên',
                'Thị giác máy tính',
            ],

            'Trí tuệ nhân tạo và Khoa học dữ liệu' => [
                'Nhập môn trí tuệ nhân tạo',
                'Học sâu',
                'Khoa học dữ liệu',
                'Phân tích dữ liệu lớn',
                'Mạng nơ-ron nhân tạo',
            ],

            'Kỹ thuật phần mềm' => [
                'Công nghệ phần mềm',
                'Kiểm thử phần mềm',
                'Thiết kế phần mềm',
                'Quản lý dự án phần mềm',
                'Phát triển ứng dụng di động',
            ],

            'Kỹ thuật tài nguyên nước' => [
                'Thủy lực đại cương',
                'Quy hoạch tài nguyên nước',
                'Thủy văn công trình',
                'Quản lý tài nguyên nước',
                'Mô hình toán thủy văn',
            ],

            'Thủy văn học' => [
                'Thủy văn đại cương',
                'Khí tượng học',
                'Dự báo thủy văn',
                'Thủy văn lưu vực',
                'Biến đổi khí hậu',
            ],

            'Kỹ thuật xây dựng công trình thủy' => [
                'Cơ học đất',
                'Thủy công',
                'Kết cấu bê tông cốt thép',
                'Thiết kế đập',
                'Nền móng công trình thủy',
            ],

            'Kỹ thuật xây dựng' => [
                'Cơ học kết cấu',
                'Kết cấu thép',
                'Vật liệu xây dựng',
                'Thiết kế công trình dân dụng',
                'Tổ chức thi công',
            ],

            'Kỹ thuật xây dựng công trình giao thông' => [
                'Thiết kế đường ô tô',
                'Cầu bê tông cốt thép',
                'Quy hoạch giao thông',
                'Kết cấu áo đường',
                'Khảo sát công trình giao thông',
            ],

            'Quản trị kinh doanh' => [
                'Quản trị học',
                'Marketing căn bản',
                'Quản trị nhân lực',
                'Quản trị chiến lược',
                'Hành vi tổ chức',
            ],

            'Kế toán' => [
                'Nguyên lý kế toán',
                'Kế toán tài chính',
                'Kế toán quản trị',
                'Kiểm toán căn bản',
                'Phân tích báo cáo tài chính',
            ],

            'Kinh tế' => [
                'Kinh tế vi mô',
                'Kinh tế vĩ mô',
                'Kinh tế lượng',
                'Kinh tế phát triển',
                'Kinh tế quốc tế',
            ],

            'Kỹ thuật điện' => [
                'Mạch điện',
                'Máy điện',
                'Điện tử công suất',
                'Hệ thống cung cấp điện',
                'An toàn điện',
            ],

            'Kỹ thuật điều khiển và tự động hóa' => [
                'Lý thuyết điều khiển tự động',
                'Điều khiển logic',
                'Cảm biến và đo lường',
                'Hệ thống điều khiển số',
                'Robot công nghiệp',
            ],

            'Kỹ thuật cơ khí' => [
                'Nguyên lý máy',
                'Sức bền vật liệu',
                'Công nghệ chế tạo máy',
                'Chi tiết máy',
                'CAD/CAM',
            ],

            'Kỹ thuật ô tô' => [
                'Kết cấu ô tô',
                'Động cơ đốt trong',
                'Hệ thống truyền lực ô tô',
                'Điện và điện tử ô tô',
                'Chẩn đoán kỹ thuật ô tô',
            ],

            'Kỹ thuật cơ điện tử' => [
                'Hệ thống cơ điện tử',
                'Vi điều khiển',
                'Điều khiển robot',
                'Thiết kế hệ thống nhúng',
                'Cảm biến và cơ cấu chấp hành',
            ],

            'Kỹ thuật môi trường' => [
                'Hóa học môi trường',
                'Xử lý nước cấp',
                'Xử lý nước thải',
                'Quản lý chất thải rắn',
                'Đánh giá tác động môi trường',
            ],

            'Công nghệ sinh học' => [
                'Sinh học phân tử',
                'Di truyền học',
                'Vi sinh vật học',
                'Công nghệ gen',
                'Kỹ thuật lên men',
            ],

            'Ngôn ngữ Anh' => [
                'Ngữ âm tiếng Anh',
                'Ngữ pháp tiếng Anh',
                'Biên dịch tiếng Anh',
                'Phiên dịch tiếng Anh',
                'Giao tiếp liên văn hóa',
            ],
        ];

        $subjects = [];

        foreach ($subjectsByMajor as $majorName => $subjectNames) {
            foreach ($subjectNames as $subjectName) {
                $subjects[] = [
                    'name' => $subjectName,
                    'credits' => $faker->numberBetween(2, 4),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Chỉ thêm môn học chưa tồn tại
        foreach ($subjects as $subject) {
            DB::table('subjects')->updateOrInsert(
                ['name' => $subject['name']],
                $subject
            );
        }
    }
}

