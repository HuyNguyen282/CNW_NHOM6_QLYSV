@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Thông tin chi tiết lớp học</div>
    <div class="card-body">
        <div class="form-group mb-3">
            <label class="col-sm-2 col-label-form">Mã lớp</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $class->id }}" readonly>
            </div>
        </div>

        <div class="form-group mb-3">
            <label class="col-sm-2 col-label-form">Tên lớp</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $class->name }}" readonly>
            </div>
        </div>

        <div class="form-group mb-3">
            <label class="col-sm-2 col-label-form">Mo ta</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3"
                    readonly>{{ $class->description ?? 'Không có mô tả' }}</textarea>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">Quay lại</a>
            <a href="{{ route('admin.classes.edit', $class->id) }}" class="btn btn-warning">Sửa thông tin</a>
        </div>
    </div>
</div>
@endsection