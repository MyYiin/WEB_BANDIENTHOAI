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