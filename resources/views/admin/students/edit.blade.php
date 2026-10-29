<h2>Chỉnh sửa thông tin sinh viên</h2>

<form action="{{ route('admin.students.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label>Mã sinh viên:</label>
        <input type="text" name="student_code" value="{{ old('student_code', $student->student_code) }}" required>
    </div>
    <div>
        <label>Họ và tên:</label>
        <input type="text" name="full_name" value="{{ old('full_name', $student->full_name) }}" required>
    </div>
    <div>
        <label>Ngày sinh:</label>
        <input type="date" name="dob" value="{{ old('dob', $student->dob?->format('Y-m-d')) }}" required>
    </div>
    <div>
        <label>Giới tính:</label>
        <select name="gender" required>
            <option value="Nam" {{ old('gender', $student->gender) == 'Nam' ? 'selected' : '' }}>Nam</option>
            <option value="Nữ" {{ old('gender', $student->gender) == 'Nữ' ? 'selected' : '' }}>Nữ</option>
            <option value="Khác" {{ old('gender', $student->gender) == 'Khác' ? 'selected' : '' }}>Khác</option>
        </select>
    </div>
    <div>
        <label>Địa chỉ:</label>
        <input type="text" name="address" value="{{ old('address', $student->address) }}">
    </div>
    <div>
        <label>Lớp học:</label>
        <select name="class_room_id">
            <option value="">-- Chọn lớp học --</option>
            @foreach($classRooms as $room)
                <option value="{{ $room->id }}" {{ old('class_room_id', $student->class_room_id) == $room->id ? 'selected' : '' }}>
                    {{ $room->name }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit">Cập nhật</button>
    <a href="{{ route('admin.students.index') }}">Hủy</a>
</form>