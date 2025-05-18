function selectSearch(keyword){
    const encodedKeyword = encodeURIComponent(keyword.trim());
    window.location.href = `index.php?search=${encodedKeyword}`;
}