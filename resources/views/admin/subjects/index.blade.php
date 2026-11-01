@extends('layouts.app')

@section('content')

@if($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="page-head">
    <h1 class="page-title">Quản lý môn học</h1>
</div>

<div class="table-card">
    <div class="card-head">
        <b>Danh sách môn học</b>
        <a href="{{ route('admin.subjects.create') }}" class="btn-primary-soft">
            Thêm môn học
        </a>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Mã môn học</th>
                <th>Tên môn học</th>
                <th>Số tín chỉ</th>
                <th>Thao tác</th>
            </tr>
        </thead>

        <tbody>
            @forelse($subjects as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->credits }}</td>
                    <td>
                        <div class="row-actions">
                            <a href="{{ route('admin.subjects.show', $row->id) }}" class="icon-btn">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('admin.subjects.edit', $row->id) }}" class="icon-btn">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form method="post"
                                  action="{{ route('admin.subjects.destroy', $row->id) }}"
                                  onsubmit="return confirm('Bạn có chắc muốn xóa môn học này không?')">
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
                <tr>
                    <td colspan="4" class="empty">
                        Chưa có môn học nào
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
