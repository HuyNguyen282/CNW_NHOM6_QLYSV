@extends('layouts.app')

@section('title', 'Quản lý lớp học')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="page-head">
    <h1 class="page-title">Quản lý lớp học</h1>
</div>

<div class="table-card">
    <div class="card-head">
        <h5 class="mb-0">Danh sách lớp học</h5>
        <a href="{{ route('admin.classes.create') }}" class="btn-primary-soft">
            <i class="bi bi-plus-circle me-1"></i>
            Thêm lớp học
        </a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">Mã lớp</th>
                    <th style="width: 150px;">Tên lớp</th>
                    <th>Ngành học</th>
                    <th>Khoa</th>
                    <th>Mô tả</th>
                    <th class="text-center" style="width: 160px;">Thao tác</th>
                </tr>
            </thead>

            <tbody>
                @forelse($classes as $row)
                <tr>
                    <td class="text-center">{{ $row->id }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->major->name ?? 'Chưa có ngành' }}</td>
                    <td>{{ $row->major->faculty->name ?? 'Chưa có khoa' }}</td>
                    <td>{{ $row->description ?? 'Không có mô tả' }}</td>
                    <td>
                        <div class="row-actions" style="justify-content:center">
                            <a href="{{ route('admin.classes.show', $row->id) }}" class="icon-btn"
                                title="Xem chi tiết">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('admin.classes.edit', $row->id) }}" class="icon-btn"
                                title="Sửa lớp học">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form method="POST" action="{{ route('admin.classes.destroy', $row->id) }}"
                                onsubmit="return confirm('Bạn có chắc muốn xóa lớp này không?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="icon-btn danger" title="Xóa lớp học">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                        Chưa có lớp học nào
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if(method_exists($classes, 'links'))
<div class="pager">
    {{ $classes->links() }}
</div>
@endif

@endsection
