<?php
	include("../includes/connect.php"); 

	// Truy vấn sản phẩm	
	$sql = "select t.IdSanPham, t.TenSanPham, t.IdNhaSanXuat, t.HinhAnh, t.DonGia, t.SoLuong, t.MoTa, t.CauHinh, t.TiLeGiamGia, t.LuotXem, l.IdNhaSanXuat, l.TenNhaSanXuat
  	from (tbl_nhasanxuat l inner join tbl_sanpham t on t.IdNhaSanXuat=l.IdNhaSanXuat)";
  		
	$danhsach = $connect->query($sql); 

	if (!$danhsach) { 
		die("Không thể thực hiện câu lệnh SQL: ". $connect->error); 
	}
?>
<link rel="stylesheet" type="text/css" href="../CSS/dssanpham.css">

<table class="List">
	<tr><td colspan="12" class="tieude1">Danh sách sản phẩm</td></tr>	
	<tr>
		<th>Mã sản phẩm</th>
		<th>Tên sản phẩm</th>
		<th>Nhà sản xuất</th>
		<th>Đơn giá</th>
		<th>Số lượng</th>
		<th>Hình ảnh</th>
		<th>Tỉ lệ giảm giá</th>
		<th>Mô tả</th>
		<th>Cấu hình</th>
		<th>Lượt xem</th>
		<th>Sửa</th>
        <th>Xóa</th>
	</tr>

	<?php	
	if ($danhsach->num_rows > 0) {
		while ($row = $danhsach->fetch_array(MYSQLI_ASSOC)) { 
			echo "<tr>"; 
			echo "<td>" . $row['IdSanPham'] . "</td>"; 
			echo "<td>" . htmlspecialchars($row['TenSanPham']) . "</td>"; 
			echo "<td>" . htmlspecialchars($row['TenNhaSanXuat']) . "</td>"; 
			echo "<td>" . $row['DonGia'] . "</td>"; 
			echo "<td>" . $row['SoLuong'] . "</td>"; 
			echo "<td><img src='../../images/" . htmlspecialchars($row['HinhAnh']) . "' alt='" . htmlspecialchars($row['TenSanPham']) . "' width='100' height='100'/></td>";
			echo "<td>" . $row['TiLeGiamGia'] . "</td>"; 
			echo "<td>" . htmlspecialchars($row['MoTa']) . "</td>";
			echo "<td>" . htmlspecialchars($row['CauHinh']) . "</td>";
			echo "<td>" . $row['LuotXem'] . "</td>";
			echo "<td><a href='suasanpham.php?id=" . $row['IdSanPham'] . "'><img src='../../images/edit.png' alt='Sửa' title='Sửa'/></a></td>"; 
			echo "<td><a href='xoasanpham.php?id=" . $row['IdSanPham'] . "' onclick=\"return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');\"><img src='../../images/delete.png' alt='Xóa' title='Xóa'/></a></td>"; 
			echo "</tr>"; 
		}
	} else {
		echo "<tr><td colspan='12'>Không có sản phẩm nào.</td></tr>";
	}

	$connect->close();
	?>
</table>
<!-- <a href="themsanpham.php" class="add-button" >+ Thêm sản phẩm</a> -->
