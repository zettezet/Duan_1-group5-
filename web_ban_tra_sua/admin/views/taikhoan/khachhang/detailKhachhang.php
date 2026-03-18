<!-- header -->
<?php include './views/layout/header.php' ?>

<!-- Navbar -->
<?php include './views/layout/navbar.php' ?>

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php' ?>

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý tài khoản khách hàng</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <img src="<?= BASE_URL . $khachhang['anh_dai_dien'] ?>" alt="" width="100px"
                        onerror="this.onerror=null; this.src='data:image/jpeg;base64,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'">
                </div>
                <div class="col-8">
                    <div class="container">
                        <table class="table talbe-boderless">
                            <tbody>
                                <tr>
                                    <th>Họ tên</th>
                                    <td><?= $khachHang['ho_ten'] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <th>Ngày sinh</th>
                                    <td><?= $khachHang['ngay_sinh'] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= $khachHang['email'] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại</th>
                                    <td><?= $khachHang['so_dien_thoai'] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <th>Giới tính</th>
                                    <td><?= $khachHang['gioi_tinh'] == 1 ? 'Nam' : 'Nữ'; ?></td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <td><?= $khachHang['dia_chi'] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td><?= $khachHang['trang_thai'] == 1 ? 'Active' : 'Inactive'; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12">
                    <h2>Lịch sử mua hàng</h2>
                    <div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên người nhận</th>
                                    <th>Số điện thoại</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listDonHang as $key => $donhang): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td> <?= $donhang['ma_don_hang'] ?></td>
                                        <td> <?= $donhang['ten_nguoi_nhan'] ?></td>
                                        <td> <?= $donhang['sdt_nguoi_nhan'] ?></td>
                                        <td> <?= $donhang['ngay_dat'] ?></td>
                                        <td> <?= $donhang['tong_tien'] ?></td>
                                        <td> <?= $donhang['ten_trang_thai'] ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-don-hang&id_don-hang=' . $donhang['id'] ?>">
                                                    <button class="btn btn-primary">Chi tiết</i></button>
                                                </a>
                                                <a href="<?= BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don-hang=' . $donhang['id'] ?>">
                                                    <button class="btn btn-warning">Sửa</i></button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12">
                    <h2>Lịch sử bình luận</h2>
                    <div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Nội dung bình luận</th>
                                    <th>Ngày bình luận</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listBinhLuan as $key => $binhLuan): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td> <a target="_blank" href=" <?= BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $binhLuan['san_pham_id']; ?>">
                                                <?= $binhLuan['ten_san_pham'] ?></td>
                                        <td> <?= $binhLuan['noi_dung'] ?></td>
                                        <td> <?= $binhLuan['ngay_dang'] ?></td>
                                        <td> <?= $binhLuan['trang_thai'] == 1 ? 'Hiển thị' : 'Ẩn' ?></td>
                                        <td>
                                            <form action=" <?= BASE_URL_ADMIN . '?act=update-trang-thai-binh-luan' ?>" method="POST">
                                                <input type="hidden" name="id_binh_luan" value=" <?= $binhLuan['id'] ?>">
                                                <input type="hidden" name="name_view" value="detail_khach">
                                                <button onclick="return confirm('Bạn có muốn ẩn bình luận này không')" class="btn btn-danger">
                                                    <?= $binhLuan['trang_thai'] == 1 ? 'Ẩn' : 'Bỏ ẩn' ?>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php include './views/layout/footer.php' ?>