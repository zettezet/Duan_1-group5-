<?php

use BcMath\Number;

require_once 'views/layout/header.php'; ?>


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
                                <li class="breadcrumb-item active" aria-current="page">bill Detail</li>
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
                    <div class="col-lg-7">
                        <!-- Thông tin sản phẩm của đơn hàng-->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="5">
                                            Thông tin sản phẩm
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                    <?php foreach ($chiTietDonHang as $item) : ?>
                                        <tr>
                                            <td><img class="img-fluid" src="<?= BASE_URL . $item['hinh_anh'] ?>" alt="Product" width="100px" />
                                            </td>
                                            <td><?= $item['ten_san_pham'] ?></td>
                                            <td><?= number_format($item['don_gia'], 0, ',', '.') ?> đ </td>
                                            <td><?= $item['so_luong'] ?></td>
                                            <td><?= number_format($item['thanh_tien'], 0, ',', '.') ?> đ</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <!-- Thông tin đơn hàng-->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                            Thông tin đơn hàng
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Mã đơn hàng:</th>
                                        <th><?= $donHang['ma_don_hang'] ?></th>
                                    </tr>
                                    <tr>
                                        <th>Người nhận:</th>
                                        <th><?= $donHang['ten_nguoi_nhan'] ?></th>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <th><?= $donHang['email_nguoi_nhan'] ?></th>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại:</th>
                                        <th><?= $donHang['sdt_nguoi_nhan'] ?></th>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ:</th>
                                        <th><?= $donHang['dia_chi_nguoi_nhan'] ?></th>
                                    </tr>
                                    <tr>
                                        <th>Ngày đặt:</th>
                                        <th><?= $donHang['ngay_dat'] ?></th>
                                    </tr>
                                    <tr>
                                        <th>Ghi chú:</th>
                                        <th><?= $donHang['ghi_chu'] ?></th>
                                    </tr>
                                    <tr>
                                        <th>Tổng tiền:</th>
                                        <th><?= number_format($donHang['tong_tien'], 0, ',', '.') ?> đ</th>
                                    </tr>
                                    <tr>
                                        <th>Phương thức thanh toán:</th>
                                        <th><?= $phuongThucThanhToan[$donHang['phuong_thuc_thanh_toan_id']] ?></th>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái đơn hàng:</th>
                                        <th><?= $trangThaiDonHang[$donHang['trang_thai_id']] ?></th>
                                    </tr>
                                </tbody>
                            </table>
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