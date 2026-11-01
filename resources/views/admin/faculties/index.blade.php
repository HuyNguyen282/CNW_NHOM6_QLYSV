@extends('layouts.app')

@section('content')
    <div class="page-head">
        <h2 class="page-title">Quản lý khoa</h2>
        <a href="{{ route('admin.faculties.create') }}" class="btn-primary-soft">+ Thêm khoa</a>
    </div>

    @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <div class="table-card">
        <table class="data-table">
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
                            <div class="row-actions">
                                <a class="icon-btn" href="{{ route('admin.faculties.edit', $f) }}">
                                    <i class ="bi bi-pencil-square"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.faculties.destroy', $f) }}"
                                      onsubmit="return confirm('Xóa khoa này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn danger">
                                        <i class ="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="empty">Chưa có khoa nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
