<?php
include("../includes/connect.php");

$sql = "SELECT * FROM tbl_nhasanxuat";
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

.table-responsive {
    border-radius: 8px;
    background-color: #ffffff;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
    overflow-x: auto;
}

table thead {
    background-color: #1976d2;
    color: #fff;
    font-weight: 600;
    border-bottom: 2px solid #1565c0;
}

table tbody tr:hover {
    background-color: #bbdefb;
}

.btn-outline-warning {
    color: #f57c00;
    border-color: #f57c00;
    font-weight: 600;
}

.btn-outline-warning:hover {
    background-color: #f57c00;
    color: white;
}

.btn-outline-danger {
    color: #e53946;
    border-color: #e53946;
    font-weight: 600;
}

.btn-outline-danger:hover {
    background-color: #9b2226;
    color: white;
}

@media (max-width: 576px) {
    .btn-add {
        width: 100%;
        justify-content: center;
        margin-bottom: 1rem;
    }
}
.table-responsive {
    border-radius: 12px;
    overflow: hidden; /* quan trọng để bo tròn phần con bên trong */
    background-color: #fff;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
}

/* Tô màu nền và bo góc trên cho thead */
table thead {
    background-color: #1976d2 !important; /* !important nếu bị ghi đè */
    color: #fff;
    font-weight: 600;
    border-bottom: 2px solid #1565c0;
}

table thead tr:first-child th:first-child {
    border-top-left-radius: 12px;
}

table thead tr:first-child th:last-child {
    border-top-right-radius: 12px;
}


    </style>
</head>
<body>
    <div class="container my-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <h2>Danh sách nhà sản xuất</h2>
            <a href="themnhaasanxuat.php" class="btn btn-add btn-sm" aria-label="Thêm nhà sản xuất mới">
                <i class="bi bi-plus-circle"></i> Thêm mới
            </a>
        </div>

        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr class="text-center">
                        <th style="width: 10%;">Mã NSX</th>
                        <th style="width: 60%;">Tên nhà sản xuất</th>
                        <th style="width: 15%;">Sửa</th>
                        <th style="width: 15%;">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($danhsach->num_rows > 0): ?>
                        <?php while ($row = $danhsach->fetch_assoc()): ?>
                            <tr>
                                <td class="text-center"><?= htmlspecialchars($row['IdNhaSanXuat']) ?></td>
                                <td><?= htmlspecialchars($row['TenNhaSanXuat']) ?></td>
                                <td class="text-center">
                                    <a href="suanhasanxuat.php?id=<?= urlencode($row['IdNhaSanXuat']) ?>" class="btn btn-sm btn-outline-warning" title="Sửa nhà sản xuất">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="xoanhasanxuat.php?id=<?= urlencode($row['IdNhaSanXuat']) ?>" class="btn btn-sm btn-outline-danger" title="Xóa nhà sản xuất" onclick="return confirm('Bạn có chắc chắn muốn xóa nhà sản xuất này?');">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">Không có nhà sản xuất nào.</td>
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
