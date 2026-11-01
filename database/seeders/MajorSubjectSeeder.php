<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MajorSubjectSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Xóa dữ liệu cũ của bảng trung gian trước khi seed mới
        DB::table('major_subject')->delete();

        // Định nghĩa danh sách môn học chuyên biệt cho từng ngành thủ công tại đây
        $majorSubjectsMap = [
            // --- Khoa Công nghệ thông tin ---
            'Hệ thống thông tin' => [
                'Lập trình căn bản', 
                'Cấu trúc dữ liệu và giải thuật', 
                'Hệ cơ sở dữ liệu', 
                'Phân tích thiết kế hệ thống thông tin', 
                'Hệ thống thông tin doanh nghiệp',
                'Lập trình Web'
            ],
            'Công nghệ thông tin' => [
                'Lập trình căn bản', 
                'Cấu trúc dữ liệu và giải thuật', 
                'Hệ cơ sở dữ liệu', 
                'Mạng máy tính', 
                'Lập trình hướng đối tượng', 
                'Công nghệ phần mềm'
            ],
            'Khoa học máy tính' => [
                'Lập trình căn bản', 
                'Cấu trúc dữ liệu và giải thuật', 
                'Toán rời rạc', 
                'Trí tuệ nhân tạo', 
                'Học máy', 
                'Nguyên lý hệ điều hành'
            ],
            'Trí tuệ nhân tạo và Khoa học dữ liệu' => [
                'Toán cao cấp cho Khoa học dữ liệu', 
                'Lập trình Python cho AI', 
                'Cơ sở dữ liệu lớn (Big Data)', 
                'Học máy', 
                'Học sâu (Deep Learning)'
            ],
            'Kỹ thuật phần mềm' => [
                'Lập trình căn bản', 
                'Lập trình hướng đối tượng', 
                'Công nghệ phần mềm', 
                'Kiểm thử phần mềm', 
                'Kiến trúc và thiết kế phần mềm'
            ],
            'Kỹ thuật tài nguyên nước' => [
                'Thủy lực đại cương', 
                'Thủy văn công trình', 
                'Cơ học lưu chất', 
                'Quản lý tài nguyên nước'
            ],
            'Thủy văn học' => [
                'Thủy văn đại cương', 
                'Khí tượng học', 
                'Đo đạc thủy văn', 
                'Dự báo thủy văn'
            ],
            'Kỹ thuật xây dựng công trình thủy' => [
                'Cơ học kết cấu', 
                'Sức bền vật liệu', 
                'Công trình thủy công', 
                'Địa chất công trình'
            ],
            'Kỹ thuật xây dựng' => [
                'Cơ học kết cấu', 
                'Sức bền vật liệu', 
                'Vật liệu xây dựng', 
                'Thiết kế kết cấu thép'
            ],
            'Kỹ thuật xây dựng công trình giao thông' => [
                'Trắc địa công trình', 
                'Thiết kế đường', 
                'Nền móng công trình giao thông'
            ],
            'Quản trị kinh doanh' => [
                'Nguyên lý quản trị kinh doanh', 
                'Marketing căn bản', 
                'Quản trị nguồn nhân lực', 
                'Tài chính doanh nghiệp'
            ],
            'Kế toán' => [
                'Nguyên lý kế toán', 
                'Kế toán tài chính', 
                'Kế toán quản trị', 
                'Kiểm toán căn bản'
            ],
            'Kinh tế' => [
                'Kinh tế vi mô', 
                'Kinh tế vĩ mô', 
                'Kinh tế lượng', 
                'Lịch sử kinh tế'
            ],
            'Kỹ thuật điện' => [
                'Kỹ thuật điện tử', 
                'Mạch điện', 
                'Hệ thống cung cấp điện', 
                'Máy điện'
            ],
            'Kỹ thuật điều khiển và tự động hóa' => [
                'Lý thuyết điều khiển tự động', 
                'Vi điều khiển', 
                'Hệ thống đo lường và điều khiển công nghiệp'
            ],
            'Kỹ thuật cơ khí' => [
                'Vẽ kỹ thuật', 
                'Nguyên lý máy', 
                'Chi tiết máy', 
                'Công nghệ chế tạo máy'
            ],
            'Kỹ thuật ô tô' => [
                'Động cơ đốt trong', 
                'Lý thuyết ô tô', 
                'Hệ thống điện - điện tử ô tô'
            ],
            'Kỹ thuật cơ điện tử' => [
                'Hệ thống nhúng', 
                'Robot công nghiệp', 
                'Truyền động điện và khí nén'
            ],
            'Kỹ thuật môi trường' => [
                'Hóa học môi trường', 
                'Công nghệ xử lý nước cấp và nước thải', 
                'Quản lý chất thải rắn'
            ],
            'Công nghệ sinh học' => [
                'Sinh học phân tử', 
                'Vi sinh vật học', 
                'Công nghệ tế bào', 
                'Công nghệ enzyme'
            ],
            'Ngôn ngữ Anh' => [
                'Ngữ pháp tiếng Anh thực hành', 
                'Ngữ âm - Âm vị học tiếng Anh', 
                'Biên dịch - Phiên dịch thương mại', 
                'Văn hóa các nước nói tiếng Anh'
            ],
        ];

        foreach ($majorSubjectsMap as $majorName => $subjectNames) {
            // Lấy ID ngành theo tên
            $majorId = DB::table('majors')->where('name', $majorName)->value('id');

            if (!$majorId) {
                $this->command->warn("Không tìm thấy ngành trong CSDL: {$majorName}");
                continue;
            }

            foreach ($subjectNames as $subjectName) {
                // Lấy ID môn học theo tên
                $subjectId = DB::table('subjects')->where('name', $subjectName)->value('id');

                if (!$subjectId) {
                    $this->command->warn(" - Không tìm thấy môn học: {$subjectName} (thuộc ngành {$majorName})");
                    continue;
                }

                // Chèn vào bảng trung gian major_subject
                DB::table('major_subject')->updateOrInsert(
                    [
                        'major_id'   => $majorId,
                        'subject_id' => $subjectId,
                    ],
                    [
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }

        $this->command->info('Đã cấu hình phân bổ môn học theo ngành thủ công thành công!');
    }
}