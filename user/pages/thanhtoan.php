<?php
    require_once '../includes/connect.php';
    session_start();

    if(empty($_SESSION['cart'])){
        header("Location: giohang.php");
        exit();
    }

    // Kiểm tra người dùng đã đăng nhập chưa
    if(!isset($_SESSION['MaND'])){
        // Chuyển hướng hoặc thông báo lỗi
        die("Bạn cần đăng nhập để đặt hàng.");
    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $hoten = $_POST['hoten'] ?? '';
        $diachi = $_POST['diachi'] ?? '';
        $sdt = $_POST['sdt'] ?? '';
        $tongtien = 0;

    // Bắt đầu transaction
    $connect->begin_transaction();

    try {
        // Tính tổng tiền
        foreach($_SESSION['cart'] as $id => $soluong){
           $stmt = $connect->prepare("SELECT DonGia FROM tbl_sanpham WHERE IdSanPham = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($dongia);
            if($stmt->fetch()){
                $dg = $dongia;
            } else {
                throw new Exception("Sản phẩm ID $id không tồn tại");
            }
            $stmt->close();
        }

        // Thêm đơn hàng
        $stmt = $connect->prepare("INSERT INTO tbl_donhang (MaND, NgayDat, HoTen, DiaChi, SDT, TongTien) VALUES (?, NOW(), ?, ?, ?, ?)");
        $stmt->bind_param('isssd', $_SESSION['MaND'], $hoten, $diachi, $sdt, $tongtien);
        $stmt->execute();

        $MaDon = $stmt->insert_id;

        // Thêm chi tiết đơn hàng
        foreach($_SESSION['cart'] as $id => $soluong){
            $stmt = $connect->prepare("SELECT DonGia FROM tbl_sanpham WHERE IdSanPham = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $sp =  $stmt->get_result()->fetch_assoc();
            $dongia = $sp['DonGia'];

            $stmt2 = $connect->prepare("INSERT INTO tbl_chitietdonhang (IdDonHang, IdSanPham, SoLuong, DonGia) VALUES (?, ?, ?, ?)");
            $stmt2->bind_param("iiid", $MaDon, $id, $soluong, $dongia);
            $stmt2->execute();
        }

        // Commit nếu tất cả ok
        $connect->commit();

        // Xoá giỏ hàng
        unset($_SESSION['cart']);

        header("Location: camon.php");
        exit();

    } catch (Exception $e) {
        $connect->rollback();
        die("Đặt hàng thất bại: " . $e->getMessage());
    }
}
?>


<!-- HTML form -->
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