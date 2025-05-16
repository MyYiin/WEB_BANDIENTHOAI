$(document).ready(function () {
    // Khởi tạo owl-carousel
    $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            1000: { items: 3 }
        }
    });

    // Bắt sự kiện click vào sản phẩm
    $(document).on('click', '.xemchitiet', function (e) {
        e.preventDefault();

        let id_sp = $(this).data('id_sp');
        let id_nsx = $(this).data('id_nsx');

        $.ajax({
            url: 'user/pages/sanpham_chitiet.php',
            method: 'GET',
            data: { id_sp: id_sp, id_nsx: id_nsx },
            success: function (response) {
                $('#content').html(response); // Gán nội dung chi tiết vào #content
            },
            error: function () {
                alert('Đã xảy ra lỗi khi tải chi tiết sản phẩm.');
            }
        });
    });
});
