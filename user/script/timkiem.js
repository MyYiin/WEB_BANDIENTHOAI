$('#search-form').on('submit', function(e){
    e.preventDefault(); // Ngăn load trang

    var searchValue = $('input[name="search"]').val().trim();

    if(searchValue !== ''){
        $.get("user/pages/timkiem_xuly.php", {search: searchValue}, function(response){
            $('#content').html(response); // thay toàn bộ nội dung chính bằng kết quả
        });
    }
    else{
        alert("Hãy nhập từ khóa tìm kiếm.");
    }
});