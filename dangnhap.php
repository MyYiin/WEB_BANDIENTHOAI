<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập | MobileZone</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- Font Awesome for icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <!-- custom css -->
  <link rel="stylesheet" href="user/CSS/dangnhap.css">
</head>
<body>
    <div class="card">
        <!-- Thêm logo nếu có -->
        <img src="user/images/logo.jpg" alt="MobileZone Logo" class="brand-logo">

        <h2>Đăng nhập</h2>
        <form action="xulydangnhap.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập</label>

                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
                </div>

            </div>

            <div class="mb-3">

                <label for="password" class="form-label">Mật khẩu</label>

                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>

            </div>


            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </div>

        </form>

            <div class="register-link mt-3"> Bạn chưa có tài khoản? <a href="dangky.php">Đăng ký</a></div>
            
    </div>

  <!-- Bootstrap JS (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
