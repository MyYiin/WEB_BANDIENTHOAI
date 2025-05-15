<?php
    include("../includes/connect.php");

    $IdSanPham = (int)$_POST['IdSanPham'];
    $TenSanPham = trim($_POST['TenSanPham']);
    $IdNhaSanXuat = (int)$_POST['IdNhaSanXuat'];
    $DonGia = (int)$_POST['DonGia'];
    $SoLuong = (int)$_POST['SoLuong'];
    $TiLeGiamGia = (int)$_POST['TiLeGiamGia'];
    $MoTa = isset($_POST['MoTa']) && trim($_POST['MoTa']) !== '' ? trim($_POST['MoTa']) : null;
    $CauHinh = isset($_POST['CauHinh']) && trim($_POST['CauHinh']) !== '' ? trim($_POST['CauHinh']) : null;

    // Lấy tên file ảnh cũ từ DB
    $stmt_old = $connect->prepare("SELECT HinhAnh FROM tbl_sanpham WHERE IdSanPham = ?");
    $stmt_old->bind_param("i", $IdSanPham);
    $stmt_old->execute();
    $result = $stmt_old->get_result();
    $row_old = $result->fetch_assoc();
    $HinhAnhCu = $row_old['HinhAnh'] ?? null;
    $stmt_old->close();

    // Xử lý ảnh nếu có upload ảnh mới
    if (isset($_FILES['HinhAnh']) && $_FILES['HinhAnh']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "../images/";
        
        // Tạo thư mục nếu chưa có
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $tenAnhMoi = basename($_FILES["HinhAnh"]["name"]);
        $duongDanAnhMoi = $target_dir . $tenAnhMoi;

        // Di chuyển ảnh
        if (move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], $duongDanAnhMoi)) {
            $HinhAnh = $tenAnhMoi;
            // KHÔNG xóa ảnh cũ trong folder
        } else {
            echo "Lỗi upload hình ảnh.";
            exit;
        }
    } else {
        // Nếu không upload ảnh mới, giữ ảnh cũ
        $HinhAnh = $HinhAnhCu;
    }

    // Cập nhật dữ liệu
    $stmt_update = $connect->prepare("UPDATE tbl_sanpham SET TenSanPham=?, IdNhaSanXuat=?, DonGia=?, SoLuong=?, TiLeGiamGia=?, HinhAnh=?, MoTa=?, CauHinh=? WHERE IdSanPham=?");
    $stmt_update->bind_param("siddisssi", $TenSanPham, $IdNhaSanXuat, $DonGia, $SoLuong, $TiLeGiamGia, $HinhAnh, $MoTa, $CauHinh, $IdSanPham);

    if ($stmt_update->execute()) {
        header("Location: dssanpham.php");
        exit;
    } else {
        echo "Lỗi cập nhật: " . $stmt_update->error;
    }

    $stmt_update->close();
    $connect->close();
?>
