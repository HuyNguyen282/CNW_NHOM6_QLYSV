<h2>Chi tiết sinh viên</h2>
<p><strong>Mã SV:</strong> {{ $student->student_code }}</p>
<p><strong>Họ tên:</strong> {{ $student->full_name }}</p>
<p><strong>Ngày sinh:</strong> {{ $student->dob?->format('d/m/Y') }}</p>
<p><strong>Giới tính:</strong> {{ $student->gender }}</p>
<p><strong>Địa chỉ:</strong> {{ $student->address ?? 'Chưa cập nhật' }}</p>
<p><strong>Lớp:</strong> {{ $student->classRoom?->name ?? 'Chưa phân lớp' }}</p>
<p><strong>Ngành:</strong> {{ $student->classRoom?->major?->name ?? 'N/A' }}</p>
<p><strong>Khoa:</strong> {{ $student->classRoom?->major?->faculty?->name ?? 'N/A' }}</p>
<a href="{{ route('admin.students.index') }}">Quay lại</a>