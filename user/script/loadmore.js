$(".load-more").click(function () {
  var row = Number($("#row").val());
  var all = Number($('#all').val());

  if(row < all){
    $.ajax({
      url:"user/pages/sanpham_load-more.php",
      type:"POST",
      data:{cot: row},
      success: function(data){
        $(".product-list").append(data);
        $('#row').val(row + 5)  // Mỗi lần thêm 5 sản phẩm

        if((row + 5) >= all){
          $(".load-more").hide();
        }
      }
    });
  }
});