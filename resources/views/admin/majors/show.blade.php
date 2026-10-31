@extends('layouts.app')

@section('content')
<x-form-card title="Chi tiết ngành học">
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
</x-form-card>
@endsection