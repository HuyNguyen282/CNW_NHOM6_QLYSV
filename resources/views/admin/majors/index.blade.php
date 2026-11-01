@extends('layouts.app')

@section('content')

<div class="page-head">
    <h2 class="page-title">Quản lý ngành học</h2>
</div>

<div class="container py-4">
    
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary">Quản lý ngành học</h2>
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