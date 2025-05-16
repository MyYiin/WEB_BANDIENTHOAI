<?php
    session_start();
   include("user/includes/connect.php");
   
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        //Lấy thông tin từ form
        $name = $_POST["username"];
        $pass = $_POST["password"];

        if(trim($name) == "")
            echo "<script>alert('Tên đăng nhập không được bỏ trống');</script>";
        else if (trim($pass) == "")
            echo "<script>alert('Mật khẩu không được bỏ trống');</script>";
        else
        {
            $pass = md5($pass);

            $sql_exist = "select * from tbl_nguoidung where TenDangNhap ='$name' and MatKhau ='$pass'";

            $res = $connect->query($sql_exist);

            if(!$res){
                die("Không thể thực hiện câu lệnh SQL". $connect->connect_error);
                exit();
            }

            // Lấy dòng đầu tiên kiểm tra hợp lệ
            $dong = $res->fetch_array(MYSQLI_ASSOC);
        
            if($dong)
            {
                if($dong['Khoa'] == 0 )
                {
                    //Đăng ký sesion cho phiên dăng nhập
                    $_SESSION["MaND"] = $dong["MaNguoiDung"];
                    $_SESSION["HoTen"] = $dong["TenNguoiDung"];
                    $_SESSION["QuyenHan"] = $dong["QuyenHan"];
                    
                    if($_SESSION['QuyenHan'] == 1){
                        header("Location: admin/pages/index.php");
                        exit();
                    }
                    else{
                        header("Location: index.php");
                        exit();
                    }
                    if (isset($_GET['msg']) && $_GET['msg'] === 'must_login_to_buy') {
                        echo "<div class='alert alert-warning'>Vui lòng đăng nhập để mua hàng.</div>";
                    }           
                }
                else
                {
                echo "<script>alert('Người dùng đã bị khóa tài khoản'); window.location.href='dangnhap.php';</script>";
                }
            }
        }
    }
?>