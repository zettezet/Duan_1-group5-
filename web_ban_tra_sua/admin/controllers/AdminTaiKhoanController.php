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
}
