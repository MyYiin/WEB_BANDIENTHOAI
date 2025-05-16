<?php
    include('user/includes/connect.php');

    // Lấy tổng số sản phẩm
    $totalSql = "SELECT COUNT(*) as total FROM tbl_sanpham";
    $totalRes = $connect->query($totalSql);
    $allcount = $totalRes->fetch_assoc()['total'];

    // Lấy 10 sản phẩm có lượt xem nhiều nhất
    $sql = "SELECT * FROM tbl_sanpham ORDER BY LuotXem DESC LIMIT 0, 10";
    $danhsach = $connect->query($sql);

    if (!$danhsach) {
        die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
        exit();
    }
?>

<h2 class="text-center mb-4 text-primary fw-bold">Danh sách sản phẩm nổi bật</h2>

<input type="hidden" id="row" value="10">
<input type="hidden" id="all" value="<?= $allcount ?>">

<div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 justify-content-center product-list">
    <?php while($row = $danhsach->fetch_array(MYSQLI_ASSOC)): ?>
        <div class="col">
            <div class="card h-100 shadow-sm border-0 product-card text-center">
                <a href="#" class="xemchitiet text-decoration-none text-dark d-flex flex-column h-100"
                   data-id_sp="<?= $row['IdSanPham'] ?>" 
                   data-id_nsx="<?= $row['IdNhaSanXuat'] ?>">

                    <img src="user/images/<?= $row['HinhAnh'] ?>" 
                         class="card-img-top mx-auto mt-3"
                         style="width: 100%; height: 180px; object-fit: contain;" 
                         alt="<?= $row['TenSanPham'] ?>">

                    <div class="card-body mt-auto">
                        <h6 class="card-title fw-semibold text-truncate mb-2" title="<?= $row['TenSanPham'] ?>">
                            <?= $row['TenSanPham'] ?>
                        </h6>
                        <p class="text-danger fw-bold mb-0"><?= number_format($row['DonGia']) ?> đ</p>
                    </div>
                </a>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<div class="text-center mt-4">
    <button class="load-more btn btn-outline-primary px-4 py-2 fw-semibold">Xem thêm</button>
</div>
