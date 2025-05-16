<?php
  include("../includes/connect.php");
  $start = isset($_POST['cot']) ? (int)$_POST['cot'] : 0;
  $limit = 5;

  $sql = "SELECT * FROM tbl_sanpham ORDER BY LuotXem DESC LIMIT $start, $limit";
  $res = $connect->query($sql);

  while ($row = $res->fetch_assoc()) {
?>
  <div class="col-1-5 post">
    <div class="card h-100 shadow-sm border-0 product-card">
      <a href="#" class="xemchitiet text-decoration-none text-dark" 
         data-id_sp="<?= $row['IdSanPham'] ?>" 
         data-id_nsx="<?= $row['IdNhaSanXuat'] ?>">
        <img src="user/images/<?= $row['HinhAnh'] ?>" 
             class="card-img-top" 
             alt="<?= htmlspecialchars($row['TenSanPham']) ?>">
        <div class="card-body">
          <h6 class="card-title text-truncate"><?= htmlspecialchars($row['TenSanPham']) ?></h6>
          <p class="card-text text-danger fw-bold"><?= number_format($row['DonGia'], 0, ',', '.') ?> đ</p>
        </div>
      </a>
    </div>
  </div>
<?php } ?>
