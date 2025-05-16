<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
   
    <link rel="stylesheet" href="user/CSS/index.css">
    <link rel="stylesheet" href="user/CSS/danhsachsanpham.css">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- owl carousel libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    
    <title>Document</title>
</head>
<body>
    <div class="container">

            <!-- Header -->
        <div class="header py-3 bg-white shadow-sm border-bottom">
        <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">

            <!-- Logo -->
            <div class="logo d-flex align-items-center">
                <a href="index.php"> <img src="images/logo.jpg" alt="Phone Store" height="100"></a>
            </div>

            <!-- Search -->
            <form class="search-bar d-flex flex-grow-1 mx-3" id="search-form" style="max-width: 500px;">
                <input class="form-control me-2" type="search" id="searchInput" name="search" placeholder="Tìm kiếm sản phẩm..." aria-label="Search" required>
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </form>


            <!-- User & Cart -->
            <div class="d-flex align-items-center gap-3">

            <?php 
                session_start(); 
                $tenNguoiDung = $_SESSION['HoTen'] ?? null;
            ?>

            <!-- User -->
            <div class="dropdown">
                <?php if ($tenNguoiDung): ?>
                <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-circle-user me-1"></i> <?php echo htmlspecialchars($tenNguoiDung); ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#">Tài khoản của tôi</a></li>
                    <li><a class="dropdown-item" href="dangxuat.php">Đăng xuất</a></li>
                </ul>
                <?php else: ?>
                <a href="dangnhap.php" class="btn btn-outline-primary">
                    <i class="fas fa-circle-user me-1"></i> Đăng nhập
                </a>
                <?php endif; ?>
            </div>

            <!-- Cart -->
             <?php $count = isset($_SESSION['cart']) ?array_sum($_SESSION['cart']) : 0 ?>
            <a href="user/pages/giohang.php" class="text-dark position-relative fs-5">
                <i class="fas fa-cart-shopping"></i>
                <?php if($count > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.75rem; min-width: 1.5em;">
                        <?= $count ?>
                    </span>
                <?php endif; ?>
            </a>
            </div>
        </div>
        </div>

        <!-- Menu chính -->
        <div class="menu bg-primary text-white">
        <div class="container">
            <ul class="nav justify-content-center py-2">
            
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php">Trang chủ</a>
            </li>

            <!-- Dropdown hover -->
            <li class="nav-item position-relative group">
               <a class="nav-link text-white d-flex align-items-center gap-2" href="#">Danh mục <i class="fas 	fa-angle-down small"></i> </a>
                <ul class="dropdown-menu-custom">
                    <li><a class="dropdown-item-custom" href="#" onclick="selectSearch('iPhone')">iPhone</a></li>
                    <li><a class="dropdown-item-custom" href="#" onclick="selectSearch('Samsung')">Samsung</a></li>
                    <li><a class="dropdown-item-custom" href="#" onclick="selectSearch('Xiaomi')">Xiaomi</a></li>
                    <li><a class="dropdown-item-custom" href="#" onclick="selectSearch('Oppo')">Oppo</a></li>
                </ul>
            </li>

           <li class="nav-item"><a class="nav-link text-white" href="#contact-section">Liên hệ</a></li>
           <li class="nav-item"><a class="nav-link text-white" href="#about-section">Giới thiệu</a></li>

            </ul>
        </div>
        </div>

        <!-- main content -->
        <div id="content">
            <?php
                if(isset($_GET['search']) && !empty(trim($_GET['search']))){
                   ?>
                    <div class="container py-4">
                        <?php include("user/pages/timkiem_xuly.php");?>
                    </div>
                    <?php
                }
                else
                {?>
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
                    
                    <div class="danhsach">
                        <?php
                            include("user/pages/danhsachsanpham.php");
                        ?>
                    </div>
                      <?php
                } 
                ?>
        </div>

        <footer class="bg-dark text-white mt-5 p-4">
            <div class="row">
                <div class="col-md-4">
                    <h6>Chính sách</h6>
                    <ul class="list-unstyled">
                        <li>Bảo hành 12 tháng</li>
                        <li>Đổi trả trong 7 ngày</li>
                        <li>Giao hàng toàn quốc</li>
                    </ul>
                </div>
                    <div class="col-md-4">
                    <h6>Liên hệ</h6>
                    <p>Hotline: 1900 1234<br>Email: support@phonestore.vn</p>
                </div>
                <div class="col-md-4">
                    <h6>Địa chỉ</h6>
                    <p>123 Nguyễn Trãi, Q.1, TP.HCM</p>
                </div>
            </div>
        </footer>

    </div>

                <!-- Giới thiệu -->
            <section id="about-section" class="bg-light py-5 border-top">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-8 text-center">
                            <h2 class="text-primary fw-bold mb-4">Giới thiệu về Phone Store</h2>
                            <p class="lead mb-3">
                                <strong>Phone Store</strong> là cửa hàng chuyên cung cấp các dòng điện thoại chính hãng từ các thương hiệu hàng đầu như <span class="text-primary">Apple</span>, <span class="text-success">Samsung</span>, <span class="text-warning">Xiaomi</span>, <span class="text-danger">Oppo</span> và nhiều hãng nổi tiếng khác.
                            </p>
                            <p>
                                Với phương châm <em>“Uy tín – Chất lượng – Giá tốt”</em>, chúng tôi luôn nỗ lực không ngừng để mang đến cho khách hàng trải nghiệm mua sắm tốt nhất, dịch vụ tận tâm và sản phẩm đáng tin cậy.
                            </p>
                            <p>
                                Hệ thống của chúng tôi hỗ trợ <strong>giao hàng toàn quốc</strong>, <strong>bảo hành chính hãng</strong> và <strong>đổi trả trong vòng 7 ngày</strong>. Đội ngũ nhân viên thân thiện, nhiệt tình luôn sẵn sàng hỗ trợ bạn mọi lúc.
                            </p>
                        </div>
                    </div>
                </div>
            </section>


        <!-- Liên hệ -->
        <section id="contact-section" class="py-5 bg-white border-top">
            <div class="container">
                <h2 class="text-center text-primary mb-4">Liên hệ với chúng tôi</h2>
                <form class="row g-3" method="post" action="#">
                    <div class="col-md-6">
                        <label for="contactName" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="contactName" name="name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="contactEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="contactEmail" name="email" required>
                    </div>
                    <div class="col-12">
                        <label for="contactMessage" class="form-label">Nội dung</label>
                        <textarea class="form-control" id="contactMessage" name="message" rows="5" required></textarea>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary px-4">Gửi liên hệ</button>
                    </div>
                </form>
            </div>
        </section>


    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script src="user/script/index.js"></script>
    <script src="user/script/xemchitiet.js"></script>
    <script src="user/script/loadmore.js"></script>
    <script src="user/script/timkiem.js"></script>
     <script src="user/script/timkiem_menu.js"></script>
</body>
</html>