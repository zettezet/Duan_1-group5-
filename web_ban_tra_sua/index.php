<?php

session_start();

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';

// Require toàn bộ file Models
require_once './models/SanPham.php';
require_once './models/TaiKhoan.php';
require_once './models/GioHang.php';
require_once './models/DonHang.php';


// Route
$act = $_GET['act'] ?? '/';
// var_dump($_GET['act']);die();

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // route
    '/' => (new HomeController())->home(),

    'chi-tiet-san-pham' => (new HomeController())->chiTietSanPham(),
    'them-gio-hang' => (new HomeController())->addGioHang(),
    'gio-hang' => (new HomeController())->GioHang(),
    'thanh-toan' => (new HomeController())->ThanhToan(),
    'xu-ly-thanh-toan' => (new HomeController())->postThanhToan(),
    'lich-su-mua-hang' => (new HomeController())->lichSuMuaHang(),
    'chi-tiet-mua-hang' => (new HomeController())->chiTietMuaHang(),
    'huy-don-hang' => (new HomeController())->huyDonHang(),
    'tim-kiem' => (new HomeController())->timKiemSanPham(),
    'thong-tin-tai-khoan' => (new HomeController())->thongTinTaiKhoan(),
    'cap-nhat-tai-khoan' => (new HomeController())->capNhatTaiKhoan(),
    'san-pham' => (new HomeController())->sanPham(),
    'gioi-thieu' => (new HomeController())->gioiThieu(),
    'lien-he' => (new HomeController())->lienHe(),


    // auth
    'login' => (new HomeController())->formLogin(),
    'register' => (new HomeController())->register(),
    'logout' => (new HomeController())->logout(),
    'check-login' => (new HomeController())->postLogin(),
};
