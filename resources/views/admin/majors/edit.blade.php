@extends('layouts.app')

@section('content')
<x-form-card title="Chỉnh sửa ngành học">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Gửi form đến phương thức update() với biến $major -->
    <form action="{{ route('admin.majors.update', $major->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên Ngành</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $major->name) }}">
        </div>

        <div class="mb-3">
            <label for="faculty_id" class="form-label">Thuộc Khoa</label>
            <select class="form-select" name="faculty_id">
                <!-- Lặp biến $faculties truyền từ edit() -->
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}" {{ old('faculty_id', $major->faculty_id) == $faculty->id ? 'selected' : '' }}>
                        {{ $faculty->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.majors.index') }}" class="btn btn-secondary">Quay lại</a>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
    </form>
</x-form-card>
@endsection
