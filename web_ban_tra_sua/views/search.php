<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>

<main>
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title">Kết quả tìm kiếm</h2>
                        <p class="sub-title">Từ khóa: <strong><?= htmlspecialchars($_GET['keyword'] ?? '', ENT_QUOTES) ?></strong></p>
                    </div>
                </div>
            </div>
            <?php if (empty($listSanPham)): ?>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info">Không tìm thấy sản phẩm phù hợp.</div>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($listSanPham as $sanPham): ?>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="product-item mb-30">
                                <div class="product-thumb">
                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                        <img src="<?= $sanPham['hinh_anh'] ?>" alt="<?= htmlspecialchars($sanPham['ten_san_pham'], ENT_QUOTES) ?>">
                                    </a>
                                </div>
                                <div class="product-caption text-center">
                                    <h6 class="product-name"><a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= htmlspecialchars($sanPham['ten_san_pham'], ENT_QUOTES) ?></a></h6>
                                    <div class="price-box">
                                        <?php if ($sanPham['gia_khuyen_mai']): ?>
                                            <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) ?>đ</span>
                                            <span class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) ?>đ</del></span>
                                        <?php else: ?>
                                            <span class="price-regular"><?= formatPrice($sanPham['gia_san_pham']) ?>đ</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php require_once 'views/layout/footer.php'; ?>