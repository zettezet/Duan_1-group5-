<?php require_once 'views/layout/header.php'; ?>


<?php require_once 'views/layout/menu.php'; ?>


<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="shop.html">shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">cart</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Cart Table Area -->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">ảnh sản phẩm</th>
                                        <th class="pro-title">tên sản phẩm</th>
                                        <th class="pro-price">giá sản phẩm</th>
                                        <th class="pro-quantity">số lượng</th>
                                        <th class="pro-subtotal">tổng tiền</th>
                                        <th class="pro-remove">thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $tongGioHang = 0;
                                    foreach ($chiTietGioHang as $key => $sanPham):
                                    ?>
                                        <tr>
                                            <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="Product" /></a></td>
                                            <td class="pro-title"><a href="#"><?= $sanPham['ten_san_pham'] ?></a></td>
                                            <td class="pro-price"><span>
                                                    <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ' ?>
                                                    <?php } else { ?>
                                                        <?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?>
                                                    <?php } ?>
                                                </span></td>
                                            <td class="pro-quantity">
                                                <div class="pro-qty">
                                                    <input type="number" value="<?= $sanPham['so_luong'] ?>" min="1"
                                                        onchange="updateQuantity(<?= $sanPham['san_pham_id'] ?>, this.value)">
                                                </div>
                                            </td>
                                            <td class="pro-subtotal"><span>
                                                    <?php
                                                    $gia = $sanPham['gia_khuyen_mai'] ?? $sanPham['gia_san_pham'];
                                                    $tong_tien = $gia * $sanPham['so_luong'];
                                                    $tongGioHang += $tong_tien;
                                                    echo formatPrice($tong_tien) . 'đ';
                                                    ?>
                                                </span></td>
                                            <td class="pro-remove">
                                                <a href="<?= BASE_URL . '?act=xoa-khoi-gio-hang&id=' . $sanPham['san_pham_id'] ?>"
                                                    onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')"
                                                    class="text-danger">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- Cart Update Option -->
                        <div class="cart-update-option d-block d-md-flex justify-content-between">
                            <div class="apply-coupon-wrapper">
                                <form action="#" method="post" class=" d-block d-md-flex">
                                    <input type="text" placeholder="Enter Your Coupon Code" required />
                                    <button class="btn btn-sqr">Apply Coupon</button>
                                </form>
                            </div>
                            <div class="cart-update">
                                <a href="#" class="btn btn-sqr">Update Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h6>Cart Totals</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>tổng tiền sản phẩm</td>
                                            <td><?= formatPrice($tongGioHang) . 'đ' ?></td>
                                        </tr>
                                        <tr>
                                            <td>vận chuyển</td>
                                            <td>30.000 đ</td>
                                        </tr>
                                        <tr class="total">
                                            <td>tổng thanh toán</td>
                                            <td class="total-amount"><?= formatPrice($tongGioHang + 30000) . 'đ' ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a href="<?= BASE_URL . '?act=thanh-toan' ?>" class="btn btn-sqr d-block">tiến hành dặt hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart main wrapper end -->
</main>

<?php include_once 'views/layout/miniCart.php'; ?>
<?php include_once 'views/layout/footer.php'; ?>

<script>
    function updateQuantity(sanPhamId, soLuong) {
        fetch('<?= BASE_URL ?>?act=cap-nhat-so-luong-gio-hang', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'san_pham_id=' + sanPhamId + '&so_luong=' + soLuong
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Reload trang để cập nhật tổng tiền
                } else {
                    alert(data.message || 'Có lỗi xảy ra khi cập nhật số lượng');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi cập nhật số lượng');
            });
    }
</script>