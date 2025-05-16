<?php
    session_start();
    // include("connect.php");

    //Lấy thông tin từ form
    $name = $_POST["username"];
    $pass = $_POST["password"];

    if(trim($name) == "")
        ThongBaoLoi("Tên đăng nhập không được bỏ trống");
    else if (trim($pass) == "")
        ThongBaoLoi("Mật khẩu không được bỏ trống");
    else
    {
        $pass = md5($pass);

        $sql_exist = "select * from tbl_nguoidung where name ='$TenDangNhap' and pass ='$MatKhau'";

        $res = $connect->query($sql_exist);

        if(!$res){
            die("Không thể thực hiện câu lệnh SQL", $connect->connection_error);
            exit();
        }

        // Lấy dòng đầu tiên kiểm tra hợp lệ
        $dong = $res->fetch_array(MYSQLI_ASSOC);
    
        if($dong){
            if($dong['Khoa'] == 0 ){
                //Đăng ký sesion cho phiên dăng nhập
                $_SESSION["MaND"] = $dong["MaNguoiDung"];
                $_SESSION["HoTen"] = $dong["TenNguoiDung"];
                $_SESSION["QuyenHan"] = $dong["QuyenHan"];

                if($_SESSION["QuyenHan"] == "admin")
                    header("Location: ../admin/pages/index.php");
                else
                    header("Location: ../user/pages/index.php");
            }
            else{
                 echo "<script>alert('Người dùng đã bị khóa tài khoản');</script>";
            }
        }else
        {
             echo "<script>alert('Tên đăng nhập hoặc mật khẩu không chính xác');</script>";
        }
    }
?>