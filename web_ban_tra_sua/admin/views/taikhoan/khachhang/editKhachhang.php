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
            <div class="card card-primary">
                
                <div class="card-header">
                    <h3 class="card-title">sửa thông tin tài khoản khách hàng <?= $khachhang['ho_ten'] ?></h3>
                </div>

                <form action="<?= BASE_URL_ADMIN . '?act=sua-khach-hang' ?>" method="POST">
                    <div class="card-body">

                        <input type="hidden" name="khach_hang_id" value="<?= $khachhang['id'] ?>">

                        <div class="form-group col-12">
                            <label>Họ tên</label>
                            <input type="text" class="form-control" name="ho_ten" value="<?= $khachhang['ho_ten'] ?>">
                        </div>

                        <div class="form-group col-12">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?= $khachhang['email'] ?>">
                        </div>

                        <div class="form-group col-12">
                            <label>Số điện thoại</label>
                            <input type="text" class="form-control" name="so_dien_thoai" value="<?= $khachhang['so_dien_thoai'] ?>">
                        </div>

                        <div class="form-group col-12">
                            <label>Ngày sinh</label>
                            <input type="date" class="form-control" name="ngay_sinh" value="<?= $khachhang['ngay_sinh'] ?>">
                        </div>

                        <div class="form-group col-12">
                            <label>Giới tính</label>
                            <select name="gioi_tinh" class="form-control custom-select">
                                <option <?= $khachhang['gioi_tinh'] == 1 ? 'selected' : '' ?> value="1">Nam</option>
                                <option <?= $khachhang['gioi_tinh'] == 2 ? 'selected' : '' ?> value="2">Nữ</option>
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <label>Địa chỉ</label>
                            <input type="text" class="form-control" name="dia_chi" value="<?= $khachhang['dia_chi'] ?>">
                        </div>

                        <div class="form-group col-12">
                            <label>Trạng thái tài khoản</label>
                            <select name="trang_thai" class="form-control custom-select">
                                <option <?= $khachhang['trang_thai'] == 1 ? 'selected' : '' ?> value="1">Active</option>
                                <option <?= $khachhang['trang_thai'] == 2 ? 'selected' : '' ?> value="2">Inactive</option>
                            </select>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>

            </div>
        </div>
    </section>

</div>

<?php include './views/layout/footer.php' ?>