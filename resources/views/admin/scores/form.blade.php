<div class="mb-3">
    <label class="form-label">Sinh viên</label>
    <select name="student_id" class="form-select @error('student_id') is-invalid @enderror">
        <option value="">-- Chọn sinh viên --</option>
        @foreach ($students as $st)
            <option value="{{ $st->id }}" @selected(old('student_id', $score->student_id ?? $selectStudentId ?? null ) == $st->id)>
                {{ $st->student_code }} - {{ $st->full_name }}
            </option>
        @endforeach
    </select>
    @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Môn học</label>
    <select name="subject_id" class="form-select @error('subject_id') is-invalid @enderror">
        <option value="">-- Chọn môn --</option>
        @foreach ($subjects as $sb)
            <option value="{{ $sb->id }}" @selected(old('subject_id', $score->subject_id) == $sb->id)>
                {{ $sb->name }}
            </option>
        @endforeach
    </select>
    @error('subject_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Điểm (0 - 10)</label>
    <input type="number" name="score" step="0.01" min="0" max="10"
           value="{{ old('score', $score->score) }}"
           class="form-control @error('score') is-invalid @enderror">
    @error('score') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-actions">
    <a href="{{ route('admin.scores.index') }}" class="btn btn-secondary">Hủy</a>
    <button type="submit" class="btn btn-primary">Lưu</button>
</div>
