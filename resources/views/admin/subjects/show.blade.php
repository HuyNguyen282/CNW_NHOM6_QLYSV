
@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        Chi tiết môn học
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th style="width: 200px">Mã môn học</th>
                <td>{{ $subject->id }}</td>
            </tr>

            <tr>
                <th>Tên môn học</th>
                <td>{{ $subject->name }}</td>
            </tr>

            <tr>
                <th>Số tín chỉ</th>
                <td>{{ $subject->credits }}</td>
            </tr>
        </table>

        <a href="{{ route('admin.subjects.index') }}"
           class="btn btn-secondary">
            Quay lại danh sách
        </a>

        <!-- <a href="{{ route('admin.subjects.edit', $subject->id) }}"
           class="btn btn-warning">
            Sửa môn học
        </a> -->
    </div>
</div>

@endsection
