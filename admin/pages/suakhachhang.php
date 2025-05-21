<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sửa thông tin khách hàng</title>
  <!-- Bootstrap CSS -->
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

<?php  
  include("../includes/connect.php");

  $bien = isset($_GET['id']) ? (int)$_GET['id'] : 0;

  // Dùng prepared statement để tăng bảo mật
  $stmt = $connect->prepare("SELECT * FROM tbl_khachhang WHERE MaKH = ?");
  $stmt->bind_param("i", $bien);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 0) {
    echo "<p class='text-center text-danger'>Không tìm thấy khách hàng.</p>";
    exit;
  }

  $row = $result->fetch_array(MYSQLI_ASSOC); 
?>

<div class="form-wrapper shadow-sm">
  <h2 class="form-title">Cập nhật thông tin khách hàng</h2>

  <form action="suakhachhang_submit.php" method="post" novalidate>
    <input type="hidden" name="MaKH" value="<?php echo $row['MaKH']; ?>" />

    <div class="mb-4">
      <label for="HoTen" class="form-label">Họ và tên <span class="requirefield">*</span></label>
      <input
        type="text"
        id="HoTen"
        name="HoTen"
        class="form-control"
        value="<?php echo htmlspecialchars($row['HoVaTen']); ?>"
        required
        placeholder="Nhập họ và tên"
        maxlength="100"
      />
      <div class="invalid-feedback">
        Vui lòng nhập họ và tên.
      </div>
    </div>

    <div class="mb-4">
      <label for="NamSinh" class="form-label">Năm sinh (YYYY) <span class="requirefield">*</span></label>
      <input
        type="number"
        id="NamSinh"
        name="NamSinh"
        class="form-control"
        value="<?php echo htmlspecialchars($row['NamSinh']); ?>"
        required
        min="1900" max="<?php echo date('Y'); ?>"
        placeholder="Ví dụ: 1985"
      />
      <div class="invalid-feedback">
        Vui lòng nhập năm sinh hợp lệ.
      </div>
    </div>

    <fieldset class="mb-4">
      <legend class="form-label mb-2">Giới tính</legend>
      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="radio"
          name="GioiTinh"
          id="nam"
          value="0"
          <?php if($row['GioiTinh'] == 0) echo 'checked'; ?>
          required
        />
        <label class="form-check-label" for="nam">Nam</label>
      </div>
      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="radio"
          name="GioiTinh"
          id="nu"
          value="1"
          <?php if($row['GioiTinh'] == 1) echo 'checked'; ?>
          required
        />
        <label class="form-check-label" for="nu">Nữ</label>
      </div>
      <div class="invalid-feedback d-block">
        Vui lòng chọn giới tính.
      </div>
    </fieldset>

    <div class="mb-4">
      <label for="SoDienThoai" class="form-label">Số Điện Thoại <span class="requirefield">*</span></label>
      <input
        type="tel"
        id="SoDienThoai"
        name="SoDienThoai"
        class="form-control"
        value="<?php echo htmlspecialchars($row['SoDienThoai']); ?>"
        required
        pattern="0[0-9]{9,10}"
        placeholder="Ví dụ: 0912345678"
      />
      <div class="form-text">Bắt đầu bằng 0, 10-11 số.</div>
      <div class="invalid-feedback">
        Vui lòng nhập số điện thoại hợp lệ.
      </div>
    </div>

    <div class="mb-4">
      <label for="DiaChi" class="form-label">Địa chỉ</label>
      <input
        type="text"
        id="DiaChi"
        name="DiaChi"
        class="form-control"
        value="<?php echo htmlspecialchars($row['DiaChi']); ?>"
        placeholder="Nhập địa chỉ (không bắt buộc)"
      />
    </div>

    <div class="text-center">
      <div class="note">(*) Các trường bắt buộc nhập thông tin.</div>
      <button type="submit" class="btn btn-primary">Cập nhật</button>
    </div>
  </form>
</div>

<!-- Bootstrap JS + Validation script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Bootstrap validation example
  (() => {
    'use strict';
    const forms = document.querySelectorAll('form');

    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add('was-validated');
      }, false);
    });
  })();
</script>

</body>
</html>
