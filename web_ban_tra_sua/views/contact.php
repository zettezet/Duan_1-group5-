<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>
<main>
    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-center">Liên hệ với chúng tôi</h2>
                    <p class="text-center">Nếu bạn cần hỗ trợ, vui lòng gửi thông tin dưới đây, chúng tôi sẽ trả lời sớm nhất.</p>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label class="form-label">Họ tên</label>
                            <input type="text" class="form-control" name="ten" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nội dung</label>
                            <textarea class="form-control" name="noi_dung" rows="6" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-sqr">Gửi liên hệ</button>
                    </form>
                    <div class="mt-4">
                        <p><strong>Địa chỉ:</strong> 123 Đường Trà Sữa, Quận 1, TP.HCM</p>
                        <p><strong>Hotline:</strong> 0909 000 123</p>
                        <p><strong>Email:</strong> lienhe@lumitea.vn</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require_once 'views/layout/footer.php'; ?>