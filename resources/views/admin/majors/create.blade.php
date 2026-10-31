@extends('layouts.app')

@section('content')
<x-form-card title="Thêm ngành học">
    <!-- Hiển thị lỗi validation  -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.majors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên ngành</label>
            <!-- Name khớp với $request->input('name') -->
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nhập tên ngành...">
        </div>

        <div class="mb-3">
            <label for="faculty_id" class="form-label">Thuộc khoa</label>
            <!-- Name khớp với $request->input('faculty_id') -->
            <select class="form-select" name="faculty_id">
                <option value="">-- Chọn khoa --</option>
                <!-- Lặp biến $faculties được truyền từ create() -->
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>
                        {{ $faculty->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.majors.index') }}" class="btn btn-secondary">Quay lại</a>
            <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
        </div>
    </form>
</x-form-card>
@endsection
