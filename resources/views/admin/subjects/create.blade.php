
@extends('layouts.app')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-header">Thêm môn học mới</div>

    <div class="card-body">
        <form method="post" action="{{ route('admin.subjects.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tên môn học</label>
                <input type="text" name="name"
                       class="form-control"
                       value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Số tín chỉ</label>
                <input type="number" name="credits"
                       class="form-control"
                       value="{{ old('credits') }}"
                       min="1" max="255" required>
            </div>

            <a href="{{ route('admin.subjects.index') }}"
               class="btn btn-secondary">Quay lại</a>

            <button type="submit" class="btn btn-primary">
                Thêm môn học
            </button>
        </form>
    </div>
</div>

@endsection
