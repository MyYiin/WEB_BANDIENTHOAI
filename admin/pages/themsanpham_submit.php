<?php
    include("../includes/connect.php");

    // Lấy dữ liệu từ form
    $TenSanPham    = trim($_POST['TenSanPham']);
    $IdNhaSanXuat  = $_POST['IdNhaSanXuat'];
    $DonGia        = $_POST['DonGia'];
    $SoLuong       = $_POST['SoLuong'];
    $TiLeGiamGia   = $_POST['TiLeGiamGia'];
    $MoTa          = isset($_POST['MoTa']) && trim($_POST['MoTa']) !== '' ? trim($_POST['MoTa']) : null;
    $CauHinh       = isset($_POST['CauHinh']) && trim($_POST['CauHinh']) !== '' ? trim($_POST['CauHinh']) : null;

    // Kiểm tra dữ liệu đầu vào
    if ($TenSanPham == "") {
        echo "Tên sản phẩm không được bỏ trống!";
    } elseif ($IdNhaSanXuat == "") {
        echo "Nhà sản xuất không được bỏ trống!";
    } elseif ($DonGia == "" || !is_numeric($DonGia)) {
        echo "Đơn giá không hợp lệ!";
    } elseif ($SoLuong == "" || !is_numeric($SoLuong)) {
        echo "Số lượng không hợp lệ!";
    } elseif ($TiLeGiamGia == "" || !is_numeric($TiLeGiamGia)) {
        echo "Tỉ lệ giảm giá không hợp lệ!";
    } elseif (!isset($_FILES['HinhAnh']) || $_FILES['HinhAnh']['error'] != 0) {
        echo "Vui lòng chọn hình ảnh sản phẩm!";
    } else {
        // Xử lý hình ảnh
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["HinhAnh"]["name"]);
        $HinhAnh = basename($_FILES["HinhAnh"]["name"]);

        // Di chuyển file vào thư mục uploads
        if (move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], $target_file)) {
            // Câu lệnh thêm dữ liệu vào CSDL
            $sql = "INSERT INTO tbl_sanpham 
                    (TenSanPham, IdNhaSanXuat, HinhAnh, DonGia, MoTa, SoLuong, TiLeGiamGia, CauHinh, LuotXem) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)";

            $stmt = $connect->prepare($sql);
            $stmt->bind_param("sisdsiis", $TenSanPham, $IdNhaSanXuat, $HinhAnh, $DonGia, $MoTa, $SoLuong, $TiLeGiamGia, $CauHinh );

            if ($stmt->execute()) {
                // Thành công
                header("Location: dssanpham.php");
                exit;
            } else {
                echo "Lỗi khi thêm sản phẩm: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Lỗi khi upload hình ảnh!";
        }
    }

    $connect->close();
?>
