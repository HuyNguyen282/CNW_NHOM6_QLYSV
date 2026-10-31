@extends('layouts.app')

@section('content')
<div class="mx-auto" style="max-width: 900px;">
    <div class="mb-4">
        <h1 class="h4 page-title mb-1">
            <i class="bi bi-mortarboard-fill me-2" style="color:#4f46e5;"></i>
            Thông tin lớp học
        </h1>
        <p class="text-muted mb-0">Thông tin lớp học của bạn</p>
    </div>

    @if (!$student)
    <div class="alert alert-warning">
        Tài khoản chưa được liên kết với thông tin sinh viên.
    </div>
    @elseif (!$classRoom)
    <div class="alert alert-warning">
        Bạn chưa được xếp lớp.
    </div>
    @else
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 py-3 px-4">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-building me-2" style="color:#4f46e5;"></i>
                Lớp {{ $classRoom->name }}
            </h5>
        </div>

        <div class="card-body px-4 pt-2 pb-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">Mã sinh viên</label>
                    <input type="text" class="form-control bg-light" value="{{ $student->student_code }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Họ và tên</label>
                    <input type="text" class="form-control bg-light" value="{{ $student->full_name }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Mã lớp</label>
                    <input type="text" class="form-control bg-light" value="{{ $classRoom->id }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tên lớp</label>
                    <input type="text" class="form-control bg-light" value="{{ $classRoom->name }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Ngành học</label>
                    <input type="text" class="form-control bg-light"
                        value="{{ $classRoom->major->name ?? 'Chưa có ngành' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Khoa</label>
                    <input type="text" class="form-control bg-light"
                        value="{{ $classRoom->major->faculty->name ?? 'Chưa có khoa' }}" readonly>
                </div>

                <div class="col-12">
                    <label class="form-label">Mô tả lớp học</label>
                    <textarea class="form-control bg-light" rows="3"
                        readonly>{{ $classRoom->description ?? 'Không có mô tả' }}</textarea>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white border-0 text-end py-3 px-4">
            <a href="{{ route('student.profile') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Quay lại hồ sơ
            </a>
        </div>
    </div>
    @endif
</div>
@endsection
