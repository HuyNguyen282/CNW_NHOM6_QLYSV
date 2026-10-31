@extends('layouts.app')

@section('content')
    <div class="page-head">
        <h2 class="page-title">Danh sách ngành học</h2>
        <a href="{{ route('admin.majors.create') }}" class="btn-primary-soft">Thêm ngành mới</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-card">
        <table class="data-table">
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
                        <div class="row-actions">
                            <a href="{{ route('admin.majors.edit', $major->id) }}" class="icon-btn">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.majors.destroy', $major->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa ngành này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="icon-btn danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pager">
        {{ $majors->links() }}
    </div>
@endsection
