<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2 class="mb-4 text-primary">🔐 Thông tin thanh toán</h2>
    <form method="post" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label>Họ tên</label>
            <input type="text" name="hoten" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Địa chỉ giao hàng</label>
            <input type="text" name="diachi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Số điện thoại</label>
            <input type="text" name="sdt" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Xác nhận đặt hàng</button>
    </form>
</body>
</html>