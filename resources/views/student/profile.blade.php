@extends('layouts.app')

@section('content')
<div class="mx-auto" style="max-width: 720px;">
    <h1 class="h4 page-title mb-3">Hồ sơ cá nhân Sinh viên</h1>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <dl class="row mb-0 gy-2">
                <dt class="col-sm-4 text-secondary fw-semibold">Mã sinh viên</dt>
                <dd class="col-sm-8 mb-0">{{ $student->student_code }}</dd>

                <dt class="col-sm-4 text-secondary fw-semibold">Họ và tên</dt>
                <dd class="col-sm-8 mb-0">{{ $student->full_name }}</dd>

                <dt class="col-sm-4 text-secondary fw-semibold">Ngày sinh</dt>
                <dd class="col-sm-8 mb-0">{{ $student->dob?->format('d/m/Y') }}</dd>

                <dt class="col-sm-4 text-secondary fw-semibold">Giới tính</dt>
                <dd class="col-sm-8 mb-0">{{ $student->gender }}</dd>

                <dt class="col-sm-4 text-secondary fw-semibold">Địa chỉ</dt>
                <dd class="col-sm-8 mb-0">{{ $student->address ?? 'Chưa cập nhật' }}</dd>

                <dt class="col-sm-4 text-secondary fw-semibold">Lớp sinh hoạt</dt>
                <dd class="col-sm-8 mb-0">{{ $student->classRoom?->name ?? 'Chưa xếp lớp' }}</dd>

                <dt class="col-sm-4 text-secondary fw-semibold">Ngành học</dt>
                <dd class="col-sm-8 mb-0">{{ $student->classRoom?->major?->name ?? 'N/A' }}</dd>

                <dt class="col-sm-4 text-secondary fw-semibold">Khoa quản lý</dt>
                <dd class="col-sm-8 mb-0">{{ $student->classRoom?->major?->faculty?->name ?? 'N/A' }}</dd>
            </dl>

            <form method="POST" action="{{ route('logout') }}" class="d-flex justify-content-end mt-4">
                @csrf
                <button type="submit" class="btn btn-outline-secondary">Đăng xuất</button>
            </form>
        </div>
    </div>
</div>
@endsection
