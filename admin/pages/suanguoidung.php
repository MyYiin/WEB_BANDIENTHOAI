<?php
    include("../includes/connect.php");

    // Lấy ID người dùng cần sửa
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Truy vấn dữ liệu người dùng theo ID
    $sql = "SELECT * FROM tbl_nguoidung WHERE MaNguoiDung = $id";
    $result = $connect->query($sql);

    if (!$result || $result->num_rows == 0) {
        die("Không tìm thấy người dùng.");
    }

    $nguoidung = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sửa người dùng</title>
    <link rel="stylesheet" type="text/css" href="../CSS/suanguoidung.css">
   
</head>
<body>
<div class="form-wrapper">
    <form action="suanguoidung_submit.php" method="post">
        <table class="Form">
            <tr><td colspan="2" class="tieude1">Sửa thông tin người dùng</td></tr>

            <input type="hidden" name="MaNguoiDung" value="<?= $nguoidung['MaNguoiDung'] ?>">

            <tr>
                <td>Họ và tên:</td>
                <td>
                    <input type="text" name="TenNguoiDung" value="<?= htmlspecialchars($nguoidung['TenNguoiDung']) ?>" required />
                    <span class="requirefield">*</span>
                </td>
            </tr>
            <tr>
                <td>Tên đăng nhập:</td>
                <td>
                    <input type="text" name="TenDangNhap" value="<?= htmlspecialchars($nguoidung['TenDangNhap']) ?>" required />
                    <span class="requirefield">*</span>
                </td>
            </tr>
            <tr>
                <td>Quyền hạn:</td>
                <td>
                    <select name="QuyenHan"required>
                        <option value="1" <?= $nguoidung['QuyenHan'] == 1 ? 'selected' : '' ?>>Quản trị</option>
                        <option value="2" <?= $nguoidung['QuyenHan'] == 2 ? 'selected' : '' ?>>Thành viên</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Mật khẩu:</td>
                <td>
                    <input type="password" name="MatKhau" value="<?= htmlspecialchars($nguoidung['MatKhau']) ?>" required />
                    <span class="requirefield">*</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <div class="note">(*): Các trường bắt buộc nhập.</div>
                    <input type="submit" value="Cập nhật">
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
