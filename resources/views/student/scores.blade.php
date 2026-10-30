<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả học tập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0 text-center">KẾT QUẢ HỌC TẬP</h4>
            </div>

            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle">

                        <thead class="table-primary">
                            <tr>
                                <th>STT</th>
                                <th>Tên môn học</th>
                                <th>Số tín chỉ</th>
                                <th>Điểm</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($scores as $score)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $score->subject->name ?? 'Chưa có tên môn' }}</td>
                                    <td>{{ $score->subject->credits ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-success fs-6">
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

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
