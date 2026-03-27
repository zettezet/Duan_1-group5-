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
                                 <li class="breadcrumb-item active" aria-current="page">login-Register</li>
                             </ul>
                         </nav>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- breadcrumb area end -->

     <!-- login register wrapper start -->
     <div class="login-register-wrapper section-padding">
         <div class="container" style="max-width: 40vw">
             <div class="member-area-from-wrap">
                 <div class="row">
                     <!-- Register Content Start -->
                     <div class="col-lg-12">
                         <div class="login-reg-form-wrap sign-up-form">
                             <h5>Singup Form</h5>
                             <form action="<?= BASE_URL . '?act=register' ?>" method="post" enctype="multipart/form-data">
                                 <div class="single-input-item">
                                     <label for="">Họ tên</label>
                                     <input type="text" name="ho_ten" placeholder="Full Name" required />
                                 </div>
                                 <div class="single-input-item">
                                     <label for="">avatar</label>
                                     <input type="file" name="anh_dai_dien" required />
                                 </div>
                                 <div class="single-input-item">
                                     <label for="">Ngày sinh</label>
                                     <input type="date" name="ngay_sinh" required />
                                 </div>
                                 <div class="single-input-item">
                                     <label for="">Email</label>
                                     <input type="email" name="email" placeholder="Email" required />
                                 </div>
                                 <div class="single-input-item">
                                     <label for="">Số điện thoại</label>
                                     <input type="text" name="so_dien_thoai" placeholder="số điện thoại" required />
                                 </div>
                                 <div class="single-input-item">
                                     <label for="">Giới tính</label>
                                     <select name="gioi_tinh" required>
                                         <option value="1">Nam</option>
                                         <option value="0">Nữ</option>
                                         <option value="2">Khác</option>
                                     </select>
                                 </div>
                                 <div class="single-input-item">
                                     <label for="">Địa chỉ</label>
                                     <input type="text" name="dia_chi" placeholder="Địa chỉ" required />
                                 </div>
                                 <div class="row">
                                     <div class="col-lg-6">
                                         <div class="single-input-item">
                                             <label for="">Mật khẩu</label>
                                             <input type="password" name="mat_khau" placeholder="Enter your Password" required />
                                         </div>
                                     </div>
                                     <div class="col-lg-6">
                                         <div class="single-input-item">
                                             <label for="">Nhập lại mật khẩu</label>
                                             <input type="password" name="confirm_mat_khau" placeholder="Repeat your Password" required />
                                         </div>
                                     </div>
                                 </div>
                                 <div class="single-input-item">
                                     <button class="btn btn-sqr">Register</button>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- login register wrapper end -->
 </main>

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
                         <li class="minicart-item">
                             <div class="minicart-thumb">
                                 <a href="product-details.html">
                                     <img src="assets/img/cart/cart-1.jpg" alt="product">
                                 </a>
                             </div>
                             <div class="minicart-content">
                                 <h3 class="product-name">
                                     <a href="product-details.html">Dozen White Botanical Linen Dinner Napkins</a>
                                 </h3>
                                 <p>
                                     <span class="cart-quantity">1 <strong>&times;</strong></span>
                                     <span class="cart-price">$100.00</span>
                                 </p>
                             </div>
                             <button class="minicart-remove"><i class="pe-7s-close"></i></button>
                         </li>
                         <li class="minicart-item">
                             <div class="minicart-thumb">
                                 <a href="product-details.html">
                                     <img src="assets/img/cart/cart-2.jpg" alt="product">
                                 </a>
                             </div>
                             <div class="minicart-content">
                                 <h3 class="product-name">
                                     <a href="product-details.html">Dozen White Botanical Linen Dinner Napkins</a>
                                 </h3>
                                 <p>
                                     <span class="cart-quantity">1 <strong>&times;</strong></span>
                                     <span class="cart-price">$80.00</span>
                                 </p>
                             </div>
                             <button class="minicart-remove"><i class="pe-7s-close"></i></button>
                         </li>
                     </ul>
                 </div>

                 <div class="minicart-pricing-box">
                     <ul>
                         <li>
                             <span>sub-total</span>
                             <span><strong>$300.00</strong></span>
                         </li>
                         <li>
                             <span>Eco Tax (-2.00)</span>
                             <span><strong>$10.00</strong></span>
                         </li>
                         <li>
                             <span>VAT (20%)</span>
                             <span><strong>$60.00</strong></span>
                         </li>
                         <li class="total">
                             <span>total</span>
                             <span><strong>$370.00</strong></span>
                         </li>
                     </ul>
                 </div>

                 <div class="minicart-button">
                     <a href="cart.html"><i class="fa fa-shopping-cart"></i> View Cart</a>
                     <a href="cart.html"><i class="fa fa-share"></i> Checkout</a>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <?php include_once 'views/layout/footer.php'; ?>