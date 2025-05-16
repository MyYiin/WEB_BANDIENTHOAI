  <?php
      include("../includes/connect.php");
      $start = isset($_POST['cot']) ? (int)$_POST['cot'] : 0;


      $sql = "SELECT * FROM tbl_sanpham ORDER BY LuotXem LIMIT $start, 5";
      $res = $connect->query($sql);

      while($row = $res->fetch_assoc()){
  ?>
 <div class="col-6 col-md-4 col-lg-3 khungsanpham post">
    <div class="card h-100 shadow-sm">
      <a href="#" class="xemchitiet text-decoration-none text-dark" data-id_sp="<?= $row['IdSanPham'] ?>" data-id_nsx="<?= $row['IdNhaSanXuat'] ?>">
        <img src="user/images/<?= $row['HinhAnh'] ?>" class="card-img-top img-fluid" style="height: 180px; object-fit: contain;" alt="<?= $row['TenSanPham'] ?>">
        <div class="card-body text-center">
          <h6 class="card-title fw-semibold mb-2"><?= $row['TenSanPham'] ?></h6>
          <p class="text-danger fw-bold mb-0"><?= number_format($row['DonGia']) ?>đ</p>
        </div>
      </a>
    </div>
  </div>
  <?php
    }
  ?>