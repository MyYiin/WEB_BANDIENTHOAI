<?php
    include("../includes/connect.php");

    $search = isset($_GET['search'])? trim($_GET['search']): null;

    if($search == null){
         echo "<p class='text-danger'>Vui lòng nhập từ khóa để tìm kiếm.</p>";
        return;
    }

    $sql = "SELECT * FROM tbl_sanpham WHERE TenSanPham LIKE ? OR CauHinh LIKE ?";

    $stament = $connect->prepare($sql);
    $sql_search = "%$search%";
    $stament->bind_param("ss", $sql_search, $sql_search);
    $stament->execute();
    $result = $stament->get_result();

   echo "<h3 class='text-primary mb-4'>Kết quả tìm kiếm cho: <strong>$search</strong></h3>";

    if($result->num_rows > 0){
        echo "<div class='row'>";
        while ($row = $result->fetch_assoc()){
        ?>
            <div class="col-md-3 b-4">
            <div class="card h-100 shadow-sm">
            <img src="images/<?= $row['HinhAnh'] ?>" class="card-img-top" alt="<?= $row['TenSanPham'] ?>">
            <div class="card-body">
                <h6 class="card-title"><?=$row['TenSanPham']?></h6>
                <p class="card-text text-danger fw-bold"><?=number_format($row['DonGia'], 0, ',', '.')?>đ</p>
            </div>
        </div>
        </div>
    <?php
    }
    echo "</div>";
    }else{
        echo "<p class='text-muted'>Không tìm thấy sản phẩm nào khớp với '<strong>$search</strong>'</p>";
    }
?>