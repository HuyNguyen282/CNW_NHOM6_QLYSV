@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<div class="container py-4">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary">Chỉnh sửa ngành học</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 fw-bold text-dark">Cập nhật thông tin ngành: {{ $major->name }}</h5>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3 shadow-sm">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.majors.update', $major->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Tên Ngành</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $major->name) }}">
                        </div>

                        <div class="mb-4">
                            <label for="faculty_id" class="form-label fw-semibold">Thuộc Khoa</label>
                            <select class="form-control" name="faculty_id">
                                @foreach($faculties as $faculty)
                                    <option value="{{ $faculty->id }}" {{ old('faculty_id', $major->faculty_id) == $faculty->id ? 'selected' : '' }}>
                                        {{ $faculty->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.majors.index') }}" class="btn btn-secondary px-4">Quay lại</a>
                            <button type="submit" class="btn btn-primary px-4">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection