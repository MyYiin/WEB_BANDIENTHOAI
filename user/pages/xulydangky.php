<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<script>alert('Không được truy cập trực tiếp'); window.location.href='dangky.php';</script>";
    exit();
}
    include("../includes/connect.php");

        $tennd = $_POST['tennguoidung'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm-password'];

    if(trim($tennd) == "")
       echo "<script>alert('Họ và tên không được bỏ trống'); window.history.back();</script>";
    else  if(trim($username) == "")
        echo"<script>alert('Tên đăng nhập không được bỏ trống');window.history.back();</script>";
    else  if(trim($password) == "")
        echo"<script>alert('Mật khẩu không được bỏ trống');window.history.back();</script>";
    else  if(trim($confirm) == "")
        echo"<script>alert('Ô này không được bỏ trống');window.history.back();</script>";
    else{
        $sql_check = "select * from tbl_nguoidung where TenDangNhap = '$username'";

        $danhsach = $connect->query($sql_check);

        if($danhsach && $danhsach->num_rows > 0)
        {
            echo "<script>alert('Tên đăng nhập đã tồn tại'); window.history.back();</script>";
            exit();
        }         

        if($password != $confirm){
            echo "<script>alert('Họ và tên không được bỏ trống'); window.history.back();</script>";
            exit();
        }
        $password = md5($password);

      $sql_add = "INSERT INTO `tbl_nguoidung` (`TenNguoiDung`, `TenDangNhap`, `MatKhau`, `QuyenHan`, `Khoa`)
                  VALUES ('$tennd', '$username', '$password', 1, 0)";

        $add_user = $connect->query($sql_add);

        if($add_user){
            echo "<script>alert('Đăng ký thành công'); window.location.href='../../dangnhap.php';</script>";
            exit();
        } else {
          $errorMsg = "Lỗi khi đăng ký: " . $connect->error;
                    echo "<script>alert(" . json_encode($errorMsg) . "); window.history.back();</script>";
            exit();
        }
    }
?>