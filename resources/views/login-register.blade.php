<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Travel Tour</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/images/logo/logo1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="content2 active" id="signupForm">
        <div class="SignUp-Form">
            <img src="{{ asset('frontend/assets/images/logo/logo1.png') }}" alt="Logo" class="logo" width="220px" height="180px">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <input type="text" id="ho_ten" name="ho_ten" placeholder="Họ và tên" required="">
                <input type="text" id="so_dien_thoai" name="so_dien_thoai" placeholder="Số điện thoại" required="">
                <input type="email" id="email" name="email" placeholder="Email" required="">
                <input type="text" id="tai_khoan" name="tai_khoan" placeholder="Tài khoản" required="">
                <input type="password" id="mat_khau" name="mat_khau" placeholder="Mật khẩu" required="">
                <input type="submit" class="register" value="Đăng Ký">
            </form>
            <p class="SignIn">Bạn đã có tài khoản? <a href="#" id="signInLink">Đăng Nhập</a></p>
        </div>
    </div>

    <div class="content1" id="loginForm">
        <div class="SignIn-Form">
            <img src="{{ asset('frontend/assets/images/logo/logo1.png') }}" alt="Logo" class="logo" width="220px" height="180px">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <input type="text" id="tai_khoan" name="tai_khoan" placeholder="Tài khoản" required="">
                <input type="password" id="mat_khau" name="mat_khau" placeholder="Mật khẩu" required="">
                <input type="submit" class="login" value="Đăng Nhập">
            </form>
            <h1 class="or">------------------------ HOẶC ------------------------</h1>
            <div class="image-container">
                <a href="{{ url('auth/google') }}" class="btn btn-google"><img src="./frontend/assets/images/icon/gmail-icon.png" id="gmail"></a>
            </div>
            <p class="SignUp">Bạn chưa có tài khoản? <a href="#" id="registerLink">Đăng ký</a></p>
        </div>
    </div>
</body>
</html>
