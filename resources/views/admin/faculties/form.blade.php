@extends('layouts.app')

@section('content')
    <h2>{{ $faculty->exists ? 'Sửa khoa' : 'Thêm khoa' }}</h2>

    <form method="POST"
          action="{{ $faculty->exists ? route('admin.faculties.update', $faculty) : route('admin.faculties.store') }}">
        @csrf
        @if ($faculty->exists)
            @method('PUT')
        @endif

        <div>
            <label>Tên khoa</label>
            <input type="text" name="name" value="{{ old('name', $faculty->name) }}">
            @error('name') <p>{{ $message }}</p> @enderror
        </div>

        <button type="submit">Lưu</button>
        <a href="{{ route('admin.faculties.index') }}">Hủy</a>
    </form>
@endsection
