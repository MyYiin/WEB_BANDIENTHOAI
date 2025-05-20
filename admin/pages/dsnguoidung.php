	<?php
	include("../includes/connect.php");

	$sql = "SELECT * FROM `tbl_nguoidung` WHERE 1";
	$danhsach = $connect->query($sql);
	if (!$danhsach) {
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	?>
	<!DOCTYPE html>
	<html lang="vi">

	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Danh sách người dùng</title>

		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
		<!-- Bootstrap Icons -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

		<style>
			body {
				background-color: #f7f9fc; /* nền trắng/xám nhạt */
				color: #0d3b66; /* xanh dương đậm cho chữ */
				font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
				margin: 0;
				padding: 0;
			}

			.container {
				padding: 2rem;
				max-width: 960px;
			}

			h4 {
				font-weight: 700;
				color: #0d3b66; /* xanh dương đậm */
				margin-bottom: 1.5rem;
			}

			table {
				width: 100%;
				background-color: #fff;
				border-radius: 12px;
				box-shadow: 0 3px 8px rgb(0 0 0 / 0.1);
				border-collapse: separate;
				border-spacing: 0;
				overflow: hidden;
			}

			thead tr {
				background-color: #d0e8ff; /* xanh nhẹ cho tiêu đề */
				color: #0d3b66;
				font-weight: 600;
			}

			thead th {
				padding: 12px 16px;
				text-align: center;
			}

			tbody td {
				padding: 12px 16px;
				text-align: center;
				vertical-align: middle;
				color: #0d3b66;
			}

			tbody tr:hover {
				background-color: #e3f2fd; /* xanh dương nhạt hover */
			}

			/* Nút thêm mới */
			.btn-add {
				background-color: #1976d2; /* xanh dương đậm */
				color: white;
				font-weight: 600;
				border-radius: 30px;
				padding: 8px 16px;
				display: inline-flex;
				align-items: center;
				gap: 6px;
				text-decoration: none;
				transition: background-color 0.3s ease;
			}

			.btn-add:hover {
				background-color: #0d47a1; /* xanh dương đậm hơn */
				color: white;
				text-decoration: none;
			}

			/* Link quyền */
			.quyen-link {
				color: #1976d2;
				font-weight: 600;
				transition: color 0.3s ease;
				text-decoration: none;
			}

			.quyen-link:hover {
				color: #0d47a1;
				text-decoration: underline;
			}

			/* Icon trạng thái */
			.status-icon {
				font-size: 1.3rem;
				vertical-align: middle;
			}

			.status-icon.active {
				color: #28a745; /* xanh lá */
			}

			.status-icon.inactive {
				color: #dc3545; /* đỏ */
			}

			/* Icon hành động Sửa Xóa */
			.action-icon {
				font-size: 1.3rem;
				color: #1976d2;
				transition: color 0.3s ease;
			}

			.action-icon:hover {
				color: #0d47a1;
				cursor: pointer;
			}

			/* Responsive */
			@media (max-width: 768px) {
				.container {
					padding: 1rem;
				}

				table {
					font-size: 0.9rem;
				}
			}

			@media (max-width: 576px) {
				.btn-add {
					width: 100%;
					justify-content: center;
					margin-bottom: 15px;
				}
			}
		.breadcrumb {
			background-color: #e3f2fd; /* nền xanh nhạt */
			padding: 0.5rem 1rem;
			border-radius: 12px;
			box-shadow: 0 2px 6px rgba(25, 118, 210, 0.2);
			font-weight: 600;
			margin-bottom: 1.5rem;
		}

		.breadcrumb a {
			color: #1976d2; /* màu xanh dương */
			text-decoration: none;
			transition: color 0.3s ease;
		}

		.breadcrumb a:hover {
			color: #1565c0;
			text-decoration: underline;
		}

		.breadcrumb-item + .breadcrumb-item::before {
			content: "›"; /* dấu phân cách */
			color: #1976d2;
			padding: 0 0.5rem;
		}

		.breadcrumb-item.active {
			color: #0d3b66; /* màu đậm cho item hiện tại */
		}
		</style>
	</head>

	<body>
		<div class="container">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
					<li class="breadcrumb-item active" aria-current="page">Người dùng</li>
				</ol>
        	</nav>
			<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
				<h4>Danh sách người dùng</h4>
			</div>

			<table>
				<thead>
					<tr>
						<th>Mã ND</th>
						<th>Họ và tên</th>
						<th>Tên đăng nhập</th>
						<th>Quyền</th>
						<!-- <th>Kích hoạt</th> -->
						<th>Sửa</th>
						<th>Xóa</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($danhsach->num_rows > 0) {
						while ($dong = $danhsach->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . htmlspecialchars($dong["MaNguoiDung"]) . "</td>";
							echo "<td>" . htmlspecialchars($dong["TenNguoiDung"]) . "</td>";
							echo "<td>" . htmlspecialchars($dong["TenDangNhap"]) . "</td>";

							echo "<td>";
							if ($dong["QuyenHan"] == 1)
								echo "Quản trị (<a href='nguoidung_kichhoat.php?id=" . urlencode($dong["MaNguoiDung"]) . "&quyen=2' class='quyen-link' title='Hạ quyền'><i class='bi bi-person-dash'></i></a>)";
							else
								echo "Thành viên (<a href='nguoidung_kichhoat.php?id=" . urlencode($dong["MaNguoiDung"]) . "&quyen=1' class='quyen-link' title='Nâng quyền'><i class='bi bi-person-plus'></i></a>)";
							echo "</td>";

							echo "<td>";
							if ($dong["Khoa"] == 0)
								echo "<a href='nguoidung_kichhoat.php?id=" . urlencode($dong["MaNguoiDung"]) . "&khoa=1' title='Kích hoạt'><i class='bi bi-check-circle-fill status-icon active'></i></a>";
							else
								echo "<a href='nguoidung_kichhoat.php?id=" . urlencode($dong["MaNguoiDung"]) . "&khoa=0' title='Khóa'><i class='bi bi-x-circle-fill status-icon inactive'></i></a>";
							echo "</td>";

							echo "<td><a href='suanguoidung.php?id=" . urlencode($dong["MaNguoiDung"]) . "' title='Sửa người dùng'><i class='bi bi-pencil-fill action-icon'></i></a></td>";

							echo "<td><a href='xoanguoidung.php?id=" . urlencode($dong["MaNguoiDung"]) . "' onclick='return confirm(\"Bạn có muốn xóa người dùng " . addslashes($dong['TenNguoiDung']) . " không?\")' title='Xóa người dùng'><i class='bi bi-trash-fill action-icon'></i></a></td>";
							echo "</tr>";
						}
					} else {
						echo "<tr><td colspan='7' class='text-center text-muted'>Không có người dùng nào.</td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>

		<!-- Bootstrap JS -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	</body>

	</html>
