<?php
include("../includes/connect.php"); 

$trangthai = isset($_GET['trangthai']) ? intval($_GET['trangthai']) : null;

$donhangs = getAllOrders($trangthai, $connect);

//em làm hàm được nè thầy 
function getAllOrders($trangthai, $connect) {
    $sql = "SELECT dh.IdDonHang, dh.MaKH, dh.NgayDat, dh.NgayGiaoDuKien, dh.DiaChiGiaoHang, dh.TrangThai,
        ct.IdSanPham, ct.SoLuong, ct.DonGia, sp.TenSanPham, nd.TenNguoiDung
        FROM tbl_donhang dh 
        INNER JOIN tbl_chitietdonhang ct ON dh.IdDonHang = ct.IdDonHang
        INNER JOIN tbl_nguoidung nd ON dh.MaKH = nd.MaNguoiDung
        INNER JOIN tbl_sanpham sp ON ct.IdSanPham = sp.IdSanPham";

    if($trangthai !== null) {
        $sql .= " WHERE dh.TrangThai = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $trangthai);
    } else {
        $stmt = $connect->prepare($sql);
    }
    
    $stmt->execute();
    $danhsach = $stmt->get_result();

    $donhangs = [];
    while ($row = $danhsach->fetch_assoc()) {
        $id = $row['IdDonHang'];
        if (!isset($donhangs[$id])) {
            $donhangs[$id] = [
                'TenNguoiDung' => $row['TenNguoiDung'],
                'NgayDat' => $row['NgayDat'],
                'NgayGiaoDuKien' => $row['NgayGiaoDuKien'],
                'DiaChiGiaoHang' => $row['DiaChiGiaoHang'],
                'TrangThai' => $row['TrangThai'],
                'Chitiet' => []
            ];
        }
        
        $donhangs[$id]['Chitiet'][] = [
            'TenSanPham' => $row['TenSanPham'],
            'SoLuong' => $row['SoLuong'],
            'DonGia' => $row['DonGia'],
        ];
    }
    
    return $donhangs;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div id="main-content" class="container mt-4">
        <h1 class="mb-4 text-primary">📋 Danh sách đơn hàng và chi tiết</h1>

        <?php if (empty($donhangs)): ?>
            <div class="alert alert-info">Chưa có đơn hàng nào.</div>
        <?php else: ?>
            <?php foreach ($donhangs as $idDonHang => $donhang): ?>
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <strong>Đơn hàng #<?= htmlspecialchars($idDonHang) ?></strong>
                <span class="float-end">
                    Trạng thái:
                    <?php
                        switch ($donhang['TrangThai']) {
                            case 0: echo '<span class="badge bg-secondary">Chờ xử lý</span>'; break;
                            case 1: echo '<span class="badge bg-warning text-dark">Đang giao</span>'; break;
                            case 2: echo '<span class="badge bg-success">Hoàn thành</span>'; break;
                            case 3: echo '<span class="badge bg-danger">Đã hủy</span>'; break;
                            default: echo '<span class="badge bg-info">Không xác định</span>';
                        }
                    ?>
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Khách hàng:</strong> <?= htmlspecialchars($donhang['TenNguoiDung']) ?></p>
                        <p><strong>Ngày đặt:</strong> <?= htmlspecialchars($donhang['NgayDat']) ?></p>
                        <p><strong>Dự kiến giao:</strong> <?= htmlspecialchars($donhang['NgayGiaoDuKien']) ?></p>
                        <p><strong>Địa chỉ giao hàng:</strong> <?= htmlspecialchars($donhang['DiaChiGiaoHang']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <form method="post" action="capnhat_trangthai_don.php" name="form_capnhat_<?= $idDonHang ?>" class="card border-light">
                            <div class="card-header bg-light">Cập nhật trạng thái đơn hàng #<?= htmlspecialchars($idDonHang) ?></div>
                            <div class="card-body">
                                <input type="hidden" name="id_donhang" value="<?= htmlspecialchars($idDonHang) ?>">
                                <div class="mb-3">
                                    <select name="trangthai_moi" class="form-select">
                                        <option value="0" <?= $donhang['TrangThai'] == 0 ? 'selected' : '' ?>>Chờ xử lý</option>
                                        <option value="1" <?= $donhang['TrangThai'] == 1 ? 'selected' : '' ?>>Đang giao</option>
                                        <option value="2" <?= $donhang['TrangThai'] == 2 ? 'selected' : '' ?>>Hoàn thành</option>
                                        <option value="3" <?= $donhang['TrangThai'] == 3 ? 'selected' : '' ?>>Đã hủy</option>
                                    </select>
                                </div>
                                <button type="submit" name="capnhat_trangthai" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>

                <h5>Chi tiết sản phẩm:</h5>
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tong = 0;
                        foreach ($donhang['Chitiet'] as $ct):
                            $thanhtien = $ct['SoLuong'] * $ct['DonGia'];
                            $tong += $thanhtien;
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($ct['TenSanPham']) ?></td>
                                <td><?= htmlspecialchars($ct['SoLuong']) ?></td>
                                <td><?= number_format($ct['DonGia'], 0, ',', '.') ?>₫</td>
                                <td><?= number_format($thanhtien, 0, ',', '.') ?>₫</td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="fw-bold">
                            <td colspan="3" class="text-end">Tổng cộng:</td>
                            <td><?= number_format($tong, 0, ',', '.') ?>₫</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
