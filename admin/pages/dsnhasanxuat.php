<?php
include("../includes/connect.php");

// Lấy dữ liệu danh sách nhà sản xuất
$sql = "SELECT * FROM tbl_nhasanxuat ORDER BY MaNhaSanXuat ASC";
$danhsach = $connect->query($sql);

if (!$danhsach) {
    die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Danh sách Nhà sản xuất</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f7f9fc;
            color: #0d3b66;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        h2 {
            font-weight: 700;
            color: #0d3b66;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-size: 1.8rem;
        }
        .btn-add {
            background-color: #1976d2;
            color: white;
            font-weight: 600;
            border-radius: 30px;
            box-shadow: 0 4px 8px rgba(25, 118, 210, 0.4);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            padding: 8px 16px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            white-space: nowrap;
        }
        .btn-add:hover {
            background-color: #1565c0;
            box-shadow: 0 6px 12px rgba(21, 101, 192, 0.6);
            color: white;
            text-decoration: none;
        }
        .breadcrumb {
            background-color: #e3f2fd;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(25, 118, 210, 0.2);
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        .breadcrumb a {
            color: #1976d2;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .breadcrumb a:hover {
            color: #1565c0;
            text-decoration: underline;
        }
        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: #1976d2;
            padding: 0 0.5rem;
        }
        .breadcrumb-item.active {
            color: #0d3b66;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nhà sản xuất</li>
            </ol>
        </nav>

        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <h2>Danh sách nhà sản xuất</h2>
            <a href="themnhasanxuat.php" class="btn btn-add btn-sm" aria-label="Thêm nhà sản xuất mới">
                <i class="bi bi-plus-circle"></i> Thêm mới
            </a>
        </div>

        <div class="table-responsive shadow-sm rounded">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Mã nhà sản xuất</th>
                        <th>Tên nhà sản xuất</th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>
                        <th>Email</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($danhsach->num_rows > 0): ?>
                    <?php while ($dong = $danhsach->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($dong["MaNhaSanXuat"]) ?></td>
                            <td><?= htmlspecialchars($dong["TenNhaSanXuat"]) ?></td>
                            <td><?= htmlspecialchars($dong["DiaChi"]) ?></td>
                            <td><?= htmlspecialchars($dong["DienThoai"]) ?></td>
                            <td><?= htmlspecialchars($dong["Email"]) ?></td>
                            <td>
                                <a href="suanhasanxuat.php?id=<?= urlencode($dong["MaNhaSanXuat"]) ?>" 
                                   class="btn btn-outline-warning btn-sm" 
                                   title="Sửa nhà sản xuất">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            </td>
                            <td>
                                <a href="xoanhasanxuat.php?id=<?= urlencode($dong["MaNhaSanXuat"]) ?>" 
                                   class="btn btn-outline-danger btn-sm" 
                                   onclick="return confirm('Bạn có chắc muốn xóa nhà sản xuất <?= addslashes($dong['TenNhaSanXuat']) ?> không?');"
                                   title="Xóa nhà sản xuất">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">Chưa có nhà sản xuất nào.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
