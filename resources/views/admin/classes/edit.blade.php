@extends('layouts.app')

@section('title', 'Sửa thông tin lớp học')

@section('content')

@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Sửa thông tin lớp học</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.classes.update', $class->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Tên lớp</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $class->name) }}"
                    placeholder="Nhập tên lớp" required>
            </div>

            <div class="mb-3">
                <label for="major_id" class="form-label">Ngành học</label>
                <select class="form-select" id="major_id" name="major_id" required>
                    <option value="">-- Chọn ngành học --</option>

                    @foreach($majors as $major)
                    <option value="{{ $major->id }}"
                        {{ old('major_id', $class->major_id) == $major->id ? 'selected' : '' }}>
                        {{ $major->name }} - {{ $major->faculty->name ?? 'Chưa có khoa' }}
                    </option>
                    @endforeach
                </select>

                @error('major_id')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    placeholder="Nhập mô tả lớp học">{{ old('description', $class->description) }}</textarea>
            </div>

            <div class="text-center">
                <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Quay lại
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Cập nhật
                </button>
            </div>
        </form>
    </div>
</div>

@endsection