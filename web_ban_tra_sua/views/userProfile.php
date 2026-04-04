<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>

<main>
    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h2 class="title">Thông tin tài khoản</h2>
                    </div>

                    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                        <div class="alert alert-success">Cập nhật thông tin thành công.</div>
                    <?php endif; ?>

                    <form action="<?= BASE_URL . '?act=cap-nhat-tai-khoan' ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="<?= htmlspecialchars($user['email'], ENT_QUOTES) ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Họ tên</label>
                            <input type="text" name="ho_ten" class="form-control" value="<?= htmlspecialchars($user['ho_ten'], ENT_QUOTES) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="so_dien_thoai" class="form-control" value="<?= htmlspecialchars($user['so_dien_thoai'], ENT_QUOTES) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" name="dia_chi" class="form-control" value="<?= htmlspecialchars($user['dia_chi'], ENT_QUOTES) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ngày sinh</label>
                            <input type="date" name="ngay_sinh" class="form-control" value="<?= htmlspecialchars($user['ngay_sinh'], ENT_QUOTES) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ảnh đại diện</label><br>
                            <?php if (!empty($user['anh_dai_dien'])): ?>
                                <img src="<?= htmlspecialchars($user['anh_dai_dien'], ENT_QUOTES) ?>" alt="avatar" style="height:80px; width:auto; margin-bottom:8px;" /><br>
                            <?php endif; ?>
                            <input type="file" name="anh_dai_dien" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-sqr">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once 'views/layout/footer.php'; ?>