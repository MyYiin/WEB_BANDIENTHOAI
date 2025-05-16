<?php

    include('user/includes/connect.php');

    $sql = "SELECT * FROM tbl_sanpham ORDER BY LuotXem DESC 
            LIMIT 0, 10";
    
    $danhsach = $connect->query($sql);

    if(!$danhsach){
    die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
        exit();
    }    
?>

<h2 class="text-center mb-4">Danh sách sản phẩm</h2>
    <div class='danhsachsanpham'>
    <?php while($row = $danhsach->fetch_array(MYSQLI_ASSOC)): ?>
        <div class='khungsanpham'>
            <div class='card'>
               <a href="#" class="xemchitiet" data-id_sp="<?= $row['IdSanPham'] ?>" data-id_nsx="<?= $row['IdNhaSanXuat'] ?>">
                    <img class='HinhAnh' src="user/images/<?= $row['HinhAnh'] ?>" alt="<?= $row['TenSanPham'] ?>">
                    <span class='TenSanPham'><?= $row['TenSanPham'] ?></span><br>
                    <span class='DonGia'><?= number_format($row['DonGia']) ?> đ</span>
                </a>
            </div>
        </div>
<?php endwhile; ?>
<div class="xemthem btn btn-primary px-4 py-2">Xem thêm</div>

        