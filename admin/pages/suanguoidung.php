<?php
    include("../includes/connect.php");

    // Lấy ID người dùng cần sửa, ép kiểu int tránh SQL Injection
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Dùng prepared statement an toàn hơn
    $stmt = $connect->prepare("SELECT * FROM tbl_nguoidung WHERE MaNguoiDung = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result || $result->num_rows == 0) {
        die("<p class='text-center text-danger mt-5'>Không tìm thấy người dùng.</p>");
    }

    $nguoidung = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sửa người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
       body {
  background-color: #f7f9fc;
  color: #0d3b66; 
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  padding: 30px 15px;
}

.form-wrapper {
  max-width: 600px;
  margin: 0 auto;
  background: #fff; 
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 3px 8px rgb(0 0 0 / 0.1);
}

.form-title {
  color: #0d3b66; 
  font-weight: 700;
  margin-bottom: 25px;
  text-align: center;
  font-size: 1.8rem;
}

.requirefield {
  color: #d32f2f;
  margin-left: 3px;
}

.note {
  font-size: 0.9rem;
  color: #d32f2f;
  margin-bottom: 15px;
  text-align: center;
}

.btn-primary {
  background-color: #1976d2; 
  border: none;
  font-weight: 600;
  padding: 10px 30px;
  border-radius: 8px;
  transition: background-color 0.3s ease;
  color: #fff;
}

.btn-primary:hover {
  background-color: #e07b39;
  color: #fff;
}

.form-check-label {
  user-select: none;
  margin-left: 0.3rem;
}

    </style>
</head>
<body>

<div class="form-wrapper shadow-sm">
    <h2 class="form-title">Sửa thông tin người dùng</h2>

    <form action="suanguoidung_submit.php" method="post" novalidate>
        <input type="hidden" name="MaNguoiDung" value="<?= htmlspecialchars($nguoidung['MaNguoiDung']) ?>" />

        <div class="mb-4">
            <label for="TenNguoiDung" class="form-label">Họ và tên <span class="requirefield">*</span></label>
            <input 
                type="text" 
                id="TenNguoiDung" 
                name="TenNguoiDung" 
                class="form-control" 
                value="<?= htmlspecialchars($nguoidung['TenNguoiDung']) ?>" 
                required
                maxlength="100"
                placeholder="Nhập họ và tên"
            />
            <div class="invalid-feedback">Vui lòng nhập họ và tên.</div>
        </div>

        <div class="mb-4">
            <label for="TenDangNhap" class="form-label">Tên đăng nhập <span class="requirefield">*</span></label>
            <input 
                type="text" 
                id="TenDangNhap" 
                name="TenDangNhap" 
                class="form-control" 
                value="<?= htmlspecialchars($nguoidung['TenDangNhap']) ?>" 
                required
                maxlength="50"
                placeholder="Nhập tên đăng nhập"
            />
            <div class="invalid-feedback">Vui lòng nhập tên đăng nhập.</div>
        </div>

        <div class="mb-4">
            <label for="QuyenHan" class="form-label">Quyền hạn <span class="requirefield">*</span></label>
            <select name="QuyenHan" id="QuyenHan" class="form-select" required>
                <option value="">-- Chọn quyền hạn --</option>
                <option value="1" <?= $nguoidung['QuyenHan'] == 1 ? 'selected' : '' ?>>Quản trị</option>
                <option value="2" <?= $nguoidung['QuyenHan'] == 2 ? 'selected' : '' ?>>Thành viên</option>
            </select>
            <div class="invalid-feedback">Vui lòng chọn quyền hạn.</div>
        </div>

        <div class="mb-4">
            <label for="MatKhau" class="form-label">Mật khẩu <span class="requirefield">*</span></label>
            <input 
                type="password" 
                id="MatKhau" 
                name="MatKhau" 
                class="form-control" 
                value="<?= htmlspecialchars($nguoidung['MatKhau']) ?>" 
                required
                minlength="6"
                placeholder="Nhập mật khẩu mới hoặc giữ nguyên"
            />
            <div class="invalid-feedback">Vui lòng nhập mật khẩu (tối thiểu 6 ký tự).</div>
        </div>

        <div class="text-center">
            <div class="note">(*) Các trường bắt buộc nhập.</div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  (() => {
    'use strict'
    const forms = document.querySelectorAll('form')
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>

</body>
</html>
