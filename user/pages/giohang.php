<?php
    session_start();

    include('../includes/connect.php');

    // Kiem tra dang nhap
    if (!isset($_SESSION['MaND'])) {
        header("Location: ../../dangnhap.php?msg=must_login_to_buy");
        exit();
    }

    //Thêm sản phẩm vào giỏ hàng
    if (isset($_GET['action']) && $_GET['action'] == 'add' && isset($_GET['id_sp'])) {
        $id = intval($_GET['id_sp']);    //ep kieu so

        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }

        if(!isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id] = 1;
        }
        else{
            $_SESSION['cart'][$id] +=1;
        }
        header("Location: giohang.php");
        exit();
    }

    // Xoa san pham
    if(isset($_GET['remove'])){
        $remove_id = intval($_GET['remove']);
        unset($_SESSION['cart'][$remove_id]);
        header("Location: giohang.php");
        exit();
    }

    // Cap nhat gio hang

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update_cart'])){
        foreach($_POST['quantities'] as $id => $qty){
            $_SESSION['cart'][$id] = max(1, (int)$qty); // it nhat la 1
        }
        header("Location: giohang.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    <style>
        .breadcrumb 
        {
        background-color: transparent;
        font-size: 0.95rem;
        }
        .breadcrumb a {
            text-decoration: none;
            color: #007bff;
        }
        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .table th {
            background-color: #e3f2fd;
            font-weight: bold;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.4em 0.6em;
        }

    </style>
<body>
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../../index.php">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
    </ol>
</nav>

    <h2 class="text-center text-primary fw-bold mb-4">🛒 Giỏ hàng của bạn</h2>

    <?php if (empty($_SESSION['cart'])): ?>
        <p class="text-center text-danger">Giỏ hàng của bạn đang trống.</p>
    <?php else: ?>
        <form method="post">
            <table class="table table-bordered text-center align-middle shadow-sm">
                <thead class="table-secondary">
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $id => $qty):
                    $stmt = $connect->prepare("SELECT * FROM tbl_sanpham WHERE IdSanPham = ?");
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $product = $stmt->get_result()->fetch_assoc();
                    $subtotal = $product['DonGia'] * $qty;
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><img src="../images/<?= $product['HinhAnh'] ?>" alt="" width="80"></td>
                        <td><?= $product['TenSanPham'] ?></td>
                        <td class="text-danger"><?= number_format($product['DonGia']) ?>₫</td>
                        <td>
                            <input type="number" name="quantities[<?= $id ?>]" value="<?= $qty ?>" min="1" class="form-control text-center" style="width: 80px;">
                        </td>
                        <td class="fw-bold text-primary"><?= number_format($subtotal) ?>₫</td>
                        <td>
                            <a href="giohang.php?remove=<?= $id ?>" class="btn btn-sm btn-danger">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-between">
                <button type="submit" name="update_cart" class="btn btn-warning">
                    <i class="fas fa-sync-alt"></i> Cập nhật giỏ hàng
                </button>
                <h4 class="text-end">Tổng cộng: <span class="text-success"><?= number_format($total) ?>₫</span></h4>
            </div>

            <div class="text-end mt-3">
                <a href="checkout.php" class="btn btn-success">
                    <i class="fas fa-credit-card"></i> Tiến hành đặt hàng
                </a>
            </div>
        </form>
    <?php endif; ?>
</div>
</body>
</html>