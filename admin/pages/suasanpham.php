<?php
	include("../includes/connect.php");

	$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

	$stmt = $connect->prepare("SELECT * FROM tbl_sanpham WHERE IdSanPham = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows == 0) {
		echo "<p class='text-center text-danger mt-5'>Không tìm thấy sản phẩm.</p>";
		exit;
	}

	$row = $result->fetch_assoc();

	// Lấy danh sách nhà sản xuất
	$nsx_result = $connect->query("SELECT IdNhaSanXuat, TenNhaSanXuat FROM tbl_nhasanxuat");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Sửa thông tin sản phẩm</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
	<style>
		body {
			background-color: #f9f6f2;
			color: #4a4a4a;
			padding: 30px 15px;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}
		.form-wrapper {
			max-width: 600px;
			margin: 0 auto;
			background: #fff;
			padding: 30px 40px;
			border-radius: 12px;
			box-shadow: 0 4px 15px rgba(0,0,0,0.1);
		}
		.form-title {
			color: #2c3e50;
			font-weight: 700;
			font-size: 1.8rem;
			margin-bottom: 25px;
			text-align: center;
		}
		.requirefield {
			color: #e74c3c;
			margin-left: 4px;
		}
		.note {
			font-size: 0.9rem;
			color: #888;
			margin-top: 15px;
			text-align: center;
		}
		.img-preview {
			width: 120px;
			height: auto;
			border-radius: 8px;
			border: 1px solid #ddd;
		}
	</style>
</head>
<body>

<div class="form-wrapper shadow-sm">
	<h2 class="form-title">Cập nhật thông tin sản phẩm</h2>

	<form action="suasanpham_submit.php" method="post" enctype="multipart/form-data" novalidate>
		<input type="hidden" name="IdSanPham" value="<?= htmlspecialchars($row['IdSanPham']) ?>" />

		<div class="mb-3">
			<label for="TenSanPham" class="form-label">Tên sản phẩm <span class="requirefield">*</span></label>
			<input
				type="text"
				id="TenSanPham"
				name="TenSanPham"
				class="form-control"
				value="<?= htmlspecialchars($row['TenSanPham']) ?>"
				required
				maxlength="150"
				placeholder="Nhập tên sản phẩm"
			/>
			<div class="invalid-feedback">Vui lòng nhập tên sản phẩm.</div>
		</div>

		<div class="mb-3">
			<label for="IdNhaSanXuat" class="form-label">Nhà sản xuất <span class="requirefield">*</span></label>
			<select id="IdNhaSanXuat" name="IdNhaSanXuat" class="form-select" required>
				<option value="">-- Chọn nhà sản xuất --</option>
				<?php while ($nsx = $nsx_result->fetch_assoc()) : ?>
					<option value="<?= $nsx['IdNhaSanXuat'] ?>"
						<?= $nsx['IdNhaSanXuat'] == $row['IdNhaSanXuat'] ? 'selected' : '' ?>>
						<?= htmlspecialchars($nsx['TenNhaSanXuat']) ?>
					</option>
				<?php endwhile; ?>
			</select>
			<div class="invalid-feedback">Vui lòng chọn nhà sản xuất.</div>
		</div>

		<div class="mb-3">
			<label for="DonGia" class="form-label">Đơn giá <span class="requirefield">*</span></label>
			<input
				type="number"
				id="DonGia"
				name="DonGia"
				class="form-control"
				value="<?= htmlspecialchars($row['DonGia']) ?>"
				required
				min="0"
				step="0.01"
				placeholder="Nhập đơn giá"
			/>
			<div class="invalid-feedback">Vui lòng nhập đơn giá hợp lệ.</div>
		</div>

		<div class="mb-3">
			<label for="SoLuong" class="form-label">Số lượng <span class="requirefield">*</span></label>
			<input
				type="number"
				id="SoLuong"
				name="SoLuong"
				class="form-control"
				value="<?= htmlspecialchars($row['SoLuong']) ?>"
				required
				min="0"
				step="1"
				placeholder="Nhập số lượng"
			/>
			<div class="invalid-feedback">Vui lòng nhập số lượng hợp lệ.</div>
		</div>

		<div class="mb-3">
			<label for="TiLeGiamGia" class="form-label">Tỉ lệ giảm giá (%) <span class="requirefield">*</span></label>
			<input
				type="number"
				id="TiLeGiamGia"
				name="TiLeGiamGia"
				class="form-control"
				value="<?= htmlspecialchars($row['TiLeGiamGia']) ?>"
				required
				min="0"
				max="100"
				step="0.01"
				placeholder="Nhập tỉ lệ giảm giá"
			/>
			<div class="invalid-feedback">Vui lòng nhập tỉ lệ giảm giá hợp lệ (0 - 100%).</div>
		</div>

		<div class="mb-3">
			<label class="form-label">Hình ảnh hiện tại:</label><br />
			<?php
				$path = "../images/" . $row['HinhAnh'];
				if (!empty($row['HinhAnh']) && file_exists($path)) {
					echo "<img src='$path' alt='Hình ảnh sản phẩm' class='img-preview' />";
				} else {
					echo "<span class='text-danger'>Không có hình ảnh</span>";
				}
			?>
		</div>

		<div class="mb-4">
			<label for="HinhAnh" class="form-label">Đổi ảnh mới:</label>
			<input type="file" id="HinhAnh" name="HinhAnh" class="form-control" accept="image/*" />
		</div>

		<div class="mb-3">
			<label for="MoTa" class="form-label">Mô tả:</label>
			<textarea id="MoTa" name="MoTa" class="form-control" rows="4" placeholder="Nhập mô tả sản phẩm"><?= htmlspecialchars($row['MoTa']) ?></textarea>
		</div>

		<div class="mb-3">
			<label for="CauHinh" class="form-label">Cấu hình:</label>
			<textarea id="CauHinh" name="CauHinh" class="form-control" rows="4" placeholder="Nhập cấu hình sản phẩm"><?= htmlspecialchars($row['CauHinh']) ?></textarea>
		</div>

		<div class="text-center">
			<div class="note">(*) Các trường bắt buộc nhập thông tin.</div>
			<button type="submit" class="btn btn-primary mt-3 px-5">Cập nhật</button>
		</div>
	</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
	(() => {
		'use strict'
		const forms = document.querySelectorAll('form')
		Array.from(forms).forEach(form => {
			form.addEventListener('submit', event => {
				if (!form.checkValidity()) {
					event.preventDefault()
					event.stopPropagation()
				}
				form.classList.add('was-validated')
			}, false)
		})
	})()
</script>

</body>
</html>
