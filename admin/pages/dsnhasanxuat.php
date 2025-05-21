<?php
include("../includes/connect.php");

$sql = "SELECT * FROM tbl_nhasanxuat ORDER BY IdNhaSanXuat ASC";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f0f4fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 900px;
        }
        h2 {
            font-weight: bold;
            color: #0d3b66;
            font-size: 1.6rem;
        }
        .breadcrumb {
            background-color: #e3f2fd;
            padding: 0.6rem 1.2rem;
            border-radius: 12px;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }
        .breadcrumb a {
            color: #1976d2;
            text-decoration: none;
        }
        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            padding: 0 0.5rem;
            color: #1976d2;
        }
        .btn-add {
            background-color: #1976d2;
            color: white;
            border-radius: 30px;
            padding: 6px 16px;
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(25, 118, 210, 0.3);
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }
        .btn-add:hover {
            background-color: #1565c0;
            color: white;
        }
        table {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        th {
            background-color: #1976d2;
            color: white;
            font-weight: 600;
            padding: 14px 16px;
            text-align: center;
            border-bottom: 2px solid #1565c0;
        }

        thead tr {
            background-color: #1976d2;
            color: white;
            font-weight: 600;
        }

        .btn-add i {
            color: white;
            font-size: 1.1rem;
        }

        .btn-outline-warning:hover i {
            color: black;
        }
        .btn-outline-danger:hover i {
            color: white;
        }

        td, th {
            vertical-align: middle !important;
        }
        thead tr {
            background-color: #1976d2;
            color: white;
            font-weight: 600;
        }
        .btn-outline-warning:hover {
            background-color: #ffc107;
            color: black;
        }
        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
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

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Danh sách nhà sản xuất</h2>
            <a href="themNSX.php" class="btn btn-add btn-sm">
                <i class="bi bi-plus-circle"></i> Thêm mới
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th style="width: 10%;">Mã NSX</th>
                        <th style="width: 60%;" class="text-start ps-4">Tên nhà sản xuất</th>
                        <th style="width: 15%;">Sửa</th>
                        <th style="width: 15%;">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($danhsach->num_rows > 0): ?>
                        <?php while ($row = $danhsach->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['IdNhaSanXuat']) ?></td>
                                <td class="text-start ps-4"><?= htmlspecialchars($row['TenNhaSanXuat']) ?></td>
                                <td>
                                    <a href="suanhasanxuat.php?id=<?= urlencode($row['IdNhaSanXuat']) ?>" class="btn btn-sm btn-outline-warning" title="Sửa nhà sản xuất">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="xoanhasanxuat.php?id=<?= urlencode($row['IdNhaSanXuat']) ?>" class="btn btn-sm btn-outline-danger" title="Xóa nhà sản xuất" onclick="return confirm('Bạn có chắc chắn muốn xóa nhà sản xuất này?');">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-muted">Không có nhà sản xuất nào.</td>
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
