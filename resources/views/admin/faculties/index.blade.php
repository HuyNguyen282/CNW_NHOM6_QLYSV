@extends('layouts.app')

@section('content')
    <h2>Quản lý khoa</h2>

    @if (session('success')) <p>{{ session('success') }}</p> @endif
    @if (session('error')) <p>{{ session('error') }}</p> @endif

    <a href="{{ route('admin.faculties.create') }}">+ Thêm khoa</a>

    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên khoa</th>
                <th>Số ngành</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($faculties as $f)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $f->name }}</td>
                    <td>{{ $f->majors_count }}</td>
                    <td>
                        <a href="{{ route('admin.faculties.edit', $f) }}">Sửa</a>
                        <form method="POST" action="{{ route('admin.faculties.destroy', $f) }}"
                              style="display:inline" onsubmit="return confirm('Xóa khoa này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Chưa có khoa nào.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
