<?php
include("../includes/connect.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "DELETE FROM tbl_nhasanxuat WHERE IdNhaSanXuat = $id";
    $result = $connect->query($sql);

    if ($result) {
        header("Location: dsnhasanxuat.php");
        exit();
    } else {
        echo "Lỗi xóa nhà sản xuất: " . $connect->error;
    }
} else {
    echo "ID nhà sản xuất không hợp lệ.";
}
?>
