 <!DOCTYPE html>
 <html lang="vi">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>@yield('title', 'Quản lý học sinh')</title>

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
 </head>

 <body class="bg-light">

     <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
         <div class="container">
             <a class="navbar-brand" href="{{ url('/') }}">
                 Quản lý học sinh
             </a>

             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                 <span class="navbar-toggler-icon"></span>
             </button>

             <div class="collapse navbar-collapse" id="navbarMenu">
                 <ul class="navbar-nav me-auto">
                     <li class="nav-item">
                         <a class="nav-link" href="{{ route('admin.dashboard') }}">
                             Trang chủ
                         </a>
                     </li>

                     <li class="nav-item">
                         <a class="nav-link" href="{{ route('admin.classes.index') }}">
                             Lớp học
                         </a>
                     </li>

                     <li class="nav-item">
                         <a class="nav-link" href="{{ route('admin.students.index') }}">
                             Học sinh
                         </a>
                     </li>

                     <li class="nav-item">
                         <a class="nav-link" href="{{ route('admin.subjects.index') }}">
                             Môn học
                         </a>
                     </li>

                     <li class="nav-item">
                         <a class="nav-link" href="{{ route('admin.scores.index') }}">
                             Điểm số
                         </a>
                     </li>
                 </ul>
             </div>
         </div>
     </nav>

     <main class="container py-4">
         @yield('content')
     </main>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 </body>

 </html>