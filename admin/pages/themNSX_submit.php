<?php
	include("../includes/connect.php");
    // Kiểm tra kết nối
	$TenNhaSanXuat = trim($_POST['TenNhaSanXuat']);
    if ($TenNhaSanXuat == "") {
        echo "Tên nhà sản xuất không được bỏ trống!";
    } else {
        // Dùng prepared statement để bảo vệ an toàn
        $sql = "INSERT INTO tbl_nhasanxuat (TenNhaSanXuat)
                VALUES (?)";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $TenNhaSanXuat);

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
