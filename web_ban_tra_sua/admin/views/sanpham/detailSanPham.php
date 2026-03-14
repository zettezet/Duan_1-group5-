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
          <h1>Quản lý danh sách sản phẩm</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-6">
            <h3 class="d-inline-block d-sm-none"></h3>
            <div class="col-12">
              <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" class="product-image" alt="Product Image">
            </div>
            <div class="col-12 product-image-thumbs">
              <?php foreach ($listAnhSanPham as $key => $anhSP) : ?>
                <div style="width: 500px; height: 100px;" class="product-image-thumb" <?= $anhSP['id'] == 0 ? 'active' : '' ?>><img src="<?= BASE_URL . $anhSP['link_hinh_anh'] ?>" alt="Product Image"></div>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <h3 class="my-3">Tên sản phẩm: <?= $sanPham['ten_san_pham'] ?></h3>
            <hr>
            <h4 class="mt-3">Giá tiền <small><?= number_format($sanPham['gia_san_pham'], 0, ',', '.') ?> VND</small></h4>
            <h4 class="mt-3">Giá khuyến mãi <small><?= number_format($sanPham['gia_khuyen_mai'], 0, ',', '.') ?> VND</small></h4>
            <h4 class="mt-3">Số lượng <small><?= $sanPham['so_luong'] ?></small></h4>
            <h4 class="mt-3">Lượt xem <small><?= $sanPham['luot_xem'] ?></small></h4>
            <h4 class="mt-3">Ngày nhập <small><?= $sanPham['ngay_nhap'] ?></small></h4>
            <h4 class="mt-3">Danh mục <small><?= $sanPham['ten_danh_muc'] ?></small></h4>
            <h4 class="mt-3">Trạng thái <small><?= $sanPham['trang_thai'] == 1 ? 'Còn hàng' : 'Hết hàng' ?></small></h4>
            <h4 class="mt-3">Mô tả <small><?= $sanPham['mo_ta'] ?></small></h4>
          </div>
        </div>
        <!-- <div class="row mt-4">
          <nav class="w-100">
            <div class="nav nav-tabs" id="product-tab" role="tablist">
              <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Bình luận</a>
            </div>
          </nav>
          <div class="tab-content p-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
              <div class="container">
              </div>
            </div>
          </div>
        </div> -->
        <ul class="nav nav-tabs row mt-4" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Bình luận</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tên người bình luận</th>
                  <th>Nội dung</th>
                  <th>Ngày bình luận</th>
                  <th>Hành động</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Hoàng Đức Tuệ</td>
                  <td>Ngon vaiz l</td>
                  <td>14/03/2026</td>
                  <td>
                    <a href="" class="btn btn-danger">Xóa</a>
                    <a href="" class="btn btn-warning">Ẩn</a>
                  </td>
                </tr>
            </table>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- footer -->
<?php include './views/layout/footer.php' ?>
<!-- end footer -->
<!-- Page specific script -->
<script>
  $(function() {
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
<script>
  $(document).ready(function() {
    $('.product-image-thumb').on('click', function() {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
  })
</script>

</html>