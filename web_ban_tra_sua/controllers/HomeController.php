<?php

class HomeController
{

    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;
    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
    }

    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }

    public function sanPham()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();
        $danh_muc_id = $_GET['danh_muc_id'] ?? '';

        if ($danh_muc_id) {
            $listSanPham = $this->modelSanPham->getListSanPhamTheoDanhMuc($danh_muc_id);
            $currentDanhMuc = array_filter($listDanhMuc, fn($dm) => $dm['id'] == $danh_muc_id);
            $currentDanhMuc = reset($currentDanhMuc);
        } else {
            $listSanPham = $this->modelSanPham->getAllSanPham();
            $currentDanhMuc = null;
        }

        require_once './views/products.php';
    }

    public function timKiemSanPham()
    {
        $keyword = trim($_GET['keyword'] ?? '');
        if ($keyword === '') {
            $listSanPham = $this->modelSanPham->getAllSanPham();
        } else {
            $listSanPham = $this->modelSanPham->searchSanPhamByName($keyword);
        }
        require_once './views/search.php';
    }

    public function thongTinTaiKhoan()
    {
        if (!isset($_SESSION['user_client'])) {
            header('Location: ' . BASE_URL . '?act=login');
            exit();
        }

        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

        require_once './views/userProfile.php';
    }

    public function capNhatTaiKhoan()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_client'])) {
            header('Location: ' . BASE_URL);
            exit();
        }

        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
        if (!$user) {
            header('Location: ' . BASE_URL . '?act=login');
            exit();
        }

        $data = [
            'ho_ten' => trim($_POST['ho_ten'] ?? $user['ho_ten']),
            'so_dien_thoai' => trim($_POST['so_dien_thoai'] ?? $user['so_dien_thoai']),
            'dia_chi' => trim($_POST['dia_chi'] ?? $user['dia_chi']),
        ];

        if (!empty($_FILES['anh_dai_dien']['name'])) {
            $anh = $_FILES['anh_dai_dien'];
            $fileName = time() . '_' . basename($anh['name']);
            $uploadPath = 'uploads/' . $fileName;
            if (move_uploaded_file($anh['tmp_name'], $uploadPath)) {
                $data['anh_dai_dien'] = $uploadPath;
            }
        }

        if (!empty($_POST['ngay_sinh'])) {
            $data['ngay_sinh'] = $_POST['ngay_sinh'];
        }

        $this->modelTaiKhoan->updateTaiKhoan($user['id'], $data);

        header('Location: ' . BASE_URL . '?act=thong-tin-tai-khoan&success=1');
        exit();
    }

    public function chiTietSanPham()
    {
        $id = $_GET['id_san_pham'];

        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);
        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamTheoDanhMuc($sanPham['danh_muc_id']);
        if ($sanPham) {
            require_once './views/detailSanPham.php';
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

    public function themBinhLuan()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL);
            exit();
        }

        if (!isset($_SESSION['user_client'])) {
            header('Location: ' . BASE_URL . '?act=login');
            exit();
        }

        $san_pham_id = $_POST['san_pham_id'] ?? null;
        $noi_dung = trim($_POST['noi_dung'] ?? '');

        if (!$san_pham_id || $noi_dung === '') {
            header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id . '&error=1');
            exit();
        }

        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
        if (!$user) {
            header('Location: ' . BASE_URL . '?act=login');
            exit();
        }

        $this->modelSanPham->addBinhLuan($san_pham_id, $user['id'], $noi_dung);

        header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id . '&success=1');
        exit();
    }

    public function formLogin()
    {
        require_once './views/auth/formLogin.php';
        deleteSessionError();
        exit();
    }

    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy email và pass gửi lên từ form 
            $email = $_POST['email'];
            $password = $_POST['password'];

            // var_dump($email);
            // die();


            // xử lý kiểm tra thông tin đăng nhập
            $user = $this->modelTaiKhoan->checkLogin($email, $password);


            if ($user == $email) { // Trường hợp đăng nhập thành công
                // lưu thông tin vào session 
                $_SESSION['user_client'] = $user;
                header('Location: ' . BASE_URL);
                exit();
            } else {
                // lỗi thì lưu vào session
                $_SESSION['error'] = $user;
                // var_dump($_SESSION['error']);
                // die();

                $_SESSION['flash'] = true;

                header('Location: ' . BASE_URL_ADMIN . '?act=login');
                exit();
            }
        }
    }

    public function register()
    {
        $modelTaiKhoan = new TaiKhoan();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $_POST['email'];

            // check email
            if ($modelTaiKhoan->findEmail($email)) {
                echo "Email đã tồn tại";
                exit();
            }

            // check password
            if ($_POST['mat_khau'] !== $_POST['confirm_mat_khau']) {
                echo "Mật khẩu không khớp";
                exit();
            }

            // upload file
            $file = $_FILES['anh_dai_dien'];
            $file_name = time() . "_" . $file['name'];
            move_uploaded_file($file['tmp_name'], "uploads/" . $file_name);

            $data = [
                'ho_ten' => $_POST['ho_ten'],
                'anh_dai_dien' => $file_name,
                'ngay_sinh' => $_POST['ngay_sinh'],
                'email' => $_POST['email'],
                'so_dien_thoai' => $_POST['so_dien_thoai'],
                'gioi_tinh' => $_POST['gioi_tinh'],
                'dia_chi' => $_POST['dia_chi'],
                'mat_khau' => password_hash($_POST['mat_khau'], PASSWORD_DEFAULT),
                'chuc_vu_id' => 2,
                'trang_thai' => 1,
            ];

            $modelTaiKhoan->create($data);

            $_SESSION['success'] = "Đăng ký thành công! Vui lòng đăng nhập.";
            $_SESSION['flash'] = true;

            header("Location: " . BASE_URL . "?act=login");
            exit();
        }

        require_once './views/auth/formRegister.php';
    }

    // LOGOUT
    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();

        header("Location: " . BASE_URL . "?act=login");
        exit;
    }

    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_client'])) {
                $email = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
                $gioHang = $this->modelGioHang->getGioHangFromUser($email['id']);
                if (!$gioHang) {
                    $gioHangId = $this->modelGioHang->addGioHang($email['id']);
                    $gioHang = ['id' => $gioHangId];
                    $chiTietGioHang = $this->modelGioHang->detailGioHang($gioHang['id']);
                } else {
                    $chiTietGioHang = $this->modelGioHang->detailGioHang($gioHang['id']);
                }

                $san_pham_id = $_POST['san_pham_id'];
                $so_luong = max(1, intval($_POST['so_luong'] ?? 1));
                $sanPham = $this->modelSanPham->getDetailSanPham($san_pham_id);

                if (!$sanPham) {
                    header('Location:' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id . '&stock_error=1');
                    exit();
                }

                $currentSoLuongTrongGio = 0;
                foreach ($chiTietGioHang as $detail) {
                    if ($detail['san_pham_id'] == $san_pham_id) {
                        $currentSoLuongTrongGio = $detail['so_luong'];
                        break;
                    }
                }

                $newSoLuong = $currentSoLuongTrongGio + $so_luong;
                if ($newSoLuong > $sanPham['so_luong']) {
                    header('Location:' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id . '&stock_error=1&max_qty=' . $sanPham['so_luong']);
                    exit();
                }

                $checkSanPham = false;
                foreach ($chiTietGioHang as $detail) {
                    if ($detail['san_pham_id'] == $san_pham_id) {
                        $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $newSoLuong);
                        $checkSanPham = true;
                        break;
                    }
                }
                if (!$checkSanPham) {
                    $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
                }
                header('Location:' . BASE_URL . '?act=gio-hang');
            } else {
                var_dump('chưa đăng nhập');
                die;
            }
        }
    }

    public function GioHang()
    {
        if (isset($_SESSION['user_client'])) {
            $email = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $gioHang = $this->modelGioHang->getGioHangFromUser($email['id']);
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($email['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->detailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->detailGioHang($gioHang['id']);
            }

            require_once './views/giohang.php';
        } else {
            header('Location:' . BASE_URL . '?act=login');
        }
    }

    public function ThanhToan()
    {

        if (isset($_SESSION['user_client'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($user['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->detailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->detailGioHang($gioHang['id']);
            }

            require_once './views/thanhtoan.php';
        } else {
            var_dump('chưa đăng nhập');
            die;
        }
    }

    public function postThanhToan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //var_dump($_POST);die;
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];

            // Use full date+time so order history shows exact placement time
            $ngay_dat = date('Y-m-d H:i:s');
            $trang_thai_id = 1;

            $ma_don_hang = 'DH' . rand(1000, 9999);

            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            $gioHang = $this->modelGioHang->getGioHangFromUser($tai_khoan_id);
            $chiTietGioHang = $this->modelGioHang->detailGioHang($gioHang['id']);
            $stockErrors = [];
            foreach ($chiTietGioHang as $item) {
                $sanPham = $this->modelSanPham->getDetailSanPham($item['san_pham_id']);
                if (!$sanPham) {
                    continue;
                }
                if ($item['so_luong'] > $sanPham['so_luong']) {
                    $stockErrors[] = $sanPham['ten_san_pham'] . ' chỉ còn ' . $sanPham['so_luong'] . ' sản phẩm trong kho';
                }
            }

            if (!empty($stockErrors)) {
                $message = urlencode(implode(', ', $stockErrors));
                header('Location: ' . BASE_URL . '?act=thanh-toan&error_stock=1&message=' . $message);
                exit();
            }

            //Thêm thông tin vào db
            $donHang = $this->modelDonHang->addDonHang(
                $tai_khoan_id,
                $ten_nguoi_nhan,
                $email_nguoi_nhan,
                $sdt_nguoi_nhan,
                $dia_chi_nguoi_nhan,
                $ghi_chu,
                $tong_tien,
                $phuong_thuc_thanh_toan_id,
                $ngay_dat,
                $ma_don_hang,
                $trang_thai_id
            );

            // lưu sản phẩm vào chi tiết đơn hàng
            if ($donHang) {
                // lấy ra toàn bộ sản phẩm trong giỏ hàng   
                // $chiTietGioHang is already loaded above

                // thêm từng sản phẩm từ giỏ hàng vào bảng chi tiết đơn hàng
                foreach ($chiTietGioHang as $item) {
                    $donGia = $item['gia_khuyen_mai'] ?? $item['gia_san_pham']; //ưu tiên đơn giá sẽ lấy giá khuyến mãi
                    $this->modelDonHang->addChiTietDonHang(
                        $donHang, // id đơn hàng vừa tạo
                        $item['san_pham_id'],
                        $donGia,
                        $item['so_luong'],
                        $donGia * $item['so_luong']
                    );
                }
                // xóa toàn bộ thông tin chi tiết giỏ hàng
                $this->modelGioHang->clearDetailGioHang($gioHang['id']);
                // xóa thông tin giỏ hàng người dùng
                $this->modelGioHang->clearGioHang($tai_khoan_id);

                // chuyển hướng về trang lịch sử mua hàng và hiển thị thông báo thành công
                header("Location: " . BASE_URL . '?act=lich-su-mua-hang&success=1');
                exit;
            } else {
                var_dump('lỗi đặt hàng vui lòng thử lại sau');
                die;
            }
        }
    }

    public function lichSuMuaHang()
    {
        if (isset($_SESSION['user_client'])) {
            // lấy ra thông tin tài khoản đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            // lấy ra danh sách trạng thái đơn hàng
            $arrTrangThaiDonHang = $this->modelDonHang->getTrangThaiDonHang();
            $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');


            // lấy ra danh sách phương thức thanh toán
            $arrPhuongThucThanhToan = $this->modelDonHang->getPhuongThucThanhToan();
            $phuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc', 'id');

            // lấy ra danh sách tất cả đơn hàng của tài khoản
            $donHangs = $this->modelDonHang->getDonHangFromUser($tai_khoan_id);
            require_once './views/lichSuMuaHang.php';
        } else {
            var_dump('Bạn chưa đăng nhập');
            die;
        }
    }



    public function chiTietMuaHang()
    {
        if (isset($_SESSION['user_client'])) {
            // lấy ra thông tin tài khoản đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];


            // lấy id đơn hàng truyền từ URL
            $donHangId = $_GET['id'];

            // lấy ra danh sách trạng thái đơn hàng
            $arrTrangThaiDonHang = $this->modelDonHang->getTrangThaiDonHang();
            $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');


            // lấy ra danh sách phương thức thanh toán
            $arrPhuongThucThanhToan = $this->modelDonHang->getPhuongThucThanhToan();
            $phuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc', 'id');

            // lấy ra thông tin đơn hàng theo ID
            $donHang = $this->modelDonHang->getDonHangById($donHangId);



            // lấy tt sản phẩm của đơn hàng trong bảng chi tiết đơn hàng
            $chiTietDonHang = $this->modelDonHang->getChiTietDonHangByDonHangId($donHangId);
            // echo "<pre>";
            // print_r($donHang);
            // print_r($chiTietDonHang);

            if ($donHang['tai_khoan_id'] != $tai_khoan_id) {
                echo "Bạn không có quyền truy cập đơn hàng này.";
                exit;
            }

            require_once "./views/chiTietMuaHang.php";
        } else {
            var_dump('Bạn chưa đăng nhập');
            die;
        }
    }



    public function huyDonHang()
    {
        if (isset($_SESSION['user_client'])) {
            // lấy ra thông tin tài khoản đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];


            // lấy id đơn hàng truyền từ URL
            $donHangId = $_GET['id'];

            // kiểm tra đơn hàng
            $donHang = $this->modelDonHang->getDonHangById($donHangId);

            if ($donHang['tai_khoan_id'] != $tai_khoan_id) {
                echo "Bạn không có quyền hủy đơn hàng này";
                die;
            }

            if ($donHang['trang_thai_id'] != 1) {
                echo "Chỉ đơn hàng ở trạng thái 'Chưa xác nhận' mới được hủy";
                die;
            }

            // hủy đơn hàng
            $this->modelDonHang->updateTrangThaiDonHang($donHangId, 11);
            header("Location: " . BASE_URL . "?act=lich-su-mua-hang");
            exit();
        } else {
            var_dump('Bạn chưa đăng nhập');
            die;
        }
    }

    public function gioiThieu()
    {
        require_once './views/about.php';
    }

    public function lienHe()
    {
        require_once './views/contact.php';
    }

    public function xoaKhoiGioHang()
    {
        if (isset($_SESSION['user_client'])) {
            $san_pham_id = $_GET['id'] ?? $_POST['san_pham_id'] ?? 0;

            if ($san_pham_id) {
                $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
                $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);

                if ($gioHang) {
                    $this->modelGioHang->deleteDetailGioHang($gioHang['id'], $san_pham_id);
                }
            }

            // Nếu là AJAX request, trả về JSON
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo json_encode(['success' => true]);
                exit();
            } else {
                // Nếu là GET request, redirect về trang giỏ hàng
                header('Location: ' . BASE_URL . '?act=gio-hang');
                exit();
            }
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo json_encode(['success' => false, 'message' => 'Bạn chưa đăng nhập']);
            } else {
                header('Location: ' . BASE_URL . '?act=login');
            }
            exit();
        }
    }

    public function capNhatSoLuongGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_client'])) {
            $san_pham_id = $_POST['san_pham_id'] ?? 0;
            $so_luong = intval($_POST['so_luong'] ?? 1);

            if ($san_pham_id && $so_luong > 0) {
                $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
                $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
                $sanPham = $this->modelSanPham->getDetailSanPham($san_pham_id);

                if (!$sanPham) {
                    echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
                    exit();
                }

                if ($so_luong > $sanPham['so_luong']) {
                    echo json_encode(['success' => false, 'message' => 'Số lượng tối đa là ' . $sanPham['so_luong']]);
                    exit();
                }

                if ($gioHang) {
                    $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $so_luong);
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Không tìm thấy giỏ hàng']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ']);
        }
        exit();
    }
}
