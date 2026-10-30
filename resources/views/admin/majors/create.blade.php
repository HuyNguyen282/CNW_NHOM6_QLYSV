@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Thêm ngành học</h2>

    <!-- Hiển thị lỗi validation  -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
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
            <select class="form-control" name="faculty_id">
                <option value="">-- Chọn khoa --</option>
                <!-- Lặp biến $faculties được truyền từ create() -->
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>
                        {{ $faculty->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Lưu dữ liệu</button>
        <a href="{{ route('admin.majors.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection