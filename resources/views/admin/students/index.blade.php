@extends('layouts.app')

@section('title', 'Quản lý sinh viên')

@section('content')

<div class="page-head">
    <h2 class="page-title">Danh sách sinh viên</h2>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="GET" action="{{ route('admin.students.index') }}" class="filter-card">
    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Tìm theo tên/mã SV...">
    <a href="{{ route('admin.students.create') }}" class="btn-primary-soft">Thêm sinh viên mới</a>
    <select name="class_room_id">
        <option value="">-- Tất cả các lớp --</option>
        @foreach($classRooms as $room)
        <option value="{{ $room->id }}" {{ request('class_room_id') == $room->id ? 'selected' : '' }}>
            {{ $room->name }}
        </option>
        @endforeach
    </select>

    <button type="submit" class="btn-primary-soft">Tìm kiếm</button>
</form>

<div class="table-card">
    <table class="data-table">
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
                    <div class="row-actions">
                        <a class="icon-btn" href="{{ route('admin.students.show', $student->id) }}">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a class="icon-btn" href="{{ route('admin.students.edit', $student->id) }}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="icon-btn danger" onclick="return confirm('Xóa sinh viên này?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="empty">Chưa có sinh viên nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pager">
    {{ $students->links() }}
</div>

@endsection
