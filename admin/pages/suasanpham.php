<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Sửa thông tin sản phẩm</title>
	<link rel="stylesheet" type="text/css" href="../CSS/suasanpham.css" />
</head>
<body>
<?php	
	include("../includes/connect.php");

	$bien = isset($_GET['id']) ? (int)$_GET['id'] : 0;

	// Dùng prepared statement để tăng bảo mật
	$stmt = $connect->prepare("SELECT * FROM tbl_sanpham WHERE IdSanPham = ?");
	$stmt->bind_param("i", $bien);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows == 0) {
		echo "<p>Không tìm thấy sản phẩm.</p>";
		exit;
	}

	$row = $result->fetch_array(MYSQLI_ASSOC); 
    // Lấy danh sách nhà sản xuất
    $nsx_result = $connect->query("SELECT IdNhaSanXuat, TenNhaSanXuat FROM tbl_nhasanxuat");
?>
<div class="form-wrapper">
    <form action="suasanpham_submit.php" method="post"  enctype="multipart/form-data">
        <table class="Form">
            <tr>
                <td colspan="2" class="tieude1">Cập nhật thông tin sản phẩm</td>			
            </tr>

            <input type="hidden" name="IdSanPham" value="<?php echo $row['IdSanPham']; ?>" />

            <tr>
                <td>Tên sản phẩm:</td>
                <td>
                    <input type="text" name="TenSanPham" value="<?php echo htmlspecialchars($row['TenSanPham']); ?>" required />
                    <span class="requirefield">*</span>
                </td>
            </tr>

            <tr>
                <td>Nhà sản xuất:</td>
                <td>
                    <select name="IdNhaSanXuat" class="styled-select"required>
                        <option value="">-- Chọn nhà sản xuất --</option>

                        <?php while ($nsx = $nsx_result->fetch_assoc()) { ?>
                            <option value="<?php echo $nsx['IdNhaSanXuat']; ?>"
                                <?php if ($nsx['IdNhaSanXuat'] == $row['IdNhaSanXuat']) echo "selected"; ?>>
                                <?php echo $nsx['TenNhaSanXuat']; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <span class="requirefield">*</span>
                </td>
            </tr>

            <tr>
                <td>Đơn giá:</td>
                <td>
                    <input type="number" name="DonGia" value="<?php echo $row['DonGia']; ?>" required />
                    <span class="requirefield">*</span>
                </td>
            </tr>

            <tr>
                <td>Số lượng:</td>
                <td>
                    <input type="number" name="SoLuong" value="<?php echo $row['SoLuong']; ?>" required />
                    <span class="requirefield">*</span>
                </td>
            </tr>

            <tr>
                <td>Tỉ lệ giảm giá (%):</td>
                <td>
                    <input type="number" name="TiLeGiamGia" value="<?php echo $row['TiLeGiamGia']; ?>" required />
                    <span class="requirefield">*</span>
                </td>
            </tr>
           
            <tr>
                <td>Hình ảnh hiện tại:</td>
                <td>
                    <?php
                        $path = "../images/" . $row['HinhAnh'];
                        if (!empty($row['HinhAnh']) && file_exists($path)) {
                            echo "<img src='$path' style='width:100px; height:auto;' />";
                        } else {
                            echo "<span style='color:red;'>Không có hình</span>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Đổi ảnh mới:</td>
                <td><input type="file" name="HinhAnh" accept="image/*" /></td>
            </tr>
            <tr>
                <td>Mô tả:</td>
                <td>
                    <textarea type="text" name="MoTa" ><?php echo htmlspecialchars($row['MoTa']); ?> </textarea>
                </td>
            </tr>

            <tr>
                <td>Cấu hình:</td>
                <td>
                    <textarea type="text" name="CauHinh"><?php echo htmlspecialchars($row['CauHinh']); ?> </textarea>
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
