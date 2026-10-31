<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{ route('login') }}">
    @csrf
    <input name="email" value="{{ old('email') }}" placeholder="Email đăng nhập">
    <input name="password" type="password" placeholder="Mật khẩu">
    <button type="submit">Đăng nhập</button>
    @error('email') <p>{{ $message }}</p> @enderror
</form>
</body>
</html>