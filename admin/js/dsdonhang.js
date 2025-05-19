document.querySelectorAll('[data-load]').forEach(link=>{
    link.addEventListener('click', function(e){
        e.preventDefault();

        const url = this.getAttribute('data-load');

        fetch(url)
        .then(response => response.text())
        .then(html =>{
            document.getElementById('main-content').innerHTML = html;
        })
        .catch(error => {
           document.getElementById('main-content').innerHTML = '<div class="alert alert-danger">Lỗi tải dữ liệu!</div>';
                console.error('Lỗi khi tải nội dung:', error);
        });
    })
});