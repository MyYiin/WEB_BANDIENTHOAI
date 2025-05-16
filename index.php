<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
   
    <link rel="stylesheet" href="user/CSS/index.css">
    <link rel="stylesheet" href="user/CSS/sanphammoi.css">
    <link rel="stylesheet" href="user/CSS/sanpham_danhsach.css">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo"></div>
            
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <button type="submit">Search</button>
            </div>

            <div class="user dropdown">
                <?php 
                    session_start(); 
                    $tenNguoiDung = $_SESSION['HoTen'] ?? null;
                ?>
                <?php if ($tenNguoiDung): ?>
                    <a class="btn btn-light dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-circle-user"></i> <?php echo htmlspecialchars($tenNguoiDung); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#">Tài khoản của tôi</a></li>
                        <li><a class="dropdown-item" href="dangxuat.php">Đăng xuất</a></li>
                    </ul>
                <?php else: ?>
                    <a href="dangnhap.php" class="btn btn-light text-dark">
                        <i class="fa-solid fa-circle-user"></i> Đăng nhập
                    </a>
                <?php endif; ?>
            </div>

            <div class="cart">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            
        </div>
        <div class="menu">
            <ul class="menu-list">
                <li><a href="#">Trang chủ</a></li>
                <li><a href="#">Danh mục</a></li>
                <li><a href="#">Liên hệ</a></li>
                <li><a href="#">Khách Hàng</a></li>
                <li><a href="#">Giới thiệu</a></li>
            </ul>
        </div>  

        <!-- main content -->
        <div id="content">
            <!-- banner -->
            <div class="owl-carousel owl-theme"> 
                <div class="item"><img src="user/banner/banner3.png" alt=""></div>
                <div class="item"><img src="user/banner/banner1.png" alt=""></div>
                <div class="item"><img src="user/banner/banner2.png" alt=""></div>
                <div class="item"><img src="user/banner/banner3.png" alt=""></div>
                <div class="item"><img src="user/banner/banner4.png" alt=""></div>
                <div class="item"><img src="user/banner/banner5.png" alt=""></div>
                <div class="item"><img src="user/banner/banner6.png" alt=""></div>
                <div class="item"><img src="user/banner/banner7.png" alt=""></div>
                <div class="item"><img src="user/banner/banner8.png" alt=""></div>
                <div class="item"><img src="user/banner/banner9.png" alt=""></div>
            </div>

            <div class="new_product">
                <?php
                    include("user/pages/sanpham_moi.php");
                ?>
            </div>

            <div class="product_list">
                <?php
                    include("user/pages/dssanpham.php")
                ?>
            </div>

            
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="../script/index.js"></script>
</body>
</html>