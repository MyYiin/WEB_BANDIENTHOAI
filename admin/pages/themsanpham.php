<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sản Phẩm</title>
    <link rel="stylesheet" type="text/css" href="../CSS/themsanpham.css">

</head>
<body>
    <?php	
        include("../includes/connect.php");

        // Kiểm tra kết nối
        if ($connect->connect_error) {
            die("Kết nối thất bại: " . $connect->connect_error);
        }

        // Truy vấn danh sách nhà sản xuất
        $sql_nhasx = "SELECT IdNhaSanXuat, TenNhaSanXuat FROM tbl_nhasanxuat";
        $result_nhasx = $connect->query($sql_nhasx);
    ?>
    <div class="form-wrapper">
        <form action="themsanpham_submit.php" method="post" enctype="multipart/form-data">

            <table class="Form">
                <tr>
                    <td colspan="2" class="tieude1">Thêm sản phẩm mới</td>			
                </tr>

                <input type="hidden" name="IdSanPham" />

                <tr>
                    <td>Tên sản phẩm:</td>
                    <td>
                        <input type="text" name="TenSanPham" />
                        <span class="requirefield">*</span>
                    </td>
                </tr>

                <tr>
                    <td>Nhà sản xuất:</td>
                    <td>
                        <select name="IdNhaSanXuat"  class="styled-select"required>
                            <option value="">-- Chọn nhà sản xuất --</option>
                            <?php if ($result_nhasx && $result_nhasx->num_rows > 0): ?>
                                <?php while ($row = $result_nhasx->fetch_assoc()): ?>
                                    <option value="<?php echo $row['IdNhaSanXuat']; ?>">
                                        <?php echo htmlspecialchars($row['TenNhaSanXuat']); ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <option disabled>Không có nhà sản xuất nào</option>
                            <?php endif; ?>


                        </select>
                        <span class="requirefield">*</span>
                    </td>
                </tr>

                <tr>
                    <td>Đơn giá:</td>
                    <td>
                        <input type="number" name="DonGia"  />
                        <span class="requirefield">*</span>
                    </td>
                </tr>

                <tr>
                    <td>Số lượng:</td>
                    <td>
                        <input type="number" name="SoLuong" />
                        <span class="requirefield">*</span>
                    </td>
                </tr>
                <tr>
                    <td>Hình ảnh:</td>
                    <td>
                        <input type="file" name="HinhAnh" accept="image/*" />
                        <span class="requirefield">*</span>
                    </td>
                </tr>
                <tr>
                    <td>Tỉ lệ giảm giá (%):</td>
                    <td>
                        <input type="number" name="TiLeGiamGia" />
                        <span class="requirefield">*</span>
                    </td>
                </tr>
               <tr>
                    <td>Mô tả:</td>
                    <td>
                        <textarea type="text" name="MoTa" > </textarea>
                    </td>
                </tr>

                <tr>
                    <td>Cấu hình:</td>
                    <td>
                        <textarea type="text" name="CauHinh"> </textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" align="center">
                        <div class="note">(*): Các trường bắt buộc nhập thông tin.</div>
                        <input type="submit" value="Thêm sản phẩm" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
