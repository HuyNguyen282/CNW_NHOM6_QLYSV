@extends('layouts.app')

@section('title', 'Kết quả học tập')

@section('content')
<div class="mx-auto" style="max-width: 900px;">
    <h1 class="h4 page-title mb-3">KẾT QUẢ HỌC TẬP</h1>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">

                <thead class="table-light">
                    <tr>
                        <th>STT</th>
                        <th class="text-start">Tên môn học</th>
                        <th>Số tín chỉ</th>
                        <th>Điểm</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($scores as $score)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $score->subject->name ?? 'Chưa có tên môn' }}</td>
                            <td>{{ $score->subject->credits ?? '-' }}</td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold fs-6">
                                    {{ $score->score }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-muted py-4">
                                Chưa có điểm môn học nào.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
