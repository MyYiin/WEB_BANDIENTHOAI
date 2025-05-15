<?php
	include("../includes/connect.php");

	// Lấy và ép kiểu ID
	$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

	if ($id <= 0) {
		echo "ID sản phẩm không hợp lệ.";
		exit;
	}

	// Dùng prepared statement để tránh lỗi và an toàn
	$sql = "DELETE FROM tbl_sanpham WHERE IdSanPham = ?";
	$stmt = $connect->prepare($sql);
	$stmt->bind_param("i", $id);

	if ($stmt->execute()) {
		header("Location: dssanpham.php");
		exit;
	} else {
		echo "Lỗi: " . $stmt->error;
	}

	$stmt->close();
	$connect->close();
?>
