 <?php require_once 'views/layout/header.php'; ?>


 <?php require_once 'views/layout/menu.php'; ?>

 <main>
     <!-- hero slider area start -->
     <section class="slider-area">
         <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
             <!-- single slider item start -->
             <div class="hero-single-slide hero-overlay">
                 <div class="hero-slider-item bg-img" data-bg="assets/img/slider/Gemini_Generated_Image_a2hn9ba2hn9ba2hn.png">
                     <div class="container">
                         <div class="row">
                         </div>
                     </div>
                 </div>
             </div>
             <!-- single slider item start -->
             <div class="hero-single-slide hero-overlay">
                 <div class="hero-slider-item bg-img" data-bg="assets/img/slider/Mau-banner-quang-cao-tra-sua-9-768x389.png">
                     <div class="container">
                         <div class="row">
                         </div>
                     </div>
                 </div>
             </div>
             <div class="hero-single-slide hero-overlay">
                 <div class="hero-slider-item bg-img" data-bg="assets/img/slider/Mau-banner-quang-cao-tra-sua-10-768x431.png">
                     <div class="container">
                         <div class="row">
                         </div>
                     </div>
                 </div>
             </div>

         </div>
     </section>
     <!-- hero slider area end -->



     <!-- service policy area start -->
     <div class="service-policy section-padding">
         <div class="container">
             <div class="row mtn-30">
                 <div class="col-sm-6 col-lg-3">
                     <div class="policy-item">
                         <div class="policy-icon">
                             <i class="pe-7s-plane"></i>
                         </div>
                         <div class="policy-content">
                             <h6>Giao hàng</h6>
                             <p>Miễn phí giao hàng</p>
                         </div>
                     </div>
                 </div>
                 <div class="col-sm-6 col-lg-3">
                     <div class="policy-item">
                         <div class="policy-icon">
                             <i class="pe-7s-help2"></i>
                         </div>
                         <div class="policy-content">
                             <h6>Hỗ trợ</h6>
                             <p>Hỗ trợ 24/7</p>
                         </div>
                     </div>
                 </div>
                 <div class="col-sm-6 col-lg-3">
                     <div class="policy-item">
                         <div class="policy-icon">
                             <i class="pe-7s-back"></i>
                         </div>
                         <div class="policy-content">
                             <h6>Hoàn tiền</h6>
                             <p>Hoàn tiền trong 30 ngày khi lỗi</p>
                         </div>
                     </div>
                 </div>
                 <div class="col-sm-6 col-lg-3">
                     <div class="policy-item">
                         <div class="policy-icon">
                             <i class="pe-7s-credit"></i>
                         </div>
                         <div class="policy-content">
                             <h6>Thanh toán</h6>
                             <p>Bảo mật thanh toán</p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- service policy area end -->

     <!-- banner statistics area start -->
     <div class="banner-statistics-area">
         <div class="container">
             <div class="row row-20 mtn-20">
                 <div class="col-sm-6">
                     <figure class="banner-statistics mt-20">
                         <a href="#">
                             <img src="assets/img/slider/banner1.jpg" alt="product banner">
                         </a>

                     </figure>
                 </div>
                 <div class="col-sm-6">
                     <figure class="banner-statistics mt-20">
                         <a href="#">
                             <img src="assets/img/slider/banner2.jpg" alt="product banner">
                         </a>

                     </figure>
                 </div>

             </div>
         </div>
     </div>
     <!-- banner statistics area end -->

     <!-- product area start -->
     <section class="product-area section-padding">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <!-- section title start -->
                     <div class="section-title text-center">
                         <h2 class="title">Sản phẩm của chúng tôi</h2>
                         <p class="sub-title">Sản phẩm được cập nhật liên tục</p>
                     </div>
                     <!-- section title start -->
                 </div>
             </div>
             <div class="row">
                 <div class="col-12">
                     <div class="product-container">
                         <div class="tab-content">
                             <div class="tab-pane fade show active" id="tab1">
                                 <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                     <?php foreach ($listSanPham as $key => $sanPham): ?>
                                         <!-- product item start -->
                                         <div class="product-item">
                                             <figure class="product-thumb">
                                                 <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                                     <img class="pri-img" src="<?= $sanPham['hinh_anh'] ?>" alt="product">
                                                     <img class="sec-img" src="<?= $sanPham['hinh_anh'] ?>" alt="product">
                                                 </a>
                                                 <?php
                                                    $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                                    $ngayHienTai = new DateTime();
                                                    $tinhNgay = $ngayHienTai->diff($ngayNhap);

                                                    if ($tinhNgay->days <= 7) {
                                                    ?>
                                                     <div class="product-label new">
                                                         <span>Mới</span>
                                                     </div>

                                                 <?php
                                                    }
                                                    ?>
                                                 <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                     <div class="product-label discount">
                                                         <span>Giảm giá</span>
                                                     </div>
                                                 <?php } ?>

                                                 <div class="product-badge">
                                                     <div class="product-label new">
                                                         <span>Mới</span>
                                                     </div>
                                                     <div class="product-label discount">
                                                         <span>Giảm giá</span>
                                                     </div>
                                                 </div>
                                                 <div class="button-group">
                                                     <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                                     <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                                     <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                                 </div>
                                                 <div class="cart-hover">
                                                     <button class="btn btn-cart">Xem chi tiết</button>
                                                 </div>
                                             </figure>
                                             <div class="product-caption text-center">

                                                 <h6 class="product-name">
                                                     <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                                 </h6>
                                                 <div class="price-box">
                                                     <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                         <span class="price-regular"> <?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ' ?></span>
                                                         <span class="price-old"><del> <?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?></del></span>
                                                     <?php } else { ?>
                                                         <span class="price-regular"> <?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?></span>
                                                     <?php } ?>
                                                 </div>
                                             </div>
                                         </div>
                                     <?php endforeach; ?>
                                 </div>
                             </div>
                         </div>
                         <!-- product tab content end -->
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- product area end -->

     <!-- product banner statistics area start -->
     <section class="product-banner-statistics">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-12">
                     <div class="product-banner-carousel slick-row-10">
                         <!-- banner single slide start -->
                         <div class="banner-slide-item">
                             <figure class="banner-statistics">
                                 <a href="#">
                                     <img src="assets/img/banner/product-5.jpg" alt="product banner">
                                 </a>
                                 <div class="banner-content banner-content_style2">
                                     <h5 class="banner-text3"><a href="#">Trà sữa trân châu truyền thống</a></h5>
                                 </div>
                             </figure>
                         </div>
                         <!-- banner single slide start -->
                         <!-- banner single slide start -->
                         <div class="banner-slide-item">
                             <figure class="banner-statistics">
                                 <a href="#">
                                     <img src="assets/img/banner/product-1.jpg" alt="product banner">
                                 </a>
                                 <div class="banner-content banner-content_style2">
                                     <h5 class="banner-text3"><a href="#">Trà trái cây nhiệt đới</a></h5>
                                 </div>
                             </figure>
                         </div>
                         <!-- banner single slide start -->
                         <!-- banner single slide start -->
                         <div class="banner-slide-item">
                             <figure class="banner-statistics">
                                 <a href="#">
                                     <img src="assets/img/banner/product-2.jpg" alt="product banner">
                                 </a>
                                 <div class="banner-content banner-content_style2">
                                     <h5 class="banner-text3"><a href="#">Trà sữa kem cheese</a></h5>
                                 </div>
                             </figure>
                         </div>
                         <!-- banner single slide start -->
                         <!-- banner single slide start -->
                         <div class="banner-slide-item">
                             <figure class="banner-statistics">
                                 <a href="#">
                                     <img src="assets/img/banner/product-3.jpg" alt="product banner">
                                 </a>
                                 <div class="banner-content banner-content_style2">
                                     <h5 class="banner-text3"><a href="#">Trà signature</a></h5>
                                 </div>
                             </figure>
                         </div>
                         <!-- banner single slide start -->
                         <!-- banner single slide start -->
                         <div class="banner-slide-item">
                             <figure class="banner-statistics">
                                 <a href="#">
                                     <img src="assets/img/banner/product-4.jpg" alt="product banner">
                                 </a>
                                 <div class="banner-content banner-content_style2">
                                     <h5 class="banner-text3"><a href="#">Trân châu đường đen</a></h5>
                                 </div>
                             </figure>
                         </div>
                         <!-- banner single slide start -->
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- product banner statistics area end -->

     <!-- featured product area start -->
     <section class="feature-product section-padding">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <!-- section title start -->
                     <div class="section-title text-center">
                         <h2 class="title">SẢN PHẨM CỦA CHÚNG TÔI</h2>
                         <p class="sub-title">Chúng tôi đảm bảo mọi thứ bạn chọn có chất lượng tốt nhất</p>
                     </div>
                     <!-- section title start -->
                 </div>
             </div>
             <div class="row">
                 <div class="col-12">
                     <div class="product-carousel-4_2 slick-row-10 slick-arrow-style">
                         <!-- product item start -->
                         <div class="product-item">
                             <figure class="product-thumb">
                                 <a href="product-details.html">
                                     <img class="pri-img" src="assets/img/product/1.png" alt="product">
                                     <img class="sec-img" src="assets/img/product/2.png" alt="product">
                                 </a>
                                 <div class="product-badge">
                                     <div class="product-label new">
                                         <span>new</span>
                                     </div>

                                 </div>
                                 <div class="button-group">
                                     <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                     <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                     <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                 </div>
                                 <div class="cart-hover">
                                     <button class="btn btn-cart">add to cart</button>
                                 </div>
                             </figure>
                             <div class="product-caption text-center">
                                 <div class="product-identity">
                                 </div>

                                 <h6 class="product-name">
                                     <a href="product-details.html">Yến mạch khoai môn sữa</a>
                                 </h6>
                                 <div class="price-box">
                                     <span class="price-regular">60.000 ₫ – 85.000 ₫</span>
                                 </div>
                             </div>
                         </div>
                         <!-- product item end -->

                         <!-- product item start -->
                         <div class="product-item">
                             <figure class="product-thumb">
                                 <a href="product-details.html">
                                     <img class="pri-img" src="assets/img/product/3.png" alt="product">
                                     <img class="sec-img" src="assets/img/product/4.png" alt="product">
                                 </a>
                                 <div class="product-badge">
                                     <div class="product-label new">
                                         <span>new</span>
                                     </div>

                                 </div>
                                 <div class="button-group">
                                     <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                     <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                     <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                 </div>
                                 <div class="cart-hover">
                                     <button class="btn btn-cart">add to cart</button>
                                 </div>
                             </figure>
                             <div class="product-caption text-center">


                                 <h6 class="product-name">
                                     <a href="product-details.html">Lục trà sữa tươi việt quất</a>
                                 </h6>
                                 <div class="price-box">
                                     <span class="price-regular">50.000 ₫ – 75.000 ₫</span>
                                 </div>
                             </div>
                         </div>
                         <!-- product item end -->

                         <!-- product item start -->
                         <div class="product-item">
                             <figure class="product-thumb">
                                 <a href="product-details.html">
                                     <img class="pri-img" src="assets/img/product/5.png" alt="product">
                                     <img class="sec-img" src="assets/img/product/6.png" alt="product">
                                 </a>
                                 <div class="product-badge">
                                     <div class="product-label new">
                                         <span>new</span>
                                     </div>
                                 </div>
                                 <div class="button-group">
                                     <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                     <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                     <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                 </div>
                                 <div class="cart-hover">
                                     <button class="btn btn-cart">add to cart</button>
                                 </div>
                             </figure>
                             <div class="product-caption text-center">


                                 <h6 class="product-name">
                                     <a href="product-details.html">Trà sữa khoai môn tươi</a>
                                 </h6>
                                 <div class="price-box">
                                     <span class="price-regular">45.000 ₫ – 55.000 ₫</span>
                                 </div>
                             </div>
                         </div>
                         <!-- product item end -->

                         <!-- product item start -->
                         <div class="product-item">
                             <figure class="product-thumb">
                                 <a href="product-details.html">
                                     <img class="pri-img" src="assets/img/product/7.png" alt="product">
                                     <img class="sec-img" src="assets/img/product/8.png" alt="product">
                                 </a>
                                 <div class="product-badge">
                                     <div class="product-label new">
                                         <span>new</span>
                                     </div>

                                 </div>
                                 <div class="button-group">
                                     <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                     <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                     <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                 </div>
                                 <div class="cart-hover">
                                     <button class="btn btn-cart">add to cart</button>
                                 </div>
                             </figure>
                             <div class="product-caption text-center">


                                 <h6 class="product-name">
                                     <a href="product-details.html">Trà trái cây nhiệt đới</a>
                                 </h6>
                                 <div class="price-box">
                                     <span class="price-regular">60.000 ₫ – 85.000 ₫</span>
                                 </div>
                             </div>
                         </div>
                         <!-- product item end -->

                         <!-- product item start -->
                         <div class="product-item">
                             <figure class="product-thumb">
                                 <a href="product-details.html">
                                     <img class="pri-img" src="assets/img/product/10.png" alt="product">
                                     <img class="sec-img" src="assets/img/product/9.png" alt="product">
                                 </a>
                                 <div class="product-badge">
                                     <div class="product-label new">
                                         <span>new</span>
                                     </div>

                                 </div>
                                 <div class="button-group">
                                     <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                     <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                     <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                 </div>
                                 <div class="cart-hover">
                                     <button class="btn btn-cart">add to cart</button>
                                 </div>
                             </figure>
                             <div class="product-caption text-center">


                                 <h6 class="product-name">
                                     <a href="product-details.html">Trà chanh leo dâu tây</a>
                                 </h6>
                                 <div class="price-box">
                                     <span class="price-regular">45.000 ₫ – 55.000 ₫</span>
                                 </div>
                             </div>
                         </div>
                         <!-- product item end -->

                         <!-- product item start -->
                         <div class="product-item">
                             <figure class="product-thumb">
                                 <a href="product-details.html">
                                     <img class="pri-img" src="assets/img/product/12.png" alt="product">
                                     <img class="sec-img" src="assets/img/product/11.png" alt="product">
                                 </a>
                                 <div class="product-badge">
                                     <div class="product-label new">
                                         <span>new</span>
                                     </div>

                                 </div>
                                 <div class="button-group">
                                     <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                     <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                     <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                 </div>
                                 <div class="cart-hover">
                                     <button class="btn btn-cart">add to cart</button>
                                 </div>
                             </figure>
                             <div class="product-caption text-center">


                                 <h6 class="product-name">
                                     <a href="product-details.html">Trà cam dâu tây</a>
                                 </h6>
                                 <div class="price-box">
                                     <span class="price-regular">55.000 ₫ – 80.000 ₫</span>
                                 </div>
                             </div>
                         </div>
                         <!-- product item end -->

                         <!-- product item start -->
                         <div class="product-item">
                             <figure class="product-thumb">
                                 <a href="product-details.html">
                                     <img class="pri-img" src="assets/img/product/13.png" alt="product">
                                     <img class="sec-img" src="assets/img/product/14.png" alt="product">
                                 </a>
                                 <div class="product-badge">
                                     <div class="product-label new">
                                         <span>sale</span>
                                     </div>

                                 </div>
                                 <div class="button-group">
                                     <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                     <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                     <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                 </div>
                                 <div class="cart-hover">
                                     <button class="btn btn-cart">add to cart</button>
                                 </div>
                             </figure>
                             <div class="product-caption text-center">


                                 <h6 class="product-name">
                                     <a href="product-details.html">Trà sữa kem cheese</a>
                                 </h6>
                                 <div class="price-box">
                                     <span class="price-regular">55.000 ₫ – 80.000 ₫</span>
                                 </div>
                             </div>
                         </div>
                         <!-- product item end -->

                         <!-- product item start -->
                         <div class="product-item">
                             <figure class="product-thumb">
                                 <a href="product-details.html">
                                     <img class="pri-img" src="assets/img/product/15.png" alt="product">
                                     <img class="sec-img" src="assets/img/product/16.png" alt="product">
                                 </a>
                                 <div class="product-badge">
                                     <div class="product-label new">
                                         <span>new</span>
                                     </div>
                                 </div>
                                 <div class="button-group">
                                     <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                     <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                     <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                 </div>
                                 <div class="cart-hover">
                                     <button class="btn btn-cart">add to cart</button>
                                 </div>
                             </figure>
                             <div class="product-caption text-center">


                                 <h6 class="product-name">
                                     <a href="product-details.html">Trà thanh long đỏ</a>
                                 </h6>
                                 <div class="price-box">
                                     <span class="price-regular">55.000 ₫ – 80.000 ₫</span>
                                 </div>
                             </div>
                         </div>
                         <!-- product item end -->

                         <!-- product item start -->
                         <div class="product-item">
                             <figure class="product-thumb">
                                 <a href="product-details.html">
                                     <img class="pri-img" src="assets/img/product/17.png" alt="product">
                                     <img class="sec-img" src="assets/img/product/18.png" alt="product">
                                 </a>
                                 <div class="product-badge">
                                     <div class="product-label new">
                                         <span>new</span>
                                     </div>

                                 </div>
                                 <div class="button-group">
                                     <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                     <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                     <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                 </div>
                                 <div class="cart-hover">
                                     <button class="btn btn-cart">add to cart</button>
                                 </div>
                             </figure>
                             <div class="product-caption text-center">


                                 <h6 class="product-name">
                                     <a href="product-details.html">Trà đào thạch anh</a>
                                 </h6>
                                 <div class="price-box">
                                     <span class="price-regular">60.000 ₫ – 85.000 ₫</span>
                                 </div>
                             </div>
                         </div>
                         <!-- product item end -->

                         <!-- product item start -->
                         <div class="product-item">
                             <figure class="product-thumb">
                                 <a href="product-details.html">
                                     <img class="pri-img" src="assets/img/product/19.png" alt="product">
                                     <img class="sec-img" src="assets/img/product/20.png" alt="product">
                                 </a>
                                 <div class="product-badge">
                                     <div class="product-label new">
                                         <span>new</span>
                                     </div>

                                 </div>
                                 <div class="button-group">
                                     <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                     <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                     <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                 </div>
                                 <div class="cart-hover">
                                     <button class="btn btn-cart">add to cart</button>
                                 </div>
                             </figure>
                             <div class="product-caption text-center">


                                 <h6 class="product-name">
                                     <a href="product-details.html">Trà chanh sả</a>
                                 </h6>
                                 <div class="price-box">
                                     <span class="price-regular">55.000 ₫ – 80.000 ₫</span>

                                 </div>
                             </div>
                         </div>
                         <!-- product item end -->
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- featured product area end -->

     <!-- testimonial area start -->
     <section class="testimonial-area section-padding lumitea-testimonial">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <!-- section title start -->
                     <div class="section-title text-center">
                         <h2 class="title">Khách Hàng Nói Gì Về LumiTea</h2>
                         <p class="sub-title">Những đánh giá tuyệt vời từ người yêu trà sữa</p>
                     </div>
                     <!-- section title start -->
                 </div>
             </div>
             <div class="row">
                 <div class="col-12">
                     <div class="testimonial-thumb-wrapper">
                         <div class="testimonial-thumb-carousel">
                             <div class="testimonial-thumb">
                                 <img src="assets/img/testimonial/avt1.jpg" alt="khách hàng LumiTea">
                             </div>
                             <div class="testimonial-thumb">
                                 <img src="assets/img/testimonial/avt2.jpg" alt="khách hàng LumiTea">
                             </div>
                             <div class="testimonial-thumb">
                                 <img src="assets/img/testimonial/avt3.jpg" alt="khách hàng LumiTea">
                             </div>
                             <div class="testimonial-thumb">
                                 <img src="assets/img/testimonial/avt4.jpg" alt="khách hàng LumiTea">
                             </div>
                         </div>
                     </div>
                     <div class="testimonial-content-wrapper">
                         <div class="testimonial-content-carousel">
                             <div class="testimonial-content">
                                 <p>Trà sữa LumiTea thực sự tuyệt vời! Hương vị thơm ngon, nguyên liệu tươi mới, và chất lượng luôn ổn định. Tôi ghé LumiTea gần như mỗi ngày. Yêu thích trà trân châu và trà sữa kem cheese của LumiTea nhất!</p>
                                 <div class="ratings">
                                     <span><i class="fa fa-star"></i></span>
                                     <span><i class="fa fa-star"></i></span>
                                     <span><i class="fa fa-star"></i></span>
                                     <span><i class="fa fa-star"></i></span>
                                     <span><i class="fa fa-star"></i></span>
                                 </div>
                                 <h5 class="testimonial-author">Linh Nguyễn</h5>
                                 <p class="customer-title">Sinh viên, Sài Gòn</p>
                             </div>
                             <div class="testimonial-content">
                                 <p>Rất ấn tượng với dịch vụ của LumiTea. Giao hàng nhanh, sản phẩm được đóng gói cẩn thận, và luôn nóng khi tới tay. Trà sữa trái cây nhiệt đới của LumiTea là lựa chọn hoàn hảo cho những ngày nắng.</p>
                                 <div class="ratings">
                                     <span><i class="fa fa-star"></i></span>
                                     <span><i class="fa fa-star"></i></span>
                                     <span><i class="fa fa-star"></i></span>
                                     <span><i class="fa fa-star"></i></span>
                                     <span><i class="fa fa-star"></i></span>
                                 </div>
                                 <h5 class="testimonial-author">Mai Trang</h5>
                                 <p class="customer-title">Nhân viên văn phòng, Hà Nội</p>
                             </div>
                             <div class="testimonial-content">
                                 <p>LumiTea không chỉ có trà sữa ngon, mà các nhân viên cũng rất thân thiện và quần quật phục vụ. Giá cả hợp lý, chất lượng cao. Các loại trà sữa khoai môn của LumiTea là đặc sản mà tôi thích nhất!</p>
                                 <div class="ratings">
                                     <span><i class="fa fa-star"></i></span>
                                     <span><i class="fa fa-star"></i></span>
                                     <span><i class="fa fa-star"></i></span>
                                     <span><i class="fa fa-star"></i></span>
                                     <span><i class="fa fa-star"></i></span>
                                 </div>
                                 <h5 class="testimonial-author">Anh Đức</h5>
                                 <p class="customer-title">Công nhân, Đà Nẵng</p>
                             </div>
                             <div class="testimonial-content">
                                 <p>Tôi là fan trà sữa và tôi đã thử nhiều thương hiệu. LumiTea thực sự nổi bật với hương vị đặc biệt và cách chế biến tuyệt vời. Mỗi lần uống, tôi cảm thấy những nguyên liệu tươi mới. Rất khuyến nghị LumiTea!</p>
                                 <div class="ratings">
                                     <span><i class="fa fa-star"></i></span>
                                     <span><i class="fa fa-star"></i></span>
                                     <span><i class="fa fa-star"></i></span>
                                     <span><i class="fa fa-star"></i></span>
                                     <span><i class="fa fa-star"></i></span>
                                 </div>
                                 <h5 class="testimonial-author">Hương Giang</h5>
                                 <p class="customer-title">Doanh nhân, Hồ Chí Minh</p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- testimonial area end -->


     <!-- latest blog area start -->
     <section class="latest-blog-area section-padding pt-0">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <!-- section title start -->
                     <div class="section-title text-center">
                         <h2 class="title">Chuyện trà</h2>
                         <p class="sub-title">-------------------------</p>
                     </div>
                     <!-- section title start -->
                 </div>
             </div>
             <div class="row">
                 <div class="col-12">
                     <div class="blog-carousel-active slick-row-10 slick-arrow-style">
                         <!-- blog post item start -->
                         <div class="blog-post-item">
                             <figure class="blog-thumb">
                                 <a href="blog-details.html">
                                     <img src="assets/img/blog/1.png" alt="blog image">
                                 </a>
                             </figure>
                             <div class="blog-content">
                                 <div class="blog-meta">
                                     <p>29/03/2018 | <a href="#">LumiTea</a></p>
                                 </div>
                                 <h5 class="blog-title">
                                     <a href="blog-details.html">Trà trái cây bao nhiêu calo? Cách uống trà trái cây để giảm cân 2023
                                     </a>
                                 </h5>
                             </div>
                         </div>
                         <!-- blog post item end -->

                         <!-- blog post item start -->
                         <div class="blog-post-item">
                             <figure class="blog-thumb">
                                 <a href="blog-details.html">
                                     <img src="assets/img/blog/2.png" alt="blog image">
                                 </a>
                             </figure>
                             <div class="blog-content">
                                 <div class="blog-meta">
                                     <p>25/03/2022 | <a href="#">LumiTea</a></p>
                                 </div>
                                 <h5 class="blog-title">
                                     <a href="blog-details.html">2 lý do Sữa ngũ cốc yến mạch RB tốt cho sức khỏe</a>
                                 </h5>
                             </div>
                         </div>
                         <!-- blog post item end -->

                         <!-- blog post item start -->
                         <div class="blog-post-item">
                             <figure class="blog-thumb">
                                 <a href="blog-details.html">
                                     <img src="assets/img/blog/3.png" alt="blog image">
                                 </a>
                             </figure>
                             <div class="blog-content">
                                 <div class="blog-meta">
                                     <p>09/012/2024 | <a href="#">LumiTea</a></p>
                                 </div>
                                 <h5 class="blog-title">
                                     <a href="blog-details.html">9 bước để mở quán trà sữa thành công 2026</a>
                                 </h5>
                             </div>
                         </div>
                         <!-- blog post item end -->

                         <!-- blog post item start -->
                         <div class="blog-post-item">
                             <figure class="blog-thumb">
                                 <a href="blog-details.html">
                                     <img src="assets/img/blog/4.png" alt="blog image">
                                 </a>
                             </figure>
                             <div class="blog-content">
                                 <div class="blog-meta">
                                     <p>25/06/2024 | <a href="#">LumiTea</a></p>
                                 </div>
                                 <h5 class="blog-title">
                                     <a href="blog-details.html">Bí quyết trà sữa trân châu đường nâu Lumitea</a>
                                 </h5>
                             </div>
                         </div>
                         <!-- blog post item end -->

                         <!-- blog post item start -->
                         <div class="blog-post-item">
                             <figure class="blog-thumb">
                                 <a href="blog-details.html">
                                     <img src="assets/img/blog/5.png" alt="blog image">
                                 </a>
                             </figure>
                             <div class="blog-content">
                                 <div class="blog-meta">
                                     <p>25/07/2025 | <a href="#">LumiTea</a></p>
                                 </div>
                                 <h5 class="blog-title">
                                     <a href="blog-details.html">Vì sao sữa ngũ cốc yến mạch lại tốt cho sức khỏe?</a>
                                 </h5>
                             </div>
                         </div>
                         <!-- blog post item end -->
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- latest blog area end -->

     <!-- brand logo area start -->
     <div class="brand-logo section-padding pt-0">
         <div class="container">
             <div class="row">
                 <div class="col-12">

                 </div>
             </div>
         </div>
     </div>
     </div>
     <!-- brand logo area end -->
 </main>



 <?php include_once 'views/layout/miniCart.php'; ?>
 <?php include_once 'views/layout/footer.php'; ?>