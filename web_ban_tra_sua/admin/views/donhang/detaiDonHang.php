<!-- header -->
<?php include './views/layout/header.php' ?>

<!-- Navbar -->
<?php include './views/layout/navbar.php' ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php' ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1>Quản lý danh sách đơn hàng - đơn hàng:<?= $donHang['ma_don_hang'] ?></h1>
                </div>
                <div class="col-sm-2">
                    <form action="" method="post"></form>
                    <select name="" id="" class="form-group">
                        <?php foreach($listTrangThaiDonHang as $key=>$trangthai): ?>
                        <option <?= $trangthai['id'] < $donHang['trang_thai_id'] ? 'disabled' : ''  ?> <?= $trangthai['id']== $donHang['trang_thai_id'] ? 'selected' : '' ?> value="<?= $trangthai['id'] ?>"><?= $trangthai['ten_trang_thai'] ?>

                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <?php
                        if ($donHang['trang_thai_id'] == 1) {
                            $coloAlert = 'primary';
                        } elseif ($donHang['trang_thai_id'] >= 2 && $donHang['trang_thai_id'] <= 9) {
                            $coloAlert = 'warning';
                        } elseif ($donHang['trang_thai_id'] == 10) {
                            $coloAlert = 'success';
                        } else {
                            $coloAlert = 'danger';
                        }
                        ?>
                        <div class="alert alert-<?= $coloAlert; ?>" role="alert">
                            đơn hàng : <?= $donHang['ten_trang_thai'] ?>
                        </div>


                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> Cửa hàng Bán Trà Sữa
                                        <small class="float-right">ngày đặt: <?= $donHang['ngay_dat'] ?></small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    thông tin người đặt
                                    <address>
                                        <strong> họ tên:<?= $donHang['ho_ten'] ?></strong><br>
                                        email: <?= $donHang['email'] ?><br>
                                        số điện thoại: <?= $donHang['so_dien_thoai'] ?><br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    người nhận
                                    <address>
                                        <strong>tên người nhận: <?= $donHang['ten_nguoi_nhan'] ?></strong><br>
                                        email: <?= $donHang['email_nguoi_nhan'] ?><br>
                                        số điện thoại: <?= $donHang['sdt_nguoi_nhan'] ?><br>
                                        địa chỉ: <?= $donHang['dia_chi_nguoi_nhan'] ?><br>
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    thông tin
                                    <address>
                                        <strong>mã đơn hàng:<?= $donHang['ten_nguoi_nhan'] ?></strong><br>
                                        tổng tiền : <?= $donHang['tong_tien'] ?><br>
                                        ghi chú: <?= $donHang['ghi_chu'] ?><br>
                                        thanh toán: <?= $donHang['ten_phuong_thuc'] ?><br>
                                    </address>
                                </div>
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>

                                            <tr>
                                                <th>thứ tự</th>
                                                <th>tên sản phẩm</th>
                                                <th>đơn giá </th>
                                                <th>số lượng</th>
                                                <th>thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $tong_tien = 0; ?>
                                            <?php foreach ($sanPhamDonHang as $key => $san_pham): ?>
                                                <tr>
                                                    <td><?= $key + 1 ?></td>
                                                    <td><?= $san_pham['ten_san_pham'] ?></td>
                                                    <td><?= $san_pham['don_gia'] ?></td>
                                                    <td><?= $san_pham['so_luong'] ?></td>
                                                    <td><?= $san_pham['thanh_tien'] ?>
                                                        <?php $tong_tien += ($san_pham['thanh_tien']); ?>
                                                    <?php endforeach; ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">

                                <div class="col-6">
                                    <p class="lead">ngày đặt hàng <?= $donHang['ngay_dat'] ?></p>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">tổng thành tiền:</th>
                                                <td>
                                                    <?= $tong_tien ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>vận chuyển</th>
                                                <td>200đ</td>
                                            </tr>
                                            <tr>
                                                <th>tổng tiền:</th>
                                                <td><?= $tong_tien +200 ?>đ</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
</div>
<!-- /.content-wrapper -->
<!-- footer -->
<?php include './views/layout/footer.php' ?>
<!-- end footer -->
<!-- Page specific script -->
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<!-- Code injected by live-server -->
</body>

</html>