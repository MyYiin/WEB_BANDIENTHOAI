<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang Quản Trị</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../CSS/index.css">

  <style>
 
  </style>
</head>
<body>

<div class="container">
  <!-- Sidebar -->
  <div class="menu">
    <ul class="menu-list">
        <li><a href="#" data-load="dssanpham.php" data-form="themsanpham.php">📱 Danh sách sản phẩm</a></li>
        <li><a href="#" data-load="dskhachhang.php" data-form="themkhachhang.php">👤 Danh sách khách hàng</a></li>
        <li><a href="#" data-load="dsnguoidung.php" data-form="themnguoidung.php">🔐 Danh sách người dùng</a></li>
        <li><a href="#" data-load="dsnhasanxuat.php" data-form="themNSX.php">🏭 Danh sách nhà sản xuất</a></li>
        <li> <a href="../../dangxuat.php" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?')">🚪 Đăng xuất</a></li>
    </ul>
  </div>

  <!-- Main content -->
  <div id="content">
    <h3>Chào mừng đến trang quản trị</h3>
    <p>Chọn một mục ở menu bên trái để thao tác.</p>
  </div>
</div>

<script>
  function loadContent(endpoint, formEndpoint) {
    fetch(endpoint)
      .then(res => {
        if (!res.ok) throw new Error("Lỗi khi tải dữ liệu.");
        return res.text();
      })
      .then(data => {
        const content = document.getElementById("content");
        content.innerHTML = data;

        // Tạo nút thêm
        const addBtn = document.createElement("button");
        addBtn.textContent = "Thêm";
        addBtn.classList.add("add-button");
        content.appendChild(addBtn);

        addBtn.addEventListener("click", () => {
          fetch(formEndpoint)
            .then(res => {
              if (!res.ok) throw new Error("Lỗi khi tải form.");
              return res.text();
            })
            .then(html => content.innerHTML = html)
            .catch(err => content.innerHTML = `<p>${err.message}</p>`);
        });
      })
      .catch(err => {
        document.getElementById("content").innerHTML = `<p class="text-danger">${err.message}</p>`;
      });
  }

  // Bắt sự kiện cho các link menu
 document.querySelectorAll(".menu-list a").forEach(link => {
  link.addEventListener("click", e => {
    const endpoint = link.dataset.load;
    const formEndpoint = link.dataset.form;

    // Chỉ xử lý fetch nếu có data-load (bỏ qua Đăng xuất)
    if (!endpoint) return;

    e.preventDefault(); // ngăn link chuyển trang
    loadContent(endpoint, formEndpoint);
  });
});


</body>
</html>
