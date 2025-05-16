<?php
	include("../user/includes/connect.php");
	$IdSanPham = $_GET['id_sp'];
	
	$sql = "SELECT *
			FROM tbl_sanpham A, tbl_nhasanxuat B
			WHERE A.IdNhaSanXuat = B.IdNhaSanXuat AND A.IdSanPham = $IdSanPham";
	
	$danhsach = $connect->query($sql);
	//Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
	if (!$danhsach) {
		die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
		exit();
	}
	
	$dong = $danhsach->fetch_array(MYSQLI_ASSOC);
	
	// Tăng lượt xem
	$sql = "UPDATE tbl_sanpham SET LuotXem = LuotXem + 1 WHERE IdSanPham = $IdSanPham";
	$truyvan_luotxem = $connect->query($sql);
	
	
	$giaban = $dong['DonGia'] * (1 - $dong['TiLeGiamGia']/100);
	
?>
<div class="container my-5 chitietsanpham bg-white p-4 rounded shadow-sm">
  	<h2 class="mb-4 text-primary"><?= htmlspecialchars($dong['TenSanPham']) ?></h2>

  	<div class="row g-4">
    	<!-- Ảnh sản phẩm -->
		<div class="col-md-5">
		<img src="user/images/<?= htmlspecialchars($dong['HinhAnh']) ?>" class="img-fluid rounded shadow-sm w-100" alt="<?= htmlspecialchars($dong['TenSanPham']) ?>">
		</div>

		<!-- Thông tin sản phẩm -->
		<div class="col-md-7">
			<p><strong>Nhà sản xuất:</strong> <?= htmlspecialchars($dong['TenNhaSanXuat']) ?></p>
			<p><strong>Giá gốc:</strong>
				<span class="text-muted text-decoration-line-through"><?= number_format($dong['DonGia']) ?> đ</span>
			</p>
			<p><strong>Giá bán:</strong>
				<span class="text-danger fw-bold fs-5"><?= number_format($giaban) ?> đ</span>
			</p>
			<p><strong>Giảm giá:</strong>
				<span class="badge bg-danger"><?= $dong['TiLeGiamGia'] ?>%</span>
			</p>

			<a href="#" class="btn btn-primary mt-3">
				<i class="fas fa-cart-plus me-2"></i> Mua ngay
			</a>
    	</div>
  </div>

  <hr class="my-4">

  <!-- Cấu hình -->
  <h4 class="mb-3">Cấu hình sản phẩm</h4>
  <div class="bg-light p-3 rounded border" style="white-space: pre-line;">
    <?= nl2br(htmlspecialchars($dong['CauHinh'])) ?>
  </div>
</div>