<?php
include("../includes/connect.php"); 

$sql = "SELECT dh.IdDonHang, dh.MaKH, dh.NgayDat, dh.NgayGiaoDuKien, dh.DiaChiGiaoHang, dh.TrangThai,
        ct.IdSanPham, ct.SoLuong, ct.DonGia, sp.TenSanPham
        FROM tbl_donhang dh 
        INNER JOIN tbl_chitietdonhang ct ON dh.IdDonHang = ct.IdDonHang
		INNER JOIN tbl_sanpham sp ON ct.IdSanPham = sp.IdSanPham
        ORDER BY dh.IdDonHang";

$danhsach = $connect->query($sql); 

if (!$danhsach) { 
    die("Không thể thực hiện câu lệnh SQL: ". $connect->error); 
}

$donhangs = [];
while ($row = $danhsach->fetch_assoc()) {
    $id = $row['IdDonHang'];
    if (!isset($donhangs[$id])) {
        $donhangs[$id] = [
            'MaKH' => $row['MaKH'],
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
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Danh sách đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4 text-primary">📋 Danh sách đơn hàng và chi tiết</h1>

        <?php if (empty($donhangs)) : ?>
            <div class="alert alert-info">Chưa có đơn hàng nào.</div>
        <?php else: ?>
            <?php foreach ($donhangs as $idDonHang => $donhang) : ?>
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <strong>Đơn hàng #<?= htmlspecialchars($idDonHang) ?></strong>
                        <span class="float-end">
                            Trạng thái: 
                            <?php
                                switch ($donhang['TrangThai']) {
                                    case 0: echo '<span class="badge bg-secondary">Chờ xử lý</span>'; break;
                                    case 1: echo '<span class="badge bg-warning">Đang giao</span>'; break;
                                    case 2: echo '<span class="badge bg-success">Hoàn thành</span>'; break;
                                    case 3: echo '<span class="badge bg-danger">Đã hủy</span>'; break;
                                    default: echo '<span class="badge bg-info">Không xác định</span>';
                                }
                            ?>
                        </span>
                    </div>
                    <div class="card-body">
                        <p><strong>Khách hàng:</strong> <?= htmlspecialchars($donhang['MaKH']) ?></p>
                        <p><strong>Ngày đặt:</strong> <?= htmlspecialchars($donhang['NgayDat']) ?></p>
                        <p><strong>Dự kiến giao:</strong> <?= htmlspecialchars($donhang['NgayGiaoDuKien']) ?></p>
                        <p><strong>Địa chỉ giao hàng:</strong> <?= htmlspecialchars($donhang['DiaChiGiaoHang']) ?></p>

                        <h5>Chi tiết sản phẩm:</h5>
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Sản phẩm</th>
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
