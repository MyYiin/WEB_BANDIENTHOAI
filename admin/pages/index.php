<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
   
    <link rel="stylesheet" href="../CSS/index.css">
    <!-- <link rel="stylesheet" href="../CSS/sanphammoi.css"> -->
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    
    <title>Trang Chủ</title>
</head>
<body>
    <div>
        
        <div class="container">
            <div class="menu">
                <ul class="menu-list">
                    <li><a href="#" id="loadSanPham">Danh sách sản phẩm</a></li>
                    <li><a href="#" id="loadKhachHang">Danh sách khách hàng</a></li>
                    <li><a href="#" id="loadNguoiDung">Danh sách người dùng</a></li>
                    <li><a href="#" id="loadNhaSanXuat">Danh sách nhà sản xuất</a></li>
                </ul>
            </div>  
            <!-- main content -->
            <div id="content">
                <!-- Nội dung khi load cái trang -->
                 <?php
					// $do = isset($_GET['do']) ? $_GET['do'] : "home";

					// include $do . ".php";
				?>
            </div>
        
        </div>
    </div>

   <script>
        function loadContent(endpoint, errorMessage, formEndpoint) {
            fetch(endpoint)
                .then(response => {
                    if (!response.ok) throw new Error("Lỗi kết nối");
                    return response.text();
                })
                .then(data => {
                    const contentDiv = document.getElementById('content');
                    contentDiv.innerHTML = data;

                    // Tạo nút Thêm ở góc phải bên dưới
                    const addButton = document.createElement('button');
                    addButton.textContent = 'Thêm';
                    addButton.classList.add('add-button');
                    contentDiv.appendChild(addButton);

                    // Khi bấm Thêm, thay nội dung bằng form thêm
                    addButton.addEventListener('click', () => {
                        fetch(formEndpoint)
                            .then(response => {
                                if (!response.ok) throw new Error("Không thể tải form.");
                                return response.text();
                            })
                            .then(formHTML => {
                                contentDiv.innerHTML = formHTML;
                            })
                            .catch(error => {
                                contentDiv.innerHTML = `<p>${error.message}</p>`;
                                console.error(error);
                            });
                    });
                })
                .catch(error => {
                    document.getElementById('content').innerHTML = `<p>${errorMessage}</p>`;
                    console.error(error);
                });
        }

        // Gán sự kiện các menu
        document.getElementById('loadSanPham').addEventListener('click', function(e) {
            e.preventDefault();
            loadContent('dssanpham.php', 'Không thể tải danh sách sản phẩm.', 'themsanpham.php');
        });

        document.getElementById('loadKhachHang').addEventListener('click', function(e) {
            e.preventDefault();
            loadContent('dskhachhang.php', 'Không thể tải danh sách khách hàng.', 'themkhachhang.php');
        });

        document.getElementById('loadNguoiDung').addEventListener('click', function(e) {
            e.preventDefault();
            loadContent('dsnguoidung.php', 'Không thể tải danh sách người dùng.', 'themnguoidung.php');
        });

        document.getElementById('loadNhaSanXuat').addEventListener('click', function(e) {
            e.preventDefault();
            loadContent('dsnhasanxuat.php', 'Không thể tải danh sách nhà sản xuất.', 'themNSX.php');
        });
    </script>



    <!-- JavaScript
    <script src="Script/index.js"></script> -->
</body>
</html>