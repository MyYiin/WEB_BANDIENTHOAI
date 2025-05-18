$('#search-form').on('submit', function(e){
    e.preventDefault(); // Ngăn load trang

    const searchValue = $('input[name="search"]').val().trim();
    if(searchValue !== ''){
        const encodedKeyword = encodeURIComponent(searchValue);
        window.location.href = `index.php?search=${encodedKeyword}`;
    } else {
        alert("Hãy nhập từ khóa tìm kiếm.");
    }
});