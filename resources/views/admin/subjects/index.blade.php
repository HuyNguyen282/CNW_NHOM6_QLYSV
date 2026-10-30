
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

<div class="container mt-4">
    <h1 class="text-primary text-center mb-4">
        <b>Quản lý môn học</b>
    </h1>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <b>Danh sách môn học</b>
                </div>

                <div class="col-md-6">
                    <a href="{{ route('admin.subjects.create') }}"
                       class="btn btn-success btn-sm float-end">
                        Thêm môn học
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
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
                                <a href="{{ route('admin.subjects.show', $row->id) }}"
                                   class="btn btn-primary btn-sm">
                                    Xem
                                </a>

                                <a href="{{ route('admin.subjects.edit', $row->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Sửa
                                </a>

                                <form method="post"
                                      action="{{ route('admin.subjects.destroy', $row->id) }}"
                                      style="display:inline-block"
                                      onsubmit="return confirm('Bạn có chắc muốn xóa môn học này không?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Chưa có môn học nào
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
