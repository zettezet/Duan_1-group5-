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
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">thanh toán</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- checkout main wrapper start -->
    <div class="checkout-page-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Checkout Login Coupon Accordion Start -->
                    <div class="checkoutaccordion" id="checkOutAccordion">
                        <div class="card">
                            <h6>thêm mã giảm giá <span data-bs-toggle="collapse" data-bs-target="#couponaccordion">Click
                                    nhập code mã giảm giá</span></h6>
                            <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">
                                <div class="card-body">
                                    <div class="cart-update-option">
                                        <div class="apply-coupon-wrapper">
                                            <form action="#" method="post" class=" d-block d-md-flex">
                                                <input type="text" placeholder="Enter Your Coupon Code" required />
                                                <button class="btn btn-sqr">Apply Coupon</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Checkout Login Coupon Accordion End -->
                </div>
            </div>
            <div class="row">
                <!-- Checkout Billing Details -->
                <div class="col-lg-6">
                    <div class="checkout-billing-details-wrap">
                        <h5 class="checkout-title">thông tin người nhận</h5>
                        <div class="billing-form-wrap">
                            <form action="#">

                                <div class="single-input-item">
                                    <label for="ten_nguoi_nhan" class="required">tên người nhận</label>
                                    <input type="ten_nguoi_nhan" id="ten_nguoi_nhan" name="ten_nguoi_nhan"
                                        value="<?= $user['ho_ten'] ?>" placeholder="tên người nhận" required />
                                </div>

                                <div class="single-input-item">
                                    <label for="email" class="required">địa chỉ email</label>
                                    <input type="email" id="email_nguoi_nhan" name="email_nguoi_nhan"
                                        value="<?= $user['email'] ?>" placeholder="địa chỉ email" required />
                                </div>

                                <div class="single-input-item">
                                    <label for="sdt_nguoi_nhan" class="required">số điện thoại người nhận</label>
                                    <input type="text" id="sdt_nguoi_nhan" name="sdt_nguoi_nhan"
                                        value="<?= $user['so_dien_thoai'] ?>" placeholder="số điện thoại người nhận"
                                        required />
                                </div>

                                <div class="single-input-item">
                                    <label for="dia_chi_nguoi_nhan" class="required">địa chỉ người nhận</label>
                                    <input type="text" id="dia_chi_nguoi_nhan" name="dia_chi_nguoi_nhan"
                                        value="<?= $user['dia_chi'] ?>" placeholder="địa chỉ người nhận" required />
                                </div>



                                <div class="single-input-item">
                                    <label for="ghi_chu">ghi chú</label>
                                    <textarea name="ghi_chu" id="ghi_chu" cols="30" rows="3"
                                        placeholder="vui lòng nhập ghi chú đơn hàng của bạn"></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Details -->
                <div class="col-lg-6">
                    <div class="order-summary-details">
                        <h5 class="checkout-title">thông tin sản phẩm</h5>
                        <div class="order-summary-content">
                            <!-- Order Summary Table -->
                            <div class="order-summary-table table-responsive text-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>sản phẩm</th>
                                            <th>tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $tongGioHang = 0;
                                        foreach ($chiTietGioHang as $key => $sanPham):
                                            ?>
                                            <tr>
                                                <td><a href="">
                                                        <?= $sanPham['ten_san_pham'] ?> <strong> ×
                                                            <?= $sanPham['so_luong'] ?></strong></a>
                                                </td>
                                                <td>
                                                    <?php
                                                    $tong_tien = 0;
                                                    if ($sanPham['gia_san_pham']) {
                                                        $tong_tien = $sanPham['gia_khuyen_mai'] * $sanPham['so_luong'];
                                                    } else {
                                                        $tong_tien = $sanPham['gia_san_pham'] * $sanPham['so_luong'];
                                                    }
                                                    $tongGioHang += $tong_tien;
                                                    echo formatPrice($tong_tien) . 'đ';
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>tổng tiền sản phẩm</td>
                                            <td><strong><?= formatPrice($tongGioHang) . ' đ' ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td class="d-flex justify-content-center">
                                               <strong>30.000 đ</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>tổng đơn hàng</td>
                                            <td><strong><?= formatPrice($tongGioHang + 30000) . 'đ' ?></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- Order Payment Method -->
                            <div class="order-payment-method">
                                <div class="single-payment-method show">
                                    <div class="payment-method-name">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="cashon" name="paymentmethod" value="cash"
                                                class="custom-control-input" checked />
                                            <label class="custom-control-label" for="cashon">thanh toán khi nhận hàng</label>
                                        </div>
                                    </div>
                                    <div class="payment-method-details" data-method="cash">
                                        <p>khách hàng có thể thanh toán sau khi đã nhận hàng thành công (cần xác nhận đơn hàng)</p>
                                    </div>
                                </div>
                                <div class="single-payment-method">
                                    <div class="payment-method-name">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="directbank" name="paymentmethod" value="bank"
                                                class="custom-control-input" />
                                            <label class="custom-control-label" for="directbank">thanh toán online</label>
                                        </div>
                                    </div>
                                    <div class="payment-method-details" data-method="bank">
                                        <p>khách hàng cần thanh toán online</p>
                                    </div>
                                </div>
                                
                                </div>
                                <div class="summary-footer-area">
                                    <div class="custom-control custom-checkbox mb-20">
                                        <input type="checkbox" class="custom-control-input" id="terms" required />
                                        <label class="custom-control-label" for="terms">xác nhận khi đặt hàng </label>
                                    </div>
                                    <button type="submit" class="btn btn-sqr">tiến hành đặt hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout main wrapper end -->
</main>

<?php include_once 'views/layout/miniCart.php'; ?>
<?php include_once 'views/layout/footer.php'; ?>