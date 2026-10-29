@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="mt-3 mb-4">
    <h1 class="text-primary text-center">Quản lý lớp học</h1>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0">Danh sách lớp học</h5>
            </div>

            <div class="col-md-6 text-md-end mt-2 mt-md-0">
                <a href="{{ route('admin.classes.create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle me-1"></i>
                    Thêm lớp học
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 90px;">Mã lớp</th>
                        <th style="width: 200px;">Tên lớp</th>
                        <th>Mô tả</th>
                        <th class="text-center" style="width: 160px;">Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($classes) > 0)
                    @foreach($classes as $row)
                    <tr>
                        <td class="text-center">{{ $row->id }}</td>

                        <td>{{ $row->name }}</td>

                        <td>{{ $row->description ?? 'Không có mô tả' }}</td>

                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <a href="{{ route('admin.classes.show', $row->id) }}" class="btn btn-primary btn-sm"
                                    title="Xem chi tiết">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('admin.classes.edit', $row->id) }}" class="btn btn-warning btn-sm"
                                    title="Sửa lớp học">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form method="POST" action="{{ route('admin.classes.destroy', $row->id) }}"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa lớp này không?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm" title="Xóa lớp học">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            Chưa có lớp học nào
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @if(method_exists($classes, 'links'))
        <div class="mt-3">
            {{ $classes->links() }}
        </div>
        @endif
    </div>
</div>

@endsection