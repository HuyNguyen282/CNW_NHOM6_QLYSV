@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container py-4">
   
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary">Quản lý ngành học</h2>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

   
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
            <h5 class="mb-0 fw-bold text-dark">Danh sách ngành học</h5>
            <a href="{{ route('admin.majors.create') }}" class="btn btn-success btn-sm px-3 py-2 rounded-3 shadow-sm">
                <i class="fas fa-plus-circle me-1"></i> Thêm ngành mới
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Tên ngành</th>
                            <th>Thuộc khoa</th>
                            <th class="text-center" width="160px">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($majors as $major)
                        <tr>
                            <td class="ps-4 fw-semibold text-secondary">{{ $major->id }}</td>
                            <td class="fw-medium text-dark">{{ $major->name }}</td>
                            <td>{{ $major->faculty ? $major->faculty->name : 'N/A' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.majors.edit', $major->id) }}" class="btn btn-warning btn-sm text-white px-2 py-1 rounded shadow-sm" title="Sửa">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.majors.destroy', $major->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa ngành này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm px-2 py-1 rounded shadow-sm" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white py-3 border-top d-flex justify-content-between align-items-center">
            <div class="text-muted small">
                Hiển thị từ {{ $majors->firstItem() ?? 0 }} đến {{ $majors->lastItem() ?? 0 }} trên tổng số {{ $majors->total() }} kết quả
            </div>
            <div>
                {{ $majors->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection