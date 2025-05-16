$(document).ready(function () {
    // Khởi tạo owl-carousel
    $(".owl-carousel").owlCarousel({ 
       loop: true,                // Cho phép chạy vòng lặp vô hạn
        margin: 10,                // Khoảng cách giữa các item
        nav: true,                 // Hiện nút điều hướng (mũi tên)
        autoplay: true,            // Tự động chạy
        autoplayTimeout: 3000,     // Thời gian giữa 2 lần chuyển (ms) — 3 giây
        autoplayHoverPause: true, // Tạm dừng khi người dùng di chuột vào (có thể bỏ nếu muốn chạy liên tục)
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            1000: { items: 3 }
        }
    });
});
