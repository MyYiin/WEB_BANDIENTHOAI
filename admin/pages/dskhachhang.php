<?php
	include("../includes/connect.php"); 

	$sql = "SELECT * FROM tbl_khachhang"; 
	$danhsach = $connect->query($sql); 

	if (!$danhsach) { 
		die("Không thể thực hiện câu lệnh SQL: ". $connect->error); 
	}
?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
      background-color: #f7f9fc; /* nền trắng/xám nhạt */
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #0d3b66; /* chữ xanh dương đậm */
    }

    /* Tiêu đề danh sách */
    .title-header {
      color: #0d3b66; /* xanh dương đậm */
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1.2px;
      font-size: 1.8rem;
      margin-bottom: 20px;
    }

    /* Nút Thêm khách hàng */
    .btn-warm {
      background-color: #1976d2; /* xanh dương đậm */
      color: white;
      font-weight: 600;
      padding: 8px 16px;
      border-radius: 30px;
      box-shadow: 0 4px 8px rgba(25, 118, 210, 0.4);
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      text-decoration: none;
      white-space: nowrap;
    }

    .btn-warm:hover,
    .btn-warm:focus {
      background-color: #1565c0; /* xanh dương đậm hơn */
      box-shadow: 0 6px 12px rgba(21, 101, 192, 0.6);
      color: white;
      text-decoration: none;
    }

    .btn-warm i {
      font-size: 1.1rem;
      line-height: 1;
    }

    /* Bảng */
    table {
      background-color: #ffffff; /* trắng */
      border: 2px solid #1976d2; /* viền xanh dương */
      border-radius: 8px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      width: 100%;
      table-layout: fixed; /* cố định độ rộng cột */
    }

    thead tr {
      background-color: #1976d2; /* nền xanh dương */
      color: #fff;
      font-weight: 600;
    }

    tbody tr {
      transition: background-color 0.3s ease;
    }

    tbody tr:hover {
      background-color: #bbdefb; /* xanh dương nhạt khi hover */
    }

    tbody td {
      vertical-align: middle;
      color: #0d3b66; /* chữ xanh dương đậm */
      word-wrap: break-word;
      text-align: center;
    }

    /* Căn trái cho các cột tên, địa chỉ để dễ đọc */
    tbody td:nth-child(2),
    tbody td:nth-child(6) {
      text-align: left;
      padding-left: 10px;
    }

    /* Nút Sửa */
    .btn-edit {
      color: #64b5f6; /* xanh nhạt */
      font-size: 1.2rem;
      transition: color 0.3s ease;
    }

    .btn-edit:hover {
      color: #1565c0; /* xanh đậm khi hover */
      text-decoration: none;
    }

    /* Nút Xóa */
    .btn-delete {
      color: #e53946; /* đỏ nổi bật */
      font-size: 1.2rem;
      transition: color 0.3s ease;
    }

    .btn-delete:hover {
      color: #9b2226; /* đỏ đậm khi hover */
      text-decoration: none;
    }

    /* Căn giữa header */
    th {
      text-align: center;
      vertical-align: middle;
      padding: 12px 8px;
    }

    /* Căn giữa icon trong nút */
    td a i {
      pointer-events: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .container {
        padding: 0 10px;
      }

      table {
        font-size: 0.9rem;
      }
    }

    @media (max-width: 576px) {
      .d-flex.justify-content-between {
        flex-direction: column;
        gap: 10px;
      }

      .btn-warm {
        width: 100%;
        justify-content: center;
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

<div class="container my-4">

   <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Khách hàng</li>
            </ol>
        </nav>

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="title-header mb-0">Danh sách khách hàng</h2>
    <a href="themkhachhang.php" class="btn btn-warm btn-add">
      <i class="bi bi-plus-circle"></i> Thêm khách hàng
    </a>
  </div>

  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th style="width: 8%;">Mã KH</th>
        <th style="width: 20%;">Họ và tên</th>
        <th style="width: 8%;">Năm sinh</th>
        <th style="width: 8%;">Giới tính</th>
        <th style="width: 14%;">Số Điện Thoại</th>
        <th style="width: 26%;">Địa Chỉ</th>
        <th style="width: 8%;">Sửa</th>
        <th style="width: 8%;">Xóa</th>
      </tr>
    </thead>
    <tbody>
      <?php	
      if ($danhsach->num_rows > 0) {
        while ($row = $danhsach->fetch_array(MYSQLI_ASSOC)) { 
          echo "<tr>"; 
          echo "<td>" . htmlspecialchars($row['MaKH']) . "</td>"; 
          echo "<td>" . htmlspecialchars($row['HoVaTen']) . "</td>"; 
          echo "<td>" . htmlspecialchars($row['NamSinh']) . "</td>"; 
          echo "<td>" . (($row['GioiTinh'] == 0) ? "Nam" : "Nữ") . "</td>"; 
          echo "<td>" . htmlspecialchars($row['SoDienThoai']) . "</td>"; 
          echo "<td>" . htmlspecialchars($row['DiaChi']) . "</td>"; 

          echo "<td class='text-center'><a href='suakhachhang.php?id=" . urlencode($row['MaKH']) . "' class='btn-edit' title='Sửa khách hàng'><i class='bi bi-pencil-fill'></i></a></td>"; 

          echo "<td class='text-center'><a href='xoakhachhang.php?id=" . urlencode($row['MaKH']) . "' onclick=\"return confirm('Bạn có chắc chắn muốn xóa khách hàng này?');\" class='btn-delete' title='Xóa khách hàng'><i class='bi bi-trash-fill'></i></a></td>"; 

          echo "</tr>"; 
        }
      } else {
        echo "<tr><td colspan='8' class='text-center text-muted'>Không có khách hàng nào.</td></tr>";
      }

      $connect->close();
      ?>
    </tbody>
  </table>
</div>
