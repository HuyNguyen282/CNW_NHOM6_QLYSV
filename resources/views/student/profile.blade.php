<h2>Hồ sơ cá nhân Sinh viên</h2>

<div>
    <p><strong>Mã sinh viên:</strong> {{ $student->student_code }}</p>
    <p><strong>Họ và tên:</strong> {{ $student->full_name }}</p>
    <p><strong>Ngày sinh:</strong> {{ $student->dob?->format('d/m/Y') }}</p>
    <p><strong>Giới tính:</strong> {{ $student->gender }}</p>
    <p><strong>Địa chỉ:</strong> {{ $student->address ?? 'Chưa cập nhật' }}</p>
    <p><strong>Lớp sinh hoạt:</strong> {{ $student->classRoom?->name ?? 'Chưa xếp lớp' }}</p>
    <p><strong>Ngành học:</strong> {{ $student->classRoom?->major?->name ?? 'N/A' }}</p>
    <p><strong>Khoa quản lý:</strong> {{ $student->classRoom?->major?->faculty?->name ?? 'N/A' }}</p>
</div>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Đăng xuất</button>
</form>