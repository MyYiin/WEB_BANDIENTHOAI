<?php
    include("../includes/connect.php"); 

    $sql = "SELECT t.IdSanPham, t.TenSanPham, t.IdNhaSanXuat, t.HinhAnh, t.DonGia, t.SoLuong, 
                   t.MoTa, t.CauHinh, t.TiLeGiamGia, t.LuotXem, l.TenNhaSanXuat
            FROM tbl_nhasanxuat l 
            INNER JOIN tbl_sanpham t ON t.IdNhaSanXuat = l.IdNhaSanXuat
            ORDER BY t.IdSanPham DESC";

    $danhsach = $connect->query($sql); 

    if (!$danhsach) { 
        die("Không thể thực hiện câu lệnh SQL: ". $connect->error); 
    }
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Danh sách sản phẩm</title>

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
            max-width: 1200px;
        }

        h4 {
            font-weight: 700;
            color: #0d3b66;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        h4 i {
            color: #1976d2;
        }

        /* Nút thêm mới */
        .btn-add {
            background-color: #1976d2;
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
            background-color: #0d47a1;
            color: white;
            text-decoration: none;
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
            background-color: #d0e8ff;
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

        tbody td.text-start {
            text-align: left;
        }

        tbody tr:hover {
            background-color: #e3f2fd;
        }

        .img-thumbnail {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #90caf9;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            margin: auto;
            display: block;
        }

        /* Nút sửa */
        .btn-edit {
            color: #1976d2;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .btn-edit:hover {
            color: #0d47a1;
            text-decoration: none;
        }

        /* Nút xóa */
        .btn-delete {
            color: #dc3545;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .btn-delete:hover {
            color: #a71d2a;
            text-decoration: none;
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

            thead {
                display: none;
            }

            table, tbody, tr, td {
                display: block;
                width: 100%;
            }

            tr {
                margin-bottom: 1rem;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                border-radius: 12px;
                padding: 1rem;
                background-color: #fff;
            }

            td {
                text-align: right;
                padding-left: 50%;
                position: relative;
                border: none;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 1rem;
                width: 45%;
                padding-left: 0.5rem;
                font-weight: 600;
                text-align: left;
                color: #1976d2;
            }

            td img.img-thumbnail {
                position: static;
                width: 100%;
                height: auto;
                object-fit: contain;
                border-radius: 8px;
                margin-bottom: 0.5rem;
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
                <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
            <h4><i class="bi bi-phone"></i> Danh sách sản phẩm</h4>
            <a href="themsanpham.php" class="btn-add" aria-label="Thêm sản phẩm mới">
                <i class="bi bi-plus-circle"></i> Thêm mới
            </a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Mã</th>
                    <th>Tên sản phẩm</th>
                    <th>Nhà sản xuất</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Hình ảnh</th>
                    <th>Giảm giá (%)</th>
                    <th>Mô tả</th>
                    <th>Cấu hình</th>
                    <th>Lượt xem</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($danhsach->num_rows > 0) {
                    while ($row = $danhsach->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['IdSanPham']) . "</td>";
                        echo "<td class='text-start'>" . htmlspecialchars($row['TenSanPham']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['TenNhaSanXuat']) . "</td>";
                        echo "<td>" . number_format($row['DonGia'], 0, ',', '.') . "₫</td>";
                        echo "<td>" . htmlspecialchars($row['SoLuong']) . "</td>";
                        echo "<td><img src='../../images/" . htmlspecialchars($row['HinhAnh']) . "' alt='" . htmlspecialchars($row['TenSanPham']) . "' class='img-thumbnail'></td>";
                        echo "<td>" . htmlspecialchars($row['TiLeGiamGia']) . "%</td>";
                        echo "<td class='text-start'>" . htmlspecialchars($row['MoTa']) . "</td>";
                        echo "<td class='text-start'>" . htmlspecialchars($row['CauHinh']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['LuotXem']) . "</td>";
                        echo "<td><a href='suasanpham.php?id=" . urlencode($row['IdSanPham']) . "' class='btn-edit' title='Sửa sản phẩm'><i class='bi bi-pencil-fill'></i></a></td>";
                        echo "<td><a href='xoasanpham.php?id=" . urlencode($row['IdSanPham']) . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa sản phẩm này?\")' class='btn-delete' title='Xóa sản phẩm'><i class='bi bi-trash-fill'></i></a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12' class='text-center text-muted'>Không có sản phẩm nào.</td></tr>";
                }
                $connect->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
