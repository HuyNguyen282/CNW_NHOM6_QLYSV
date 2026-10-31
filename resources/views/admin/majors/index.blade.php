@extends('layouts.app')

@section('content')

<div class="page-head">
    <h2 class="page-title">Quản lý ngành học</h2>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="table-card">
    <div class="d-flex justify-content-between align-items-center px-3 py-3 border-bottom">
        <h5 class="mb-0 fw-bold text-dark">Danh sách ngành học</h5>
        <a href="{{ route('admin.majors.create') }}" class="btn-primary-soft">
            <i class="bi bi-plus-circle me-1"></i> Thêm ngành mới
        </a>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên ngành</th>
                <th>Thuộc khoa</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($majors as $major)
            <tr>
                <td>{{ $major->id }}</td>
                <td>{{ $major->name }}</td>
                <td>{{ $major->faculty ? $major->faculty->name : 'N/A' }}</td>
                <td>
                    <div class="row-actions">
                        <!-- Nút Xem chi tiết -->
                        <a href="{{ route('admin.majors.show', $major->id) }}" class="icon-btn text-info" title="Xem chi tiết">
                            <i class="bi bi-eye-fill"></i>
                        </a>

                        <!-- Nút Sửa -->
                        <a href="{{ route('admin.majors.edit', $major->id) }}" class="icon-btn" title="Sửa">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <!-- Nút Xóa -->
                        <form action="{{ route('admin.majors.destroy', $major->id) }}" method="POST"
                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa ngành này?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="icon-btn danger" title="Xóa">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="align-items-center px-3 py-3 border-top">
        <div>
            {{ $majors->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection