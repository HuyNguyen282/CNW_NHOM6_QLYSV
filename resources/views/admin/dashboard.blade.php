@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .stat-label {
        font-size: 11px;
        letter-spacing: 0.5px;
    }
    .card {
        border-radius: 16px !important;
        border: 1px solid rgba(0, 0, 0, 0.04) !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03) !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.06) !important;
    }
    .progress {
        background-color: #f8f9fa !important;
        overflow: hidden;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
    }
    .progress-bar {
        background: linear-gradient(45deg, #198754, #20c997) !important;
    }
    .table th {
        font-weight: 600;
        color: #495057;
        background-color: #f8f9fa !important;
        border-bottom: 2px solid #dee2e6;
    }
</style>

<div class="container-fluid px-4 py-4">
  
    <div class="mb-4 text-center">
        <h1 class="h3 text-dark fw-bold mb-1">Dashboard thống kê</h1>
    </div>

   
    <div style="display: flex; flex-wrap: wrap; gap: 24px; align-items: stretch;">
        
       
        <div style="flex: 1; min-width: 350px;">
            <div class="d-flex flex-column gap-4 h-100">
                
                <!-- Thẻ tổng quan -->
                <div class="card border-0 shadow-sm rounded-4 bg-light p-3">
                    <h5 class="fw-bold text-dark mb-3 px-2">Tổng quan hệ thống</h5>
                    <div class="row g-3">
                        <div class="col-4">
                            <div class="card border-0 bg-primary text-white p-3 rounded-3 text-center">
                                <small class="text-white-50 text-uppercase fw-semibold stat-label">Sinh viên</small>
                                <h4 class="fw-bold mb-0 mt-1">{{ $stats['totalStudents'] }}</h4>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card border-0 bg-success text-white p-3 rounded-3 text-center">
                                <small class="text-white-50 text-uppercase fw-semibold stat-label">Ngành</small>
                                <h4 class="fw-bold mb-0 mt-1">{{ $stats['totalMajors'] }}</h4>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card border-0 bg-warning text-dark p-3 rounded-3 text-center">
                                <small class="text-black-50 text-uppercase fw-semibold stat-label">Môn học</small>
                                <h4 class="fw-bold mb-0 mt-1">{{ $stats['totalSubjects'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!--  điểm trung bình  -->
                <div class="card border-0 shadow-sm rounded-4 flex-grow-1">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="fw-bold text-dark m-0">Điểm trung bình theo khoa</h5>
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
                                <div class="progress" style="height: 12px; background-color: #f1f3f5; border-radius: 10px;">
                                    <div class="progress-bar bg-success rounded-pill" role="progressbar" style="width: {{ $percent }}%;"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted text-center py-3 mb-0">Chưa có dữ liệu khoa.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

        <!-- ================= NỬA BÊN PHẢI: Ô TÌM KIẾM & KẾT QUẢ TRA CỨU ================= -->
        <div style="flex: 1; min-width: 350px;">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="fw-bold text-dark m-0">🔍 Tra cứu theo ngành / lớp</h5>
                </div>
                <div class="card-body p-4 d-flex flex-column">
                    
                    <!-- Form ô tìm kiếm -->
                    <form action="{{ route('admin.dashboard') }}" method="GET" class="mb-4">
                        <div class="input-group shadow-sm">
                            <input type="text" name="keyword" value="{{ $keyword ?? '' }}" class="form-control rounded-start-pill px-3 py-2 border-secondary-subtle" placeholder="Nhập ngành/ lớp để xem điểm trung bình...">
                            <button type="submit" class="btn btn-primary px-4 fw-semibold"><i class="fas fa-search"></i> Tìm</button>
                            @if(!empty($keyword))
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-end-pill px-3 d-flex align-items-center" title="Xóa tìm kiếm"><i class="fas fa-times"></i></a>
                            @endif
                        </div>
                    </form>

                    <!-- Khu vực hiển thị kết quả tìm kiếm -->
                    @if(empty($keyword))
                        <!-- Trạng thái ban đầu khi chưa tìm kiếm -->
                        <div class="text-center text-muted my-auto py-5">
                            <div class="mb-3">
                                <i class="fas fa-search fa-3x text-black-50 opacity-50"></i>
                            </div>
                            <p class="fw-medium">Hãy nhập tên Ngành hoặc Lớp vào ô tìm kiếm để xem số liệu thống kê chi tiết.</p>
                        </div>
                    @else
                        <!-- Trạng thái sau khi đã nhập từ khóa -->
                        <div class="d-flex flex-column gap-3">
                            

                            <!-- Bảng kết quả điểm -->
                            @if($stats['avgScoreBySearchMajor']->count() > 0)
                                <div>
                                    <h6 class="fw-bold text-secondary mb-2">📚 Điểm trung bình theo ngành tìm thấy:</h6>
                                    <div class="table-responsive border rounded-3">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="table-light">
                                                <tr><th class="ps-3">Tên Ngành</th><th class="text-end pe-3">Điểm trung bình</th></tr>
                                            </thead>
                                            <tbody>
                                                @foreach($stats['avgScoreBySearchMajor'] as $major)
                                                <tr>
                                                    <td class="ps-3 fw-medium text-dark">{{ $major->name }}</td>
                                                    <td class="text-end pe-3"><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold">{{ $major->avg_score }}</span></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                       
                            @if($stats['avgScoreBySearchClass']->count() > 0)
                                <div>
                                    <h6 class="fw-bold text-secondary mb-2">🏫 Điểm trung bình theo lớp tìm thấy:</h6>
                                    <div class="table-responsive border rounded-3">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="table-light">
                                                <tr><th class="ps-3">Tên Lớp</th><th class="text-end pe-3">Điểm trung bình</th></tr>
                                            </thead>
                                            <tbody>
                                                @foreach($stats['avgScoreBySearchClass'] as $classroom)
                                                <tr>
                                                    <td class="ps-3 fw-medium text-dark">{{ $classroom->name }}</td>
                                                    <td class="text-end pe-3"><span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill fw-bold">{{ $classroom->avg_score }}</span></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            @if($stats['avgScoreBySearchMajor']->count() == 0 && $stats['avgScoreBySearchClass']->count() == 0)
                                <div class="text-center text-muted py-4">
                                    <p class="mb-0">Không tìm thấy ngành hoặc lớp nào khớp với từ khóa "<strong>{{ $keyword }}</strong>".</p>
                                </div>
                            @endif

                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>
@endsection