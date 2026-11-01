@extends('layouts.app')

@section('content')
<x-form-card title="Thêm sinh viên mới">
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.students.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Mã sinh viên:</label>
            <input type="text" name="student_code" value="{{ old('student_code') }}" required
                   class="form-control @error('student_code') is-invalid @enderror">
            @error('student_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Họ và tên:</label>
            <input type="text" name="full_name" value="{{ old('full_name') }}" required
                   class="form-control @error('full_name') is-invalid @enderror">
            @error('full_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày sinh:</label>
            <input type="date" name="dob" value="{{ old('dob') }}" required
                   class="form-control @error('dob') is-invalid @enderror">
            @error('dob') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Giới tính:</label>
            <select name="gender" required class="form-select">
                <option value="Nam" {{ old('gender') == 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ old('gender') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                <option value="Khác" {{ old('gender') == 'Khác' ? 'selected' : '' }}>Khác</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Địa chỉ:</label>
            <input type="text" name="address" value="{{ old('address') }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Lớp học:</label>
            <select name="class_room_id" class="form-select">
                <option value="">-- Chọn lớp học --</option>
                @foreach($classRooms as $room)
                    <option value="{{ $room->id }}" {{ old('class_room_id') == $room->id ? 'selected' : '' }}>
                        {{ $room->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Hủy</a>
            <button type="submit" class="btn btn-primary">Lưu sinh viên</button>
        </div>
    </form>
</x-form-card>
@endsection
