@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Danh sách ngành học</h2>
        <a href="{{ route('admin.majors.create') }}" class="btn btn-primary">Thêm ngành mới</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên ngành</th>
                <th>Thuộc khoa</th>
                <th width="150px">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($majors as $major)
            <tr>
                <td>{{ $major->id }}</td>
                <td>{{ $major->name }}</td>
                <!-- Gọi qua relationship (bảng faculties phải có cột name) -->
                <td>{{ $major->faculty ? $major->faculty->name : 'N/A' }}</td>
                <td>
                    <a href="{{ route('admin.majors.edit', $major->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.majors.destroy', $major->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa ngành này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
 
    <div class="d-flex justify-content-center">
        {{ $majors->links() }}
    </div>
</div>
@endsection