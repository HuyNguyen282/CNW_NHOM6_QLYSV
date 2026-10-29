@extends('layouts.app')

@section('content')
    <h2>{{ $score->exists ? 'Sửa điểm' : 'Nhập điểm' }}</h2>

    <form method="POST"
          action="{{ $score->exists ? route('admin.scores.update', $score) : route('admin.scores.store') }}">
        @csrf
        @if ($score->exists)
            @method('PUT')
        @endif

        <div>
            <label>Sinh viên</label>
            <select name="student_id">
                <option value="">-- Chọn sinh viên --</option>
                @foreach ($students as $st)
                    <option value="{{ $st->id }}" @selected(old('student_id', $score->student_id ?? $selectStudentId ?? null ) == $st->id)>
                        {{ $st->student_code }} - {{ $st->full_name }}
                    </option>
                @endforeach
            </select>
            @error('student_id') <p>{{ $message }}</p> @enderror
        </div>

        <div>
            <label>Môn học</label>
            <select name="subject_id">
                <option value="">-- Chọn môn --</option>
                @foreach ($subjects as $sb)
                    <option value="{{ $sb->id }}" @selected(old('subject_id', $score->subject_id) == $sb->id)>
                        {{ $sb->name }}
                    </option>
                @endforeach
            </select>
            @error('subject_id') <p>{{ $message }}</p> @enderror
        </div>

        <div>
            <label>Điểm (0 - 10)</label>
            <input type="number" name="score" step="0.01" min="0" max="10"
                   value="{{ old('score', $score->score) }}">
            @error('score') <p>{{ $message }}</p> @enderror
        </div>

        <button type="submit">Lưu</button>
        <a href="{{ route('admin.scores.index') }}">Hủy</a>
    </form>
@endsection
