@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 fw-bold text-primary">Chi tiết ngành học</h5>
                </div>
                <div class="card-body p-4">
                    <p><strong>Tên ngành:</strong> {{ $major->name }}</p>
                    <p><strong>Thuộc khoa:</strong> {{ $major->faculty?->name ?? 'Chưa cập nhật' }}</p>
                    
                    <hr class="my-3">
                    
                    <p><strong>Danh sách các lớp thuộc ngành:</strong></p>
                    <ul class="mb-4">
                        @forelse($major->classRooms as $classRoom)
                            <li>{{ $classRoom->name }}</li>
                        @empty
                            <li class="text-muted">Chưa có lớp học nào thuộc ngành này.</li>
                        @endforelse
                    </ul>

                    <div class="form-actions">
                        <a href="{{ route('admin.majors.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection