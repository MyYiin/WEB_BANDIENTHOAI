<?php
    require_once '../includes/connect.php';

    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $hoten = $_POST['hoten'] ?? '';
        $diachi = $_POST['diachi'] ?? '';
        $sdt = $_POST['sdt'] ?? '';

        $tongtien = 0;

        $themdonhang = $connect->prepare("INSERT INTO tbl_donhang (MaKH, NgayDat, NgayGiaoDuKien, DiaChiGiaoHang, TrangThai) VALUES (?, ?, ?, ? ,?)");
        $Makh = $_SESSION['MaND'];
        $ngaydat = date('Y-m-d H:i:s');
        $ngaygiaodukien = date('Y-m-d H:i:s', strtotime('+3 days'));
        $trangthai = 0;
        $themdonhang->bind_param('isssi', $Makh, $ngaydat, $ngaygiaodukien, $diachi, $trangthai);
        $themdonhang->execute();
        $IdDonHang = $connect->insert_id;
        $themdonhang->close();


        foreach($_SESSION['cart'] as $id => $soluong){

            $stmt = $connect->prepare("SELECT DonGia, SoLuong FROM tbl_sanpham WHERE IdSanPham = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $listsp = $stmt->get_result();
            $sanpham = $listsp->fetch_assoc();
            $dongia = $sanpham['DonGia'];
            $soluongton = $sanpham['SoLuong'];
            
            if($soluong > $soluongton){
                throw new Exception("Sản phẩm {$id} không đủ số lượng trong kho");
            }
            
            $capnhatkho = $connect->prepare("UPDATE tbl_sanpham SET SoLuong = SoLuong - ? WHERE IdSanPham = ?");
            $capnhatkho->bind_param('ii',$soluong, $id);
            $capnhatkho->execute();
            $capnhatkho->close();
;
            
            $themchitiet = $connect->prepare("INSERT INTO tbl_chitietdonhang (IdDonHang, IdSanPham, SoLuong, DonGia) VALUES (?, ?, ?, ?)");
            $themchitiet->bind_param('iiid', $IdDonHang, $id, $soluong, $dongia);
            $themchitiet->execute();
            $themchitiet->close();
        }

        unset($_SESSION['cart']);
        header("Location: camon.php");
        exit();
    }
?>
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