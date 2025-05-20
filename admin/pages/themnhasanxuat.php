<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký khách hàng</title>
    <link rel="stylesheet" type="text/css" href="../CSS/themNSX.css">
    
</head>
<body>

<div class="form-wrapper">
    <form action="themNSX_submit.php" method="post">
        <table class="Form">
            <tr>
                <td colspan="2" class="tieude1">Thêm Nhà Sản Xuất Sản Phẩm</td>         
            </tr>       

            <tr>
                <td>Tên nhà sản xuất</td>
                <td>
                    <input type="text" name="TenNhaSanXuat" />
                    <span class="requirefield">*</span>
                </td>
            </tr>          
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
