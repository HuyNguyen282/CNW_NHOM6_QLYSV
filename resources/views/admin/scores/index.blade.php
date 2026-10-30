@extends('layouts.app')

@section('content')
    <h2>Quản lý điểm</h2>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('admin.scores.create') }}">+ Nhập điểm</a>

    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>#</th>
                <th>Mã SV</th>
                <th>Họ tên</th>
                <th>Môn học</th>
                <th>Điểm</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($scores as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->student->student_code }}</td>
                    <td>{{ $s->student->full_name }}</td>
                    <td>{{ $s->subject->name }}</td>
                    <td>{{ $s->score }}</td>
                    <td>
                        <a href="{{ route('admin.scores.edit', $s) }}">Sửa</a>
                        <form method="POST" action="{{ route('admin.scores.destroy', $s) }}"
                              style="display:inline" onsubmit="return confirm('Xóa điểm này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Chưa có điểm nào.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
