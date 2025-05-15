<?php
	include("../includes/connect.php"); 

	$sql = "SELECT * FROM tbl_nhasanxuat"; 
	$danhsach = $connect->query($sql); 

	if (!$danhsach) { 
		die("Không thể thực hiện câu lệnh SQL: ". $connect->error); 
	}
?>
<link rel="stylesheet" type="text/css" href="../CSS/dsNSX.css">

<table class="List">
	<tr><td colspan="8" class="tieude1">Danh sách nhà sản xuất</td></tr>	
	<tr>
		<th>Mã NSX</th>
		<th>Tên nhà sản xuất</th>
	</tr>

	<?php	
	if ($danhsach->num_rows > 0) {
		while ($row = $danhsach->fetch_array(MYSQLI_ASSOC)) { 
			echo "<tr>"; 
			echo "<td>" . $row['IdNhaSanXuat'] . "</td>"; 
			echo "<td>" . htmlspecialchars($row['TenNhaSanXuat']) . "</td>"; 
			echo "</tr>"; 
		}
	} else {
		echo "<tr><td colspan='8'>Không có nhà sản xuất nào.</td></tr>";
	}

	$connect->close();
	?>
</table>
<!-- <a href="themNSX.php" class="add-button" >+ Thêm nhà sản xuất</a> -->
