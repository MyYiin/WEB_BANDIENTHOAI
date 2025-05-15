<?php
include("../includes/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $TenNguoiDung = trim($_POST['TenNguoiDung']);
    $TenDangNhap = trim($_POST['TenDangNhap']);
    $MatKhau = $_POST['MatKhau'];
    $MatKhau2 = $_POST['MatKhau2'];
    $QuyenHan = (int)$_POST['QuyenHan'];
    $Khoa = isset($_POST['Khoa']) ? (int)$_POST['Khoa'] : 0;

    // Kiểm tra mật khẩu nhập lại
    if ($MatKhau !== $MatKhau2) {
        die("Mật khẩu không khớp.");
    }

    // Mã hóa mật khẩu
    $hashedPassword = md5($MatKhau); // ❗Cân nhắc dùng password_hash() nếu bảo mật cao hơn

    // Kiểm tra tên đăng nhập đã tồn tại
    $check = $connect->query("SELECT * FROM tbl_nguoidung WHERE TenDangNhap = '$TenDangNhap'");
    if ($check->num_rows > 0) {
        die("Tên đăng nhập đã tồn tại.");
    }

    // Thêm người dùng
    $sql = "INSERT INTO tbl_nguoidung (TenNguoiDung, TenDangNhap, MatKhau, QuyenHan, Khoa) 
            VALUES ('$TenNguoiDung', '$TenDangNhap', '$hashedPassword', $QuyenHan, $Khoa)";
    $result = $connect->query($sql);

    if ($result) {
        header("Location: nguoidung.php");
        exit();
    } else {
        die("Lỗi thêm người dùng: " . $connect->error);
    }
}
?>
