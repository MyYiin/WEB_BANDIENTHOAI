<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Sửa nhà sản xuất</title>
	<link rel="stylesheet" type="text/css" href="../CSS/suakhachhang.css" />
</head>
<body>
<?php	
	include("../includes/connect.php");

	$bien = isset($_GET['id']) ? (int)$_GET['id'] : 0;

	// Dùng prepared statement để tăng bảo mật
	$stmt = $connect->prepare("SELECT * FROM tbl_nhasanxuat WHERE IdNhaSanXuat = ?");
	$stmt->bind_param("i", $bien);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows == 0) {
		echo "<p>Không tìm thấy nhà sản xuất.</p>";
		exit;
	}

	$row = $result->fetch_array(MYSQLI_ASSOC); 
?>

<div class="form-wrapper">
    <form action="suanhasanxuat_submit.php" method="post">
        <table class="Form">
            <tr>
                <td colspan="2" class="tieude1">Cập nhật thông tin nhà sản xuất</td>			
            </tr>		

            <input type="hidden" name="IdNhaSanXuat" value="<?php echo $row['IdNhaSanXuat']; ?>" />		

            <tr>
                <td>Tên nhà sản xuất :</td>
                <td>
                    <input type="text" name="TenNhaSanXuat" value="<?php echo htmlspecialchars($row['TenNhaSanXuat']); ?>" required />
                    <span class="requirefield">*</span>
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <div class="note">(*): Các trường bắt buộc nhập thông tin.</div>
                    <input type="submit" value="Cập nhật" />
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
