@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Tiêu đề và ô tìm kiếm tổng -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h1 class="h3 text-dark fw-bold mb-1">Dashboard Thống Kê</h1>
            <p class="text-muted mb-0">Tra cứu nhanh điểm trung bình hệ thống.</p>
        </div>
        
        <!-- Ô tìm kiếm chung-->
        <form action="{{ route('admin.dashboard') }}" method="GET" class="d-flex align-items-center" style="max-width: 350px; width: 100%;">
            <div class="input-group input-group-sm shadow-sm">
                <input type="text" name="keyword" value="{{ $keyword ?? '' }}" class="form-control rounded-start-pill px-3 border-secondary-subtle" placeholder="Nhập tên Khoa, Ngành hoặc Lớp...">
                <button type="submit" class="btn btn-primary px-3 fw-semibold"><i class="fas fa-search"></i> Tìm</button>
                @if(!empty($keyword))
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-end-pill px-2" title="Xóa tìm kiếm"><i class="fas fa-times"></i></a>
                @endif
            </div>
        </form>
    </div>

    <!-- Hàng 1: Thẻ tổng quan -->
    <div class="row g-4 mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 bg-primary text-white h-100">
                <div class="card-body p-4">
                    <h6 class="text-white-50 text-uppercase fw-semibold mb-2">Tổng số Sinh viên</h6>
                    <h2 class="fw-bold mb-0">{{ $stats['totalStudents'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 bg-success text-white h-100">
                <div class="card-body p-4">
                    <h6 class="text-white-50 text-uppercase fw-semibold mb-2">Tổng số Ngành học</h6>
                    <h2 class="fw-bold mb-0">{{ $stats['totalMajors'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 bg-warning text-dark h-100">
                <div class="card-body p-4">
                    <h6 class="text-black-50 text-uppercase fw-semibold mb-2">Tổng số Môn học</h6>
                    <h2 class="fw-bold mb-0">{{ $stats['totalSubjects'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Hàng 2: Biểu đồ thanh ngang (Khoa) -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white py-3 border-0">
            <h5 class="fw-bold text-dark m-0">📊 Biểu đồ Điểm Trung Bình Theo Khoa</h5>
        </div>
        <div class="card-body px-4 pb-4">
            @forelse($stats['avgScoreByFaculty'] as $faculty)
                @php
                    $percent = $faculty->avg_score > 0 ? ($faculty->avg_score / 10) * 100 : 0;
                @endphp
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="fw-semibold text-secondary">{{ $faculty->name }}</span>
                        <span class="fw-bold text-success">{{ $faculty->avg_score }} điểm</span>
                    </div>
                    <!-- Thanh progress bar thuần CSS -->
                    <div class="progress" style="height: 14px; background-color: #f1f3f5; border-radius: 10px;">
                        <div class="progress-bar bg-success rounded-pill" role="progressbar" style="width: {{ $percent }}%;" aria-valuenow="{{ $faculty->avg_score }}" aria-valuemin="0" aria-valuemax="10"></div>
                    </div>
                </div>
            @empty
                <p class="text-muted text-center py-3 mb-0">Không tìm thấy kết quả phù hợp với từ khóa.</p>
            @endforelse
        </div>
    </div>

    <!-- Hàng 3: Bảng Ngành và Lớp -->
    <div class="row g-4">
        <!-- Ngành -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="fw-bold text-dark m-0">📚 Điểm Trung Bình Theo Ngành</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr><th class="ps-4">Tên Ngành</th><th class="text-end pe-4">Điểm TB</th></tr>
                            </thead>
                            <tbody>
                                @forelse($stats['avgScoreByMajor'] as $major)
                                <tr>
                                    <td class="ps-4 fw-medium text-dark">{{ $major->name }}</td>
                                    <td class="text-end pe-4"><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold">{{ $major->avg_score }}</span></td>
                                </tr>
                                @empty
                                <tr><td colspan="2" class="text-center py-3 text-muted">Không tìm thấy ngành phù hợp.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lớp -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="fw-bold text-dark m-0">🏫 Điểm Trung Bình Theo Lớp</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr><th class="ps-4">Tên Lớp</th><th class="text-end pe-4">Điểm TB</th></tr>
                            </thead>
                            <tbody>
                                @forelse($stats['avgScoreByClass'] as $classroom)
                                <tr>
                                    <td class="ps-4 fw-medium text-dark">{{ $classroom->name }}</td>
                                    <td class="text-end pe-4"><span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill fw-bold">{{ $classroom->avg_score }}</span></td>
                                </tr>
                                @empty
                                <tr><td colspan="2" class="text-center py-3 text-muted">Không tìm thấy lớp phù hợp.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection