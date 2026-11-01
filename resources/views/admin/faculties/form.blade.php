@extends('layouts.app')

@section('content')
<x-form-card :title="$faculty->exists ? 'Sửa khoa' : 'Thêm khoa'">
    <form method="POST"
        action="{{ $faculty->exists ? route('admin.faculties.update', $faculty) : route('admin.faculties.store') }}">
        @csrf
        @if ($faculty->exists)
        @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Tên khoa</label>
            <input type="text" name="name" value="{{ old('name', $faculty->name) }}"
                class="form-control @error('name') is-invalid @enderror">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.faculties.index') }}" class="btn btn-secondary">Hủy</a>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
</x-form-card>
@endsection
