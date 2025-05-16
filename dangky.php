<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký | MobileZone</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="user/CSS/dangky.css">
    
</head>
<body>
    <div class="card">
        <img src="user/images/logo.jpg" alt="MobileZone Logo" class="brand-logo">

        <h2>Đăng ký</h2>
        <form action="xulydangky.php" method="POST">

            <div class="mb-3">
                <label for="tennguoidung" class="form-label">Họ và tên</label>

                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                    <input type="text" class="form-control" id="tennguoidung" name="tennguoidung" placeholder="Nhập họ và tên" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập</label>

                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Tạo tên đăng nhập" required>
                </div>

            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>

                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Tạo mật khẩu" required>
                </div>

            </div>

            <div class="mb-3">
                <label for="confirm-password" class="form-label">Nhập lại mật khẩu</label>

                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-check-double"></i></span>
                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Xác nhận lại mật khẩu" required>
                </div>
                
            </div>


        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </div>
        </form>

        <div class="login-link mt-3">
        Đã có tài khoản? <a href="dangnhap.php">Đăng nhập ngay</a>
        </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
