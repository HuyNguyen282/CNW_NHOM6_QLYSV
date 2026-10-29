<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Danh sách sinh viên (Admin) - Kèm tìm kiếm & lọc theo lớp
     */
    public function index(Request $request)
    {
        $query = Student::with('classRoom.major.faculty');

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('full_name', 'like', "%{$keyword}%")
                  ->orWhere('student_code', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('class_room_id')) {
            $query->where('class_room_id', $request->class_room_id);
        }

        $students = $query->latest()->paginate(10);
        $classRooms = ClassRoom::all();

        return view('admin.students.index', compact('students', 'classRooms'));
    }

    /**
     * Form thêm sinh viên
     */
    public function create()
    {
        $classRooms = ClassRoom::all();
        return view('admin.students.create', compact('classRooms'));
    }

    /**
     * Lưu sinh viên + Tạo tài khoản User tự động (DB::transaction)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_code'  => 'required|string|max:50|unique:students,student_code',
            'full_name'     => 'required|string|max:255',
            'dob'           => 'required|date',
            'gender'        => 'required|string|in:Nam,Nữ,Khác',
            'address'       => 'nullable|string|max:500',
            'class_room_id' => 'nullable|exists:class_rooms,id',
        ], [
            'student_code.required' => 'Vui lòng nhập mã sinh viên.',
            'student_code.unique'   => 'Mã sinh viên này đã tồn tại.',
            'full_name.required'    => 'Vui lòng nhập họ và tên.',
            'dob.required'          => 'Vui lòng chọn ngày sinh.',
            'gender.required'       => 'Vui lòng chọn giới tính.',
            'class_room_id.exists'  => 'Lớp học không hợp lệ.',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                // 1. Tạo bản ghi sinh viên
                $student = Student::create([
                    'student_code'  => $validated['student_code'],
                    'full_name'     => $validated['full_name'],
                    'dob'           => $validated['dob'],
                    'gender'        => $validated['gender'],
                    'address'       => $validated['address'] ?? null,
                    'class_room_id' => $validated['class_room_id'] ?? null,
                ]);

                // 2. Tạo User tương ứng (username = mã SV, password = mã SV)
                User::create([
                    'name'       => $validated['full_name'], // Bắt buộc do cột name trong DB NOT NULL
                    'username'   => $student->student_code,
                    'password'   => Hash::make($student->student_code),
                    'role'       => 'student',
                    'student_id' => $student->id,
                ]);
            });

            return redirect()->route('admin.students.index')
                             ->with('success', 'Thêm sinh viên và cấp tài khoản thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Lỗi hệ thống: ' . $e->getMessage());
        }
    }

    /**
     * Chi tiết sinh viên (Admin xem)
     */
    public function show(string $id)
    {
        $student = Student::with('classRoom.major.faculty')->findOrFail($id);
        return view('admin.students.show', compact('student'));
    }

    /**
     * Form sửa sinh viên
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        $classRooms = ClassRoom::all();
        return view('admin.students.edit', compact('student', 'classRooms'));
    }

    /**
     * Cập nhật thông tin sinh viên
     */
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'student_code'  => 'required|string|max:50|unique:students,student_code,' . $student->id,
            'full_name'     => 'required|string|max:255',
            'dob'           => 'required|date',
            'gender'        => 'required|string|in:Nam,Nữ,Khác',
            'address'       => 'nullable|string|max:500',
            'class_room_id' => 'nullable|exists:class_rooms,id',
        ]);

        try {
            DB::transaction(function () use ($student, $validated) {
                $oldCode = $student->student_code;

                $student->update([
                    'student_code'  => $validated['student_code'],
                    'full_name'     => $validated['full_name'],
                    'dob'           => $validated['dob'],
                    'gender'        => $validated['gender'],
                    'address'       => $validated['address'] ?? null,
                    'class_room_id' => $validated['class_room_id'] ?? null,
                ]);

                // Nếu đổi mã sinh viên, cập nhật lại username và name trong bảng users
                if ($oldCode !== $validated['student_code'] || $student->isDirty('full_name')) {
                    User::where('student_id', $student->id)->update([
                        'name'     => $validated['full_name'],
                        'username' => $validated['student_code'],
                    ]);
                }
            });

            return redirect()->route('admin.students.index')
                             ->with('success', 'Cập nhật thông tin sinh viên thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Lỗi hệ thống: ' . $e->getMessage());
        }
    }

    /**
     * Xóa sinh viên
     */
    public function destroy(string $id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete(); // User tự xóa nhờ cascadeOnDelete() ở migration

            return redirect()->route('admin.students.index')
                             ->with('success', 'Xóa sinh viên thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi khi xóa: ' . $e->getMessage());
        }
    }
}