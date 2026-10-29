<h2>Thêm sinh viên mới</h2>

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<form action="{{ route('admin.students.store') }}" method="POST">
    @csrf
    <div>
        <label>Mã sinh viên:</label>
        <input type="text" name="student_code" value="{{ old('student_code') }}" required>
        @error('student_code') <span style="color:red">{{ $message }}</span> @enderror
    </div>
    <div>
        <label>Họ và tên:</label>
        <input type="text" name="full_name" value="{{ old('full_name') }}" required>
        @error('full_name') <span style="color:red">{{ $message }}</span> @enderror
    </div>
    <div>
        <label>Ngày sinh:</label>
        <input type="date" name="dob" value="{{ old('dob') }}" required>
        @error('dob') <span style="color:red">{{ $message }}</span> @enderror
    </div>
    <div>
        <label>Giới tính:</label>
        <select name="gender" required>
            <option value="Nam" {{ old('gender') == 'Nam' ? 'selected' : '' }}>Nam</option>
            <option value="Nữ" {{ old('gender') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
            <option value="Khác" {{ old('gender') == 'Khác' ? 'selected' : '' }}>Khác</option>
        </select>
    </div>
    <div>
        <label>Địa chỉ:</label>
        <input type="text" name="address" value="{{ old('address') }}">
    </div>
    <div>
        <label>Lớp học:</label>
        <select name="class_room_id">
            <option value="">-- Chọn lớp học --</option>
            @foreach($classRooms as $room)
                <option value="{{ $room->id }}" {{ old('class_room_id') == $room->id ? 'selected' : '' }}>
                    {{ $room->name }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit">Lưu sinh viên</button>
    <a href="{{ route('admin.students.index') }}">Hủy</a>
</form>