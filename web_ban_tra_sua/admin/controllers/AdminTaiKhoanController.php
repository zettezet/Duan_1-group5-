<?php

class AdminTaiKhoanController
{
    public $modelTaiKhoan;

    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
    }

    public function danhSachQuanTri()
    {
        $listQuanTri = $this->modelTaiKhoan->getALLTaiKhoan(1);

        require_once './views/taikhoan/quantri/listQuanTri.php';
    }

    public function formAddQuanTri()
    {
        require_once './views/taikhoan/quantri/addQuanTri.php';

        deleteSessionError();
    }

    public function postAddQuanTri()
    {
        $ho_ten = $_POST['ho_ten'];
        $email = $_POST['email'];

        // tạo 1 mảng trống để chứa dữ liệu
        $error = [];
        if (empty($ho_ten)) {
            $error['ho_ten'] = 'Họ tên không được để trống';
        }

        if (empty($email)) {
            $error['email'] = 'Email không được để trống';
        }

        $_SESSION['error'] = $error;

        // nếu ko có lỗi thì sẽ tiến hành thêm mới
        if (empty($error)) {
            // nếu ko có lỗi thì sẽ tiến hành thêm mới
            // var_dump('oke');
            // đặt password mặc định là 123456
            $password = password_hash('123@123ab', PASSWORD_DEFAULT);
            // var_dump($password);// die();
            $chuc_vu_id = 1; // mặc định là quản trị viên
            $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, $chuc_vu_id);



            header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
            exit();
        } else {
            // trả về form và lỗi 
            $_SESSION['flash'] = true;
            header('Location: ' . BASE_URL_ADMIN . '?act=form-them-quan-tri');
            exit();
        }
    }
    public function formEditQuanTri()
    {
        $id_quan_tri = $_GET['id_quan_tri'];
        $quantri = $this->modelTaiKhoan->getDetaiTaikhoan($id_quan_tri);
        // var_dump($quantri);die;

        require_once './views/taikhoan/quantri/editQuantri.php';

        deleteSessionError();
    }


    public function postEditQuanTri()
    {
        // hàm này dùng để xử lý thêm dữ liệu


        // kiểm tra xem dữ liệu có phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $quan_tri_id = $_POST['quan_tri_id'] ?? '';

            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';



            // tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên người dùng không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'email người dùng không được để trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = ' nvui lòng chọn trạng thái';
            }


            $_SESSION['error'] = $errors;
            if (empty($errors)) {

                $this->modelTaiKhoan->updateTaikhoan(
                    $quan_tri_id,
                    $ho_ten,
                    $email,
                    $so_dien_thoai,
                    $trang_thai
                );
                // Xử lý thêm album ảnh sản phẩm img_array

                header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit();
            } else {
                // trả về form và lỗi

                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-quan-tri&id_quan_tri=' . $quan_tri_id);
                exit();
            }
        }
    }
    public function resetPassword()
    {
        $tai_khoan_id = $_GET['id_quan_tri'];
        $tai_khoan = $this->modelTaiKhoan->getDetaiTaikhoan($tai_khoan_id);
        $password = password_hash('123@123ab', PASSWORD_DEFAULT);
        $status = $this->modelTaiKhoan->resetPassword($tai_khoan_id, $password);

        if ($status && $tai_khoan['chu_vu_id'] == 1) {
            header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
            exit();
        } elseif ($status && $tai_khoan['chu_vu_id'] == 2) {
            header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
            exit();
        } else {
            var_dump('lỗi khi reset tài khoản');
            die;
        }

    }

    public function danhSachKhachhang()
    {
        $listKhachhang = $this->modelTaiKhoan->getALLTaiKhoan(2);
        require_once './views/taikhoan/khachhang/listKhachhang.php';
    }

    public function formEditKhachhang()
    {
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachhang = $this->modelTaiKhoan->getDetaiTaikhoan($id_khach_hang);
        // var_dump($khachhang);die;

        require_once './views/taikhoan/khachhang/editKhachhang.php';

        deleteSessionError();
    }

    public function postEditKhachhang()
    {
        // hàm này dùng để xử lý thêm dữ liệu


        // kiểm tra xem dữ liệu có phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $khach_hang_id = $_POST['khach_hang_id'] ?? '';

            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';



            // tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên người dùng không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'email người dùng không được để trống';
            }
            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = 'ngay_sinh người dùng không được để trống';
            }
            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = 'gioi_tinh người dùng không được để trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = ' nvui lòng chọn trạng thái';
            }


            $_SESSION['error'] = $errors;
            if (empty($errors)) {

                $this->modelTaiKhoan->updatekhachhang(
                    $khach_hang_id,
                    $ho_ten,
                    $email,
                    $so_dien_thoai,
                    $ngay_sinh,
                    $gioi_tinh,
                    $dia_chi,
                    $trang_thai
                );
                // Xử lý thêm album ảnh sản phẩm img_array

                header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
                exit();
            } else {
                // trả về form và lỗi

                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-khach-hang&id_khach_hang=' . $khach_hang_id);
                exit();
            }
        }
    }


}
