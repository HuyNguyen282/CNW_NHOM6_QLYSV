<div class="mb-3">
    <div class="mb-3">
        <label class="form-label">Mã sinh viên</label>
        <input type="text" name="student_code"
            value="{{ old('student_code', $score->student->student_code ?? '') }}"
            class="form-control @error('student_code') is-invalid @enderror"
            placeholder="Ví dụ: SV0093" autofocus>
        @error('student_code') <div class="invalid-feedback">{{ $message }}</div> @enderror

    </div>
    <div id="student-hint" class="form-text text-danger mb-2"></div>

    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <label class="form-label">Họ tên</label>
            <input type="text" class="form-control" data-info="name" readonly>
        </div>
        <div class="col-md-4">
            <label class="form-label">Lớp</label>
            <input type="text" class="form-control" data-info="class" readonly>
        </div>
        <div class="col-md-4">
            <label class="form-label">Khoa</label>
            <input type="text" class="form-control" data-info="faculty" readonly>
        </div>
    </div> @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
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

<script>
(function () {
    const codeInput = document.querySelector('input[name="student_code"]');
    const hint      = document.getElementById('student-hint');
    const fields    = document.querySelectorAll('[data-info]');
    const url       = @json(route('admin.scores.student-lookup'));
    let timer;

    // điền (hoặc xóa) mọi ô thông tin theo dữ liệu trả về
    function fill(data) {
        fields.forEach(function (el) {
            el.value = data ? (data[el.dataset.info] ?? '') : '';
        });
    }

    function lookup() {
        const code = codeInput.value.trim();

        if (!code) {
            fill(null);
            hint.textContent = '';
            return;
        }

        fetch(url + '?code=' + encodeURIComponent(code), {
            headers: { 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(d => {
            if (d.found) {
                fill(d);
                hint.textContent = '';
            } else {
                fill(null);
                hint.textContent = 'Không tìm thấy sinh viên có mã này';
            }
        })
        .catch(() => { fill(null); hint.textContent = ''; });
    }

    // đợi 0,3 giây sau khi ngừng gõ mới tra, tránh gọi liên tục
    codeInput.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(lookup, 300);
    });

    // trang sửa điểm: ô mã đã có sẵn thì tra luôn
    if (codeInput.value) lookup();
})();
</script>
