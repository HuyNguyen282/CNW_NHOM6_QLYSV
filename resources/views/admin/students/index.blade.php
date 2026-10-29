<h2>Danh sách sinh viên</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<a href="{{ route('admin.students.create') }}">Thêm sinh viên mới</a>

<form method="GET" action="{{ route('admin.students.index') }}">
    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Tìm theo tên/mã SV...">
    <select name="class_room_id">
        <option value="">-- Tất cả các lớp --</option>
        @foreach($classRooms as $room)
            <option value="{{ $room->id }}" {{ request('class_room_id') == $room->id ? 'selected' : '' }}>
                {{ $room->name }}
            </option>
        @endforeach
    </select>
    <button type="submit">Tìm kiếm</button>
</form>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Mã SV</th>
            <th>Họ và tên</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Lớp</th>
            <th>Ngành</th>
            <th>Khoa</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @forelse($students as $student)
            <tr>
                <td>{{ $student->student_code }}</td>
                <td>{{ $student->full_name }}</td>
                <td>{{ $student->dob?->format('d/m/Y') }}</td>
                <td>{{ $student->gender }}</td>
                <td>{{ $student->classRoom?->name ?? 'N/A' }}</td>
                <td>{{ $student->classRoom?->major?->name ?? 'N/A' }}</td>
                <td>{{ $student->classRoom?->major?->faculty?->name ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('admin.students.show', $student->id) }}">Xem</a> |
                    <a href="{{ route('admin.students.edit', $student->id) }}">Sửa</a> |
                    <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Xóa sinh viên này?')">Xóa</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">Chưa có sinh viên nào.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $students->links() }}