<?php
    include('user/includes/connect.php');
    $sql = "SELECT t.IdSanPham, t.TenSanPham, t.IdNhaSanXuat, t.HinhAnh, t.DonGia, t.SoLuong, t.MoTa, t.CauHinh, t.TiLeGiamGia, t.LuotXem, l.IdNhaSanXuat, l.TenNhaSanXuat
            FROM (tbl_nhasanxuat l INNER JOIN tbl_sanpham t ON t.IdNhaSanXuat=l.IdNhaSanXuat) 
            ORDER BY IdSanPham DESC 
            LIMIT 0, 5";
    $result = $connect->query($sql);

    if (!$result) {
        die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
    }
    ?>

    <h2>Sản phẩm mới</h2>
    <div class='danhsachsanpham'>
    <?php while($row = $result->fetch_array(MYSQLI_ASSOC)): ?>
        <div class='khungsanpham'>
            <div class='card'>
                <a href='sanpham_chitiet.php?do=sanpham_chitiet&id_sp=<?= $row['IdSanPham'] ?>&id_nsx=<?= $row['IdNhaSanXuat'] ?>'>
                    <img class='HinhAnh' src='user/images/<?= $row["HinhAnh"] ?>' alt='<?= $row['TenSanPham'] ?>'>
                    <span class='TenSanPham'><?= $row['TenSanPham'] ?></span><br />
                    <span class='dongia'><?= number_format($row['DonGia']) ?> đ</span>
                </a>
            </div>
        </div>
    <?php endwhile; ?>
</div>
