<?php
	include("../includes/connect.php");
	//Kiểm tra xem có tồn tại biến id không
	if(!isset($_GET['id']))
	{
		header("Location: dsnguoidung.php");
		exit();
	}
	if(isset($_GET['quyen']))
	{
		$sql = "UPDATE `tbl_nguoidung` SET `QuyenHan` = " . $_GET['quyen'] . " WHERE `MaNguoiDung` = " . $_GET['id'];
		$danhsach = $connect->query($sql);
		//Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
		if (!$danhsach) {
			die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
			exit();
		}
		
		if($danhsach)
			// header("Location: index.php?do=nguoidung");
			header("Location: dsnguoidung.php");

		else
			ThongBaoLoi(mysql_error());
	}
	elseif(isset($_GET['khoa']))
	{
		$sql = "UPDATE `tbl_nguoidung` SET `Khoa` = " . $_GET['khoa'] . " WHERE `MaNguoiDung` = " . $_GET['id'];
		$danhsach1 = $connect->query($sql);
		//Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
		if (!$danhsach1) {
			die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
			exit();
		}
		
		if($danhsach1)
			// header("Location: index.php?do=nguoidung");
			header("Location: dsnguoidung.php");
		else
			ThongBaoLoi(mysql_error());
	}
	else
	{
		// header("Location: index.php?do=nguoidung");
		header("Location: dsnguoidung.php");
	}
?>