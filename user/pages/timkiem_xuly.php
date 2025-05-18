<?php
    include(__DIR__ . "/../includes/connect.php");

    $search = isset($_GET['search'])? trim($_GET['search']): null;

    if($search == null){
         echo "<p class='text-danger'>Vui lòng nhập từ khóa để tìm kiếm.</p>";
        return;
    }
    $sql = "SELECT sp.* FROM tbl_sanpham sp  JOIN tbl_nhasanxuat nsx ON sp.IdNhaSanXuat = nsx.IdNhaSanXuat
            WHERE sp.TenSanPham LIKE ? 
            OR sp.CauHinh LIKE ? 
            OR nsx.TenNhaSanXuat LIKE ?";

    $stament = $connect->prepare($sql);
    $sql_search = "%$search%";
    $stament->bind_param("sss", $sql_search, $sql_search, $sql_search);

    $stament->execute();
    $result = $stament->get_result();

   echo "<h3 class='text-primary mb-4'>Kết quả tìm kiếm cho: <strong>$search</strong></h3>";

    if($result->num_rows > 0){
        echo "<div class='row'>";
        while ($row = $result->fetch_assoc()){
        ?>
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
    <?php
    }
    echo "</div>";
    }else{
        echo "<p class='text-muted'>Không tìm thấy sản phẩm nào khớp với '<strong>$search</strong>'</p>";
    }
?>