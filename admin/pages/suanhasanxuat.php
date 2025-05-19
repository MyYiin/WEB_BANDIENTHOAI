<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Sửa nhà sản xuất</title>
	
</head>

<style>
    body {
  background-color: #f7f9fc; /* nền trắng/xám nhạt */
  color: #0d3b66; /* xanh dương đậm cho chữ */
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  padding: 30px 15px;
}

.form-wrapper {
  max-width: 600px;
  margin: 0 auto;
  background: #fff; /* nền trắng */
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 3px 8px rgb(0 0 0 / 0.1);
}

.form-title {
  color: #0d3b66; /* chữ xanh đậm */
  font-weight: 700;
  margin-bottom: 25px;
  text-align: center;
  font-size: 1.8rem;
}

.requirefield {
  color: #d32f2f; /* đỏ nhẹ */
  margin-left: 3px;
}

.note {
  font-size: 0.9rem;
  color: #d32f2f;
  margin-bottom: 15px;
  text-align: center;
}

.btn-primary {
  background-color: #1976d2; /* xanh dương đậm */
  border: none;
  font-weight: 600;
  padding: 10px 30px;
  border-radius: 8px;
  transition: background-color 0.3s ease;
  color: #fff;
}

.btn-primary:hover {
  background-color: #e07b39; /* cam nhẹ khi hover */
  color: #fff;
}

.form-check-label {
  user-select: none;
  margin-left: 0.3rem;
}

</style>
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
