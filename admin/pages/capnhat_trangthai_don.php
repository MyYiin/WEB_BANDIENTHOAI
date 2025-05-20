<?php
include("../includes/connect.php"); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['capnhat_trangthai'])) {
    $id = intval($_POST['id_donhang']);
    $trangthai = intval($_POST['trangthai_moi']);

    $sql = "UPDATE tbl_donhang SET TrangThai = ? WHERE IdDonHang = ?";
    $capnhat = $connect->prepare($sql);
    $capnhat->bind_param("ii", $trangthai, $id);

    if (!$capnhat->execute()) {
        http_response_code(500);
        echo "Lỗi SQL: " . $capnhat->error;
        exit();
    }
    $capnhat->close();
    header("Location: index.php");
    exit();
} else {
    header("Location: dsdonhang.php");
    exit();
}
?>
