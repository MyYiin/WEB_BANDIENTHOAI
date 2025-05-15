<?php
    include("../includes/connect.php");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = intval($_POST['MaNguoiDung']);
        $hoten = trim($_POST['TenNguoiDung']);
        $tendn = trim($_POST['TenDangNhap']);
        $matkhau = trim($_POST['MatKhau']);
        $quyen = intval($_POST['QuyenHan']);

        $sql = "UPDATE tbl_nguoidung SET 
                TenNguoiDung = ?, 
                TenDangNhap = ?, 
                MatKhau = ?, 
                QuyenHan = ?
                WHERE MaNguoiDung = ?";

        $stmt = $connect->prepare($sql);
        $stmt->bind_param("sssii", $hoten, $tendn, $matkhau, $quyen, $id);

        if ($stmt->execute()) {
            header("Location: dsnguoidung.php");
            exit();
        } else {
            echo "Lỗi cập nhật: " . $stmt->error;
        }
    }
?>
