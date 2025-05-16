<?php
    include("../includes/connect.php");
    // Kiểm tra xem có dữ liệu được gửi từ form không

	$idNSX =  $_POST['IdNhaSanXuat'];
    $TenNSX = trim($_POST['TenNhaSanXuat']);	

	if ($TenNSX == "")
		echo "Tên nhà sản xuất không được bỏ trống!";
	else {
		// Dùng prepared statement để tránh SQL injection
		$sql = "UPDATE tbl_nhasanxuat SET TenNhaSanXuat = ? WHERE IdNhaSanXuat = ?";
		$stmt = $connect->prepare($sql);
		$stmt->bind_param("si", $TenNSX, $idNSX);

		if ($stmt->execute()) {
			header("Location: dsnhasanxuat.php");
			exit;
		} else {
			echo "Lỗi: " . $stmt->error;
		}
		$stmt->close();
		$connect->close();
	}
?>
