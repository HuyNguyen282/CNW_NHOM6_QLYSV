@extends('layouts.app')

@section('content')
<x-form-card title="Chỉnh sửa thông tin sinh viên">
    <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Mã sinh viên:</label>
            <input type="text" name="student_code" value="{{ old('student_code', $student->student_code) }}" required class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Họ và tên:</label>
            <input type="text" name="full_name" value="{{ old('full_name', $student->full_name) }}" required class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày sinh:</label>
            <input type="date" name="dob" value="{{ old('dob', $student->dob?->format('Y-m-d')) }}" required class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Giới tính:</label>
            <select name="gender" required class="form-select">
                <option value="Nam" {{ old('gender', $student->gender) == 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ old('gender', $student->gender) == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                <option value="Khác" {{ old('gender', $student->gender) == 'Khác' ? 'selected' : '' }}>Khác</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Địa chỉ:</label>
            <input type="text" name="address" value="{{ old('address', $student->address) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Lớp học:</label>
            <select name="class_room_id" class="form-select">
                <option value="">-- Chọn lớp học --</option>
                @foreach($classRooms as $room)
                    <option value="{{ $room->id }}" {{ old('class_room_id', $student->class_room_id) == $room->id ? 'selected' : '' }}>
                        {{ $room->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Hủy</a>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
    </form>
</x-form-card>
@endsection
