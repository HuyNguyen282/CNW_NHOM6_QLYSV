@extends('layouts.app')

@section('content')
    <div class="page-head">
        <h2 class="page-title">Quản lý điểm</h2>
        <a href="{{ route('admin.scores.create') }}" class="btn-primary-soft">+ Nhập điểm</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-card">
        <table class="data-table">
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
                            <div class="row-actions">
                                <a class="icon-btn" href="{{ route('admin.scores.edit', $s) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.scores.destroy', $s) }}"
                                      onsubmit="return confirm('Xóa điểm này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="empty">Chưa có điểm nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
