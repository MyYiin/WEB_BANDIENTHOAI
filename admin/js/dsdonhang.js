// Xử lý sự kiện khi click vào liên kết có thuộc tính data-load
document.querySelectorAll('[data-load]').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        const url = this.getAttribute('data-load');

        fetch(url)
            .then(response => response.text())
            .then(html => {
                const mainContent = document.getElementById('main-content');
                if (mainContent) {
                    mainContent.innerHTML = html;
                }
            })
            .catch(error => {
                const mainContent = document.getElementById('main-content');
                if (mainContent) {
                    mainContent.innerHTML = '<div class="alert alert-danger">Lỗi tải dữ liệu!</div>';
                }
                console.error('Lỗi khi tải nội dung:', error);
            });
    });
});

// Xử lý xác nhận khi submit form cập nhật trạng thái đơn hàng
document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('form[name="form_capnhat"]');

    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const url = this.getAttribute('action') || window.location.pathname;

            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(() => {
                // Tải lại phần main-content sau khi cập nhật
                return fetch(window.location.href);
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const updatedMain = doc.getElementById('main-content');
                const mainContent = document.getElementById('main-content');
                if (mainContent && updatedMain) {
                    mainContent.innerHTML = updatedMain.innerHTML;
                }
            })
            .catch(error => {
                alert('Có lỗi khi cập nhật trạng thái');
                console.error(error);
            });
        });
    });
});
