```html
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Lỗi hệ thống</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container min-vh-100 d-flex
                justify-content-center align-items-center">
        <div class="card shadow text-center p-5"
             style="max-width: 550px; width: 100%;">

            <h1 class="display-1 fw-bold text-danger">500</h1>

            <h2 class="mb-3">Lỗi hệ thống</h2>

            <p class="text-secondary">
                Đã xảy ra lỗi trong quá trình xử lý yêu cầu.
                Vui lòng thử lại sau.
            </p>

            <a href="{{ url('/') }}" class="btn btn-primary mt-3">
                Quay về trang chủ
            </a>

        </div>
    </div>

</body>
</html>
```
