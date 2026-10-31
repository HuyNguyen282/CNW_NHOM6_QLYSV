@extends('layouts.app')

@section('content')
<x-form-card title="Thông tin chi tiết lớp học">
    <div class="mb-3">
        <label class="form-label">Mã lớp</label>
        <input type="text" class="form-control" value="{{ $class->id }}" readonly>
    </div>

    <div class="mb-3">
        <label class="form-label">Tên lớp</label>
        <input type="text" class="form-control" value="{{ $class->name }}" readonly>
    </div>

    <div class="mb-3">
        <label class="form-label">Ngành học</label>
        <input type="text" class="form-control" value="{{ $class->major->name ?? 'Chưa có ngành' }}" readonly>
    </div>

    <div class="mb-3">
        <label class="form-label">Khoa</label>
        <input type="text" class="form-control" value="{{ $class->major->faculty->name ?? 'Chưa có khoa' }}"
            readonly>
    </div>

    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea class="form-control" rows="3"
            readonly>{{ $class->description ?? 'Không có mô tả' }}</textarea>
    </div>

    <div class="form-actions">
        <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">
            Quay lại
        </a>

        <a href="{{ route('admin.classes.edit', $class->id) }}" class="btn btn-warning">
            Sửa thông tin
        </a>
    </div>
</x-form-card>
@endsection
