@extends('layouts.app')

@section('content')
<x-form-card title="Sửa thông tin môn học">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post"
          action="{{ route('admin.subjects.update', $subject->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên môn học</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $subject->name) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Số tín chỉ</label>
            <input type="number"
                   name="credits"
                   class="form-control"
                   value="{{ old('credits', $subject->credits) }}"
                   min="1"
                   max="255"
                   required>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.subjects.index') }}"
               class="btn btn-secondary">
                Quay lại
            </a>

            <button type="submit" class="btn btn-primary">
                Lưu thay đổi
            </button>
        </div>
    </form>
</x-form-card>
@endsection
