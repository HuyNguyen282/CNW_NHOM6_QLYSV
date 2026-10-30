@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-mortarboard-fill me-2"></i>
            Thông tin lớp học
        </h2>
        <p class="text-muted">Thông tin lớp học của bạn</p>
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
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">
                <i class="bi bi-building me-2"></i>
                Lớp {{ $classRoom->name }}
            </h5>
        </div>

        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label text-muted">
                        Mã sinh viên
                    </label>
                    <input type="text" class="form-control" value="{{ $student->student_code }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">
                        Họ và tên
                    </label>
                    <input type="text" class="form-control" value="{{ $student->full_name }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">
                        Mã lớp
                    </label>
                    <input type="text" class="form-control" value="{{ $classRoom->id }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">
                        Tên lớp
                    </label>
                    <input type="text" class="form-control" value="{{ $classRoom->name }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">
                        Ngành học
                    </label>
                    <input type="text" class="form-control" value="{{ $classRoom->major->name ?? 'Chưa có ngành' }}"
                        readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">
                        Khoa
                    </label>
                    <input type="text" class="form-control"
                        value="{{ $classRoom->major->faculty->name ?? 'Chưa có khoa' }}" readonly>
                </div>

                <div class="col-12">
                    <label class="form-label text-muted">
                        Mô tả lớp học
                    </label>
                    <textarea class="form-control" rows="3"
                        readonly>{{ $classRoom->description ?? 'Không có mô tả' }}</textarea>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white text-end py-3">
            <a href="{{ route('student.profile') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Quay lại hồ sơ
            </a>
        </div>
    </div>
    @endif
</div>
@endsection