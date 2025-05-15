<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thêm người dùng</title>
    <link rel="stylesheet" type="text/css" href="../CSS/themnguoidung.css">
</head>
<body>
<div class="form-wrapper">
    <form action="themnguoidung_submit.php" method="post">
        <table class="Form">
            <tr>
                <td colspan="2" class="tieude1">Thêm tài khoản người dùng</td>			
            </tr>	

            <tr>
                <td>Họ và tên:</td>
                <td>
                    <input type="text" name="TenNguoiDung" required />
                    <span class="requirefield">*</span>
                </td>
            </tr>

            <tr>
                <td>Tên đăng nhập:</td>
                <td>
                    <input type="text" name="TenDangNhap" required />
                    <span class="requirefield">*</span>
                </td>
            </tr>

            <tr>
                <td>Mật khẩu:</td>
                <td>
                    <input type="password" name="MatKhau" required />
                    <span class="requirefield">*</span>
                </td>
            </tr>

            <tr>
                <td>Nhập lại mật khẩu:</td>
                <td>
                    <input type="password" name="MatKhau2" required />
                    <span class="requirefield">*</span>
                </td>
            </tr>

            <tr>
                <td>Quyền hạn:</td>
                <td>
                    <select name="QuyenHan" class="styled-select"required>
                        <option value="">-- Chọn quyền hạn cho người dùng --
                            <option value="1">Quản trị</option>
                            <option value="2">Thành viên</option>
                        </option>
                    </select>
                </td>
            </tr>

            <!-- Khoa mặc định là 0, không cần nhập -->
            <input type="hidden" name="Khoa" value="0" />

            <tr>
                <td colspan="2" align="center">
                    <div class="note">(*): Các trường bắt buộc nhập thông tin.</div>
                    <input type="submit" value="Thêm" />
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
