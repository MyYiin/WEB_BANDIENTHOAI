<?php
	session_start();
	include("../includes/connect.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../CSS/dssanpham.css">
	
</head>
<body>

<?php
	$sql_nsx = "SELECT * FROM tbl_nhasanxuat";
	$result_nsx = $connect->query($sql_nsx);

	if (!$result_nsx) {
		die("Lỗi truy vấn nhà sản xuất: " . $connect->error);
	}

	while ($nsx = $result_nsx->fetch_assoc()) {
		$id_nsx = $nsx['IdNhaSanXuat'];
		$ten_nsx = $nsx['TenNhaSanXuat'];

		// Lấy tối đa 5 sản phẩm
		$sql_sp = "SELECT * FROM tbl_sanpham WHERE IdNhaSanXuat = $id_nsx ORDER BY LuotXem DESC LIMIT 5";
		$result_sp = $connect->query($sql_sp);

		$sql_count = "SELECT COUNT(*) AS total FROM tbl_sanpham WHERE IdNhaSanXuat = $id_nsx";
		$total_sp = $connect->query($sql_count)->fetch_assoc()['total'];

		echo "<div class='nhasanxuat-block'>";
		echo "<div class='tennsx'>" . htmlspecialchars($ten_nsx) . "</div>";
		echo "<div class='hangsanpham'>";

		while ($sp = $result_sp->fetch_assoc()) {
			$giaban = $sp['DonGia'] - (($sp['TiLeGiamGia'] / 100) * $sp['DonGia']);
			echo "<div class='khungsanpham'>";
			echo "<a href='sanpham_chitiet.php?id_sp=" . $sp['IdSanPham'] . "&id_nsx=" . $sp['IdNhaSanXuat'] . "'>";
			echo "<img src='../images/" . htmlspecialchars($sp['HinhAnh']) . "' alt='" . htmlspecialchars($sp['TenSanPham']) . "'>";
			echo "<div class='card'>";
			echo "<div class='tendienthoai'>" . htmlspecialchars($sp['TenSanPham']) . "</div>";
			echo "<div class='giaban'>" . number_format($giaban) . " đ</div>";
			echo "<div class='dongia'>" . number_format($sp['DonGia']) . " đ</div>";
			echo "<div class='luotxem'>" . $sp['LuotXem'] . " lượt xem</div>";
			echo "</div></a></div>";
		}

		echo "</div>";
		if ($total_sp > 5) {
			echo "<div class='xemthem-nsx'><a href='sanpham_theonsx.php?id_nsx=$id_nsx'>Xem thêm sản phẩm của $ten_nsx...</a></div>";
		}
		echo "</div>";
	}

	$connect->close();
?>

</body>
</html>
