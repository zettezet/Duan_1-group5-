<!-- offcanvas mini cart start -->
<div class="offcanvas-minicart-wrapper">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
        <div class="minicart-inner-content">
            <div class="minicart-close">
                <i class="pe-7s-close"></i>
            </div>
            <div class="minicart-content-box">
                <div class="minicart-item-wrapper">
                    <ul>
                        <?php
                        $tongTien = 0;
                        if (isset($_SESSION['user_client'])) {
                            $modelTaiKhoan = new TaiKhoan();
                            $modelGioHang = new GioHang();
                            $modelSanPham = new SanPham();

                            $user = $modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
                            if ($user) {
                                $gioHang = $modelGioHang->getGioHangFromUser($user['id']);
                                if ($gioHang) {
                                    $chiTietGioHang = $modelGioHang->detailGioHang($gioHang['id']);
                                    foreach ($chiTietGioHang as $item) {
                                        $sanPham = $modelSanPham->getDetailSanPham($item['san_pham_id']);
                                        if ($sanPham) {
                                            $gia = $sanPham['gia_khuyen_mai'] ?? $sanPham['gia_san_pham'];
                                            $thanhTien = $gia * $item['so_luong'];
                                            $tongTien += $thanhTien;
                        ?>
                                            <li class="minicart-item">
                                                <div class="minicart-thumb">
                                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                                        <img src="<?= $sanPham['hinh_anh'] ?>" alt="product">
                                                    </a>
                                                </div>
                                                <div class="minicart-content">
                                                    <h3 class="product-name">
                                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= htmlspecialchars($sanPham['ten_san_pham'], ENT_QUOTES) ?></a>
                                                    </h3>
                                                    <p>
                                                        <span class="cart-quantity"><?= $item['so_luong'] ?> <strong>&times;</strong></span>
                                                        <span class="cart-price"><?= formatPrice($gia) ?>đ</span>
                                                    </p>
                                                </div>
                                                <button class="minicart-remove" onclick="removeFromCart(<?= $item['san_pham_id'] ?>)"><i class="pe-7s-close"></i></button>
                                            </li>
                        <?php
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>

                <div class="minicart-pricing-box">
                    <ul>
                        <li>
                            <span>Tổng tiền</span>
                            <span><strong><?= formatPrice($tongTien) ?>đ</strong></span>
                        </li>
                    </ul>
                </div>

                <div class="minicart-button">
                    <a href="<?= BASE_URL . '?act=gio-hang' ?>"><i class="fa fa-shopping-cart"></i> Xem giỏ hàng</a>
                    <a href="<?= BASE_URL . '?act=thanh-toan' ?>"><i class="fa fa-share"></i> Thanh toán</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function removeFromCart(sanPhamId) {
        if (confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) {
            fetch('<?= BASE_URL ?>?act=xoa-khoi-gio-hang', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'san_pham_id=' + sanPhamId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Reload trang để cập nhật giỏ hàng
                    } else {
                        alert(data.message || 'Có lỗi xảy ra');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi xóa sản phẩm');
                });
        }
    }
</script>