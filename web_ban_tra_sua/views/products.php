<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>
<main>
    <section class="section-padding">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="title">Danh sách sản phẩm</h2>
                    <?php if (!empty($currentDanhMuc)): ?>
                        <p class="sub-title">Danh mục: <?= htmlspecialchars($currentDanhMuc['ten_danh_muc'], ENT_QUOTES) ?></p>
                    <?php else: ?>
                        <p class="sub-title">Tất cả sản phẩm</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <?php if (empty($listSanPham)): ?>
                    <div class="col-12">
                        <div class="alert alert-info">Không có sản phẩm nào trong danh mục này.</div>
                    </div>
                <?php else: ?>
                    <?php foreach ($listSanPham as $sanPham): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-30">
                            <div class="product-item">
                                <div class="product-thumb">
                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                        <img src="<?= $sanPham['hinh_anh'] ?>" alt="<?= htmlspecialchars($sanPham['ten_san_pham'], ENT_QUOTES) ?>">
                                    </a>
                                </div>
                                <div class="product-caption text-center">
                                    <h6><a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= htmlspecialchars($sanPham['ten_san_pham'], ENT_QUOTES) ?></a></h6>
                                    <?php if (!empty($sanPham['gia_khuyen_mai'])): ?>
                                        <div class="price-box">
                                            <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) ?>đ</span>
                                            <span class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) ?>đ</del></span>
                                        </div>
                                    <?php else: ?>
                                        <div class="price-box">
                                            <span class="price-regular"><?= formatPrice($sanPham['gia_san_pham']) ?>đ</span>
                                        </div>
                                    <?php endif; ?>
                                    <p><small><?= htmlspecialchars($sanPham['ten_danh_muc'], ENT_QUOTES) ?></small></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>
<?php require_once 'views/layout/footer.php'; ?>