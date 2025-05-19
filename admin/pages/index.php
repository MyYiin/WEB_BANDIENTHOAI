<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Trang Quản Trị</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    body {
      background-color: #f7f9fc; /* nền trắng/xám nhạt */
      color: #0d3b66; /* xanh dương đậm cho chữ */
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .sidebar {
      background-color: #e3f2fd; /* xanh dương nhạt */
      min-height: 100vh;
      padding: 1.5rem 1rem;
      border-right: 1px solid #cfd8dc;
    }
    .sidebar .nav-link {
      color: #0d3b66;
      font-weight: 600;
      margin-bottom: 0.8rem;
      border-radius: 8px;
      transition: background-color 0.3s ease;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .sidebar .nav-link:hover {
      background-color: #1976d2; /* xanh dương đậm hơn */
      color: #fff;
      text-decoration: none;
    }
    .sidebar .nav-link.text-warning {
      color: #d32f2f; /* đỏ để nổi bật nút đăng xuất */
    }
    main {
      padding: 2rem;
    }
    h1, h3, h5 {
      font-weight: 700;
      color: #0d3b66;
    }
    .dashboard-card {
      border-radius: 12px;
      box-shadow: 0 3px 8px rgb(0 0 0 / 0.1);
      background-color: #fff;
      padding: 1.5rem;
      transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    .dashboard-card:hover {
      box-shadow: 0 8px 16px rgb(0 0 0 / 0.15);
      transform: translateY(-4px);
    }
    .dashboard-card h5 {
      color: #0d3b66;
      margin-bottom: 0.5rem;
    }
    .dashboard-card.secondary {
      background-color: #d0e8ff; /* xanh nhẹ cho card phụ */
    }
    .stats {
      display: flex;
      gap: 2rem;
      flex-wrap: wrap;
    }
    .stats .dashboard-card {
      flex: 1 1 220px;
    }
    ul {
      padding-left: 1.5rem;
      color: #0d3b66;
    }
    ul li {
      margin-bottom: 0.6rem;
    }
    .btn-primary-action:hover {
      background-color: #e07b39;
      color: #fff;
    }
    /* Responsive sidebar + content */
    @media (min-width: 768px) {
      .row {
        display: flex;
      }
      .sidebar {
        width: 240px;
        flex-shrink: 0;
      }
      main {
        flex-grow: 1;
      }
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <nav class="col-md-3 col-lg-2 sidebar">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="#" data-load="dssanpham.php" data-form="themsanpham.php">
            <i class="fas fa-mobile-alt"></i> Danh sách sản phẩm
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" data-load="dskhachhang.php" data-form="themkhachhang.php">
            <i class="fas fa-user"></i> Danh sách khách hàng
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" data-load="dsnguoidung.php" data-form="themnguoidung.php">
            <i class="fas fa-lock"></i> Danh sách người dùng
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" data-load="dsnhasanxuat.php" data-form="themNSX.php">
            <i class="fas fa-industry"></i> Danh sách nhà sản xuất
          </a>
        </li>
         <li class="nav-item">
        <!-- Menu cha có submenu -->
        <a class="nav-link d-flex justify-content-between align-items-center" 
           data-bs-toggle="collapse" href="#donhangSubmenu" role="button" aria-expanded="false" aria-controls="donhangSubmenu">
          <span><i class="fas fa-industry"></i> Danh sách đơn hàng</span>
          <i class="fas fa-chevron-down"></i>
        </a>

        <!-- Submenu xổ xuống -->
        <div class="collapse" id="donhangSubmenu">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li>
              <a href="#" class="nav-link ps-4" data-load="dsdonhang.php">Tất cả đơn hàng</a>
            </li>
            <li>
              <a href="#" class="nav-link ps-4" data-load="dsdonhang.php?trangthai=0">Đơn hàng chưa xử lý</a>
            </li>
            <li>
              <a href="#" class="nav-link ps-4" data-load="dsdonhang.php?trangthai=1">Đơn hàng đã xong</a>
            </li>
          </ul>
        </div>
      </li>

        </li>
        <li class="nav-item mt-3">
          <a class="nav-link text-warning" href="../../dangxuat.php" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?')">
            <i class="fas fa-sign-out-alt"></i> Đăng xuất
          </a>
        </li>
      </ul>
    </nav>

    <!-- Main Content -->
    <main class="col-md-9 col-lg-10 py-4 px-5">
      <div id="content">
        <h3 class="mb-4">🎯 Trang quản trị hệ thống bán điện thoại</h3>
        <div class="stats">
          <div class="dashboard-card">
            <h5>🔥 <i class="fas fa-mobile-alt"></i> Sản phẩm</h5>
            <h3>120</h3>
            <p>Điện thoại đang bán</p>
          </div>
          <div class="dashboard-card secondary">
            <h5>📈 <i class="fas fa-users"></i> Khách hàng</h5>
            <h3>340</h3>
            <p>Người dùng đã đăng ký</p>
          </div>
          <div class="dashboard-card">
            <h5>💼 <i class="fas fa-file-invoice-dollar"></i> Đơn hàng</h5>
            <h3>78</h3>
            <p>Đơn hàng trong tháng</p>
          </div>
          <div class="dashboard-card secondary">
            <h5>🏭 <i class="fas fa-industry"></i> Nhà sản xuất</h5>
            <h3>12</h3>
            <p>Hãng điện thoại</p>
          </div>
        </div>

        <div class="mt-5">
          <h5>📢 Thông báo mới</h5>
          <ul>
            <li>Hệ thống sẽ bảo trì vào 2h sáng ngày 25/05.</li>
            <li>Cập nhật bảng giá sản phẩm tháng 6.</li>
            <li>Thêm chức năng quản lý khuyến mãi trong tuần tới.</li>
          </ul>
        </div>
      </div>
    </main>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="../js/index.js"></script>
</body>
</html>
