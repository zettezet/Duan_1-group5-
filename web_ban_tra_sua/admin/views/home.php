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
                <div class="col-sm-6">
                    <h1>Báo cáo thống kê</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= formatPrice($summaryRevenue) ?>đ</h3>
                            <p>Doanh thu (lọc hiện tại)</p>
                        </div>
                        <div class="icon"><i class="ion ion-cash"></i></div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= (int)$summaryOrders ?></h3>
                            <p>Số đơn (lọc hiện tại)</p>
                        </div>
                        <div class="icon"><i class="ion ion-bag"></i></div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= count($topSanPham) ?></h3>
                            <p>Top sản phẩm (lọc ngày)</p>
                        </div>
                        <div class="icon"><i class="ion ion-stats-bars"></i></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Bộ lọc</h3>
                </div>
                <div class="card-body">
                    <form method="GET" action="">
                        <input type="hidden" name="act" value="/" />

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label>Chế độ</label>
                                <select class="form-control" name="mode">
                                    <option value="day" <?= $mode === 'day' ? 'selected' : '' ?>>Theo ngày</option>
                                    <option value="month" <?= $mode === 'month' ? 'selected' : '' ?>>Theo tháng</option>
                                    <option value="year" <?= $mode === 'year' ? 'selected' : '' ?>>Theo năm</option>
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label>Năm</label>
                                <input class="form-control" type="number" name="year" value="<?= (int)$year ?>" />
                            </div>
                            <div class="form-group col-md-2">
                                <label>Tháng</label>
                                <input class="form-control" type="number" min="1" max="12" name="month" value="<?= (int)$month ?>" />
                            </div>

                            <div class="form-group col-md-3">
                                <label>Từ ngày</label>
                                <input class="form-control" type="date" name="from" value="<?= htmlspecialchars($fromDate) ?>" />
                            </div>
                            <div class="form-group col-md-3">
                                <label>Đến ngày</label>
                                <input class="form-control" type="date" name="to" value="<?= htmlspecialchars($toDate) ?>" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label>Từ năm</label>
                                <input class="form-control" type="number" name="fromYear" value="<?= (int)$fromYear ?>" />
                            </div>
                            <div class="form-group col-md-2">
                                <label>Đến năm</label>
                                <input class="form-control" type="number" name="toYear" value="<?= (int)$toYear ?>" />
                            </div>
                            <div class="form-group col-md-8 d-flex align-items-end">
                                <button class="btn btn-primary" type="submit">Xem báo cáo</button>
                            </div>
                        </div>
                    </form>
                    <small class="text-muted">Doanh thu chỉ tính đơn có trạng thái: Đã thanh toán / Thành công.</small>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Doanh thu</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Thời gian</th>
                                        <th>Số đơn</th>
                                        <th>Doanh thu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $rows = $mode === 'day' ? $doanhThuNgay : ($mode === 'year' ? $doanhThuNam : $doanhThuThang);
                                    if (empty($rows)) :
                                    ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Không có dữ liệu.</td>
                                        </tr>
                                        <?php else : ?>
                                        <?php foreach ($rows as $r) : ?>
                                            <tr>
                                                <td>
                                                    <?php if ($mode === 'day') : ?>
                                                        <?= htmlspecialchars($r['ngay']) ?>
                                                    <?php elseif ($mode === 'year') : ?>
                                                        <?= 'Năm ' . (int)$r['nam'] ?>
                                                    <?php else : ?>
                                                        <?= 'Tháng ' . (int)$r['thang'] . '/' . (int)$year ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= (int)$r['so_don'] ?></td>
                                                <td><?= formatPrice((float)$r['doanh_thu']) ?>đ</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thống kê sản phẩm (Top 10)</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>SL bán</th>
                                        <th>Doanh thu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($topSanPham)) : ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Không có dữ liệu.</td>
                                        </tr>
                                    <?php else : ?>
                                        <?php foreach ($topSanPham as $sp) : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($sp['ten_san_pham']) ?></td>
                                                <td><?= (int)$sp['so_luong_ban'] ?></td>
                                                <td><?= formatPrice((float)$sp['doanh_thu']) ?>đ</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-muted">
                            Lọc theo khoảng ngày: <?= htmlspecialchars($fromDate) ?> → <?= htmlspecialchars($toDate) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<!-- /.content-wrapper -->
<!-- footer -->
<?php include './views/layout/footer.php' ?>
<!-- end footer -->
<!-- Page specific script -->

<!-- Code injected by live-server -->
</body>

</html>