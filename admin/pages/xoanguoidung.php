<?php
include("../includes/connect.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "DELETE FROM tbl_nguoidung WHERE MaNguoiDung = $id";
    $result = $connect->query($sql);

    if ($result) {
        header("Location: dsnguoidung.php");
        exit();
    } else {
        echo "Lỗi xóa người dùng: " . $connect->error;
    }
} else {
    echo "ID người dùng không hợp lệ.";
}
?>
