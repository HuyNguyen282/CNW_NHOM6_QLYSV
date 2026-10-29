<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;

class ProfileController extends Controller
{
    /**
     * Hiển thị hồ sơ cá nhân của sinh viên đang đăng nhập
     */
    public function index()
    {
        $user = auth()->user();

        // Kiểm tra xem tài khoản này đã liên kết với sinh viên nào chưa
        if (!$user->student_id) {
            abort(404, 'Tài khoản chưa được liên kết với dữ liệu sinh viên.');
        }

        // Lấy thông tin sinh viên kèm Lớp -> Ngành -> Khoa
        $student = Student::with('classRoom.major.faculty')
                          ->findOrFail($user->student_id);

        return view('student.profile', compact('student'));
    }
}