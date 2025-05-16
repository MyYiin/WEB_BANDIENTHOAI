$(document).ready(function () {
  // Load more data
  $(".load-more").click(function () {
    // Sản phẩm đang hiển thị
    var sp = Number($("#row").val());
    var tongsp = Number($("#all").val());
    var sanphammoi = 5;
    sp = sp + sanphammoi;

    if (sp <= tongsp) {
      $("#row").val(sanphammoi);

      $.ajax({
        url: 'user/pages/sanpham_load-more.php',
        type: "post",
        data: { cot: sp },
        beforeSend: function () {
          $(".load-more").text("Đang tải...");
        },
        success: function (response) {
          
          setTimeout(function () {
          
            $(".danhsach .danhsachsanpham").append(response).show().fadeIn("slow");

            //Kiểm tra số sản phẩm còn lại
            var spton = row + sanphammoi;

            if (spton > tongsp) {
              // Change the text and background
              $(".load-more").text("Ẩn bớt");
              $(".load-more").css("background", "darkorchid");
            } else {
              $(".load-more").text("Xem thêm");
            }
          }, 500);
        },
      });
    } else {
      $(".load-more").text("Đang ẩn...");

      // Setting little delay while removing contents
      setTimeout(function () {
        $(".khungsanpham").slice(10).remove();
        $("#row").val(10);
          $(".load-more").text("Xem thêm");
          $(".load-more").css("background","#0d6efd")
      }, 500);
    }
  });
});
