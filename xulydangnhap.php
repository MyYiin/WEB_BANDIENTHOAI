<?php
session_start();
include("user/includes/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST["username"]);
    $pass = trim($_POST["password"]);

    if ($name == "") {
        echo "<script>alert('Tên đăng nhập không được bỏ trống');</script>";
    } else if ($pass == "") {
        echo "<script>alert('Mật khẩu không được bỏ trống');</script>";
    } else {
        $pass = md5($pass);

        // Sử dụng prepared statement để tránh SQL injection
        $stmt = $connect->prepare("SELECT * FROM tbl_nguoidung WHERE TenDangNhap = ? AND MatKhau = ?");
        $stmt->bind_param("ss", $name, $pass);
        $stmt->execute();
        $res = $stmt->get_result();

        if (!$res) {
            die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
        }

        $dong = $res->fetch_array(MYSQLI_ASSOC);
        if ($dong) {
            if ($dong['Khoa'] == 0) {
                $_SESSION["MaND"] = $dong["MaNguoiDung"];
                $_SESSION["HoTen"] = $dong["TenNguoiDung"];
                $_SESSION["QuyenHan"] = $dong["QuyenHan"];

                // Nếu có msg, lưu vào session để hiện sau
                if (isset($_GET['msg']) && $_GET['msg'] === 'must_login_to_buy') {
                    $_SESSION['alert'] = 'Vui lòng đăng nhập để mua hàng.';
                }

                if ($_SESSION['QuyenHan'] == 1) {
                    header("Location: admin/pages/index.php");
                } else {
                    header("Location: index.php");
                }
                exit();
            } else {
                echo "<script>alert('Người dùng đã bị khóa tài khoản'); window.location.href='dangnhap.php';</script>";
            }
        } else {
            echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng'); window.location.href='dangnhap.php';</script>";
        }
    }
}
?>
