<?php
    include('user/includes/connect.php');
   
   $sql = "SELECT t.IdSanPham, t.TenSanPham, t.IdNhaSanXuat, t.HinhAnh, t.DonGia, t.SoLuong, t.MoTa, t.CauHinh, t.TiLeGiamGia, t.LuotXem, l.IdNhaSanXuat, l.TenNhaSanXuat
            FROM (tbl_nhasanxuat l INNER  JOIN tbl_sanpham t ON t.IdNhaSanXuat=l.IdNhaSanXuat) 
            ORDER BY IdSanPham DESC 
            LIMIT 0, 5";
    $result = $connect->query($sql);

    if (!$result) {
        die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
        exit();
    }
    ?>

<h2 class="text-center mb-4 text-primary fw-bold">Sản phẩm mới</h2>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
    <?php while($row = $result->fetch_array(MYSQLI_ASSOC)): ?>
        <div class="col">
            <div class="card h-100 shadow-sm border-0 product-card">
                <a href="#" class="xemchitiet text-decoration-none text-dark" 
                   data-id_sp="<?= $row['IdSanPham'] ?>" data-id_nsx="<?= $row['IdNhaSanXuat'] ?>">
                    <img src="images/<?= $row['HinhAnh'] ?>" class="card-img-top" alt="<?= $row['TenSanPham'] ?>">
                    <div class="card-body">
                        <h6 class="card-title text-truncate"><?= $row['TenSanPham'] ?></h6>
                        <p class="card-text text-danger fw-bold"><?= number_format($row['DonGia']) ?> đ</p>
                    </div>
                </a>
            </div>
        </div>
    <?php endwhile; ?>
</div>

