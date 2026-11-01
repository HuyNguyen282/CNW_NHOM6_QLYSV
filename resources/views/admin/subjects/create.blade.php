@extends('layouts.app')

@section('content')
<x-form-card title="Thêm môn học mới">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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

        <div class="form-actions">
            <a href="{{ route('admin.subjects.index') }}"
               class="btn btn-secondary">Quay lại</a>

            <button type="submit" class="btn btn-primary">
                Thêm môn học
            </button>
        </div>
    </form>
</x-form-card>
@endsection
