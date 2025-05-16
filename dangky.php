<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user/CSS/dangky.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="xulydangky.php" method="post">
            <h1>Đăng ký</h1>
              <div class="tennguoidung">
                <label for="tennguoidung">Họ và tên</label>
                <input type="text" name="tennguoidung" placeholder="Họ và tên" required>
            </div>
            <div class="username">
                <label for="username">Tên đăng nhập</label>
                <input type="text" name="username" placeholder="Tên đăng nhập" required>
            </div>
            <div class="password">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password"placeholder="Mật khẩu" required>
            </div>
            <div class="confirm-password">
                <label for="confirm-password">Nhập lại mật khẩu</label>
                <input type="password" name="confirm-password"placeholder="Nhập lại mật khẩu" required>
            </div>
            <button type="submit">Đăng ký</button>
            <div class="DangNhap">
                <p>Bạn đã có tài khoản? <a href="dangnhap.php">Đăng nhập ngay</a></p>
            </div>
        </form>
    </div>
</body>
</html>