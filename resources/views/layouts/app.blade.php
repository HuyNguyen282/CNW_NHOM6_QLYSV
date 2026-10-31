<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản lý sinh viên')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-mortarboard-fill me-2"></i>
                Quản lý sinh viên
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav me-auto">

                    @if (auth()->user()->role === 'admin')

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-house-door me-1"></i> Trang chủ
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.faculties.index') }}">
                            <i class="bi bi-building me-1"></i> Khoa
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.majors.index') }}">
                            <i class="bi bi-book me-1"></i> Ngành học
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.classes.index') }}">
                            <i class="bi bi-people me-1"></i> Lớp học
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.students.index') }}">
                            <i class="bi bi-person-lines-fill me-1"></i> Sinh viên
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.subjects.index') }}">
                            <i class="bi bi-journal-bookmark me-1"></i> Môn học
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.scores.index') }}">
                            <i class="bi bi-clipboard-data me-1"></i> Điểm số
                        </a>
                    </li>

                    @elseif (auth()->user()->role === 'student')

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.profile') }}">
                            <i class="bi bi-house-door me-1"></i> Hồ sơ cá nhân
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.class') }}">
                            <i class="bi bi-people me-1"></i> Thông tin lớp học
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.scores') }}">
                            <i class="bi bi-clipboard-data me-1"></i> Điểm số
                        </a>
                    </li>

                    @endif

                </ul>

                @auth
                <div class="d-flex align-items-center gap-3">
                    <span class="text-white">
                        <i class="bi bi-person-circle me-1"></i>
                        {{ auth()->user()->name ?? auth()->user()->username }}
                    </span>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-box-arrow-right me-1"></i> Đăng xuất
                        </button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container py-4" style="max-width: 1000px;">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
