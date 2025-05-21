<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Đăng ký khách hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #ff5f6d, #ffc371);
            padding: 30px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-wrapper {
            background: #fff0f0;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 0 25px rgba(255, 95, 109, 0.5);
            width: 100%;
            max-width: 480px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .tieude1 {
            font-size: 1.9rem;
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
            color: #d93025; 
            text-shadow: 1px 1px 4px #ffb3b3;
        }
        label {
            color: #b3321e;
            font-weight: 600;
        }
        .form-control {
            border: 2px solid #ff7043; 
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #d93025;
            box-shadow: 0 0 6px #ff6f61;
        }
        .form-check-label {
            color: #bf360c;
            font-weight: 600;
        }
        .requirefield {
            color: #d93025;
            margin-left: 5px;
            font-weight: 700;
        }
        .note {
            font-size: 0.9rem;
            color: #a6331e;
            text-align: center;
            margin-top: 15px;
            font-style: italic;
        }
        .btn-primary {
            background-color: #d93025;
            border-color: #d93025;
            font-weight: 600;
            padding: 10px 35px;
            border-radius: 30px;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 12px rgba(217, 48, 37, 0.5);
        }
        .btn-primary:hover {
            background-color: #ff3b2e;
            border-color: #ff3b2e;
            box-shadow: 0 6px 15px rgba(255, 59, 46, 0.7);
        }
        .invalid-feedback {
            font-style: italic;
            color: #b71c1c;
        }
    </style>
</head>
<body>

<div class="form-wrapper">
    <h2 class="tieude1">Đăng ký khách hàng thân thiết</h2>
    <form action="themkhachhang_submit.php" method="post" novalidate>
        <div class="mb-3">
            <label for="HoTen" class="form-label">Họ và tên <span class="requirefield">*</span></label>
            <input type="text" class="form-control" id="HoTen" name="HoTen" required />
            <div class="invalid-feedback">Vui lòng nhập họ và tên.</div>
        </div>

        <div class="mb-3">
            <label for="NamSinh" class="form-label">Năm sinh (YYYY) <span class="requirefield">*</span></label>
            <input type="text" class="form-control" id="NamSinh" name="NamSinh" pattern="\d{4}" required placeholder="VD: 1985" />
            <div class="invalid-feedback">Vui lòng nhập năm sinh hợp lệ (4 chữ số).</div>
        </div>

        <fieldset class="mb-3">
            <legend class="col-form-label pt-0" style="color:#b3321e;">Giới tính</legend>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="GioiTinh" id="gtNam" value="0" checked />
                <label class="form-check-label" for="gtNam">Nam</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="GioiTinh" id="gtNu" value="1" />
                <label class="form-check-label" for="gtNu">Nữ</label>
            </div>
        </fieldset>

        <div class="mb-3">
            <label for="SoDienThoai" class="form-label">Số Điện Thoại <span class="requirefield">*</span></label>
            <input type="tel" class="form-control" id="SoDienThoai" name="SoDienThoai" pattern="[0-9]{9,15}" required placeholder="VD: 0912345678" />
            <div class="invalid-feedback">Vui lòng nhập số điện thoại hợp lệ (9-15 số).</div>
        </div>

        <div class="mb-3">
            <label for="DiaChi" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="DiaChi" name="DiaChi" />
        </div>

        <div class="text-center">
            <div class="note">(*) Các trường bắt buộc nhập thông tin.</div>
            <button type="submit" class="btn btn-primary mt-3 px-5">Đăng ký</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (() => {
        'use strict'
        const forms = document.querySelectorAll('form')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

</body>
</html>
