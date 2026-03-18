<?php

class AdminDonHangController
{

    public $modelDonHang;


    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
    }
    public function danhSachDonHang()
    {

        $listDonHang = $this->modelDonHang->getALLDonHang();
        require_once './views/donhang/listDonHang.php';
    }

    public function detailDonHang()
    {
        $don_hang_id = $_GET['id_don-hang'];
        // lấy thông tin đơn hàng ở bảng don_hangs
        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);
        $sanPhamDonHang = $this->modelDonHang->getListAnhDonHang($don_hang_id);
        $listTrangThaiDonHang = $this->modelDonHang->getALLTrangThaiDonHang();
        require_once './views/donhang/detaiDonHang.php';
    }



    public function formEditDonHang()
    {
        // hàm này hiển thị form nhập
        // lấy ra tt của danh mục cần sửa
        $id = $_GET['id_don-hang'];
        $donHang = $this->modelDonHang->getDetailDonHang($id);
        $listTrangThaiDonHang = $this->modelDonHang->getALLTrangThaiDonHang();
        if ($donHang) {
            require_once './views/donhang/editDonHang.php';
            deleteSessionError();
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }
    }


    public function postEditDonHang()
    {
        // hàm này dùng để xử lý thêm dữ liệu


        // kiểm tra xem dữ liệu có phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $don_hang_id = $_POST['don_hang_id'] ?? '';

            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? '';
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? '';
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            $trang_thai_id = $_POST['trang_thai_id'] ?? '';

            // tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ten_nguoi_nhan)) {
                $errors['ten_nguoi_nhan'] = 'Tên người nhận không được để trống';
            }
            if (empty($email_nguoi_nhan)) {
                $errors['email_nguoi_nhan'] = 'Email không được để trống';
            }
            if (empty($sdt_nguoi_nhan)) {
                $errors['sdt_nguoi_nhan'] = 'Số điện thoại không được để trống';
            }
            if (empty($dia_chi_nguoi_nhan)) {
                $errors['dia_chi_nguoi_nhan'] = 'Địa chỉ không được để trống';
            }

            if (empty($trang_thai_id)) {
                $errors['trang_thai_id'] = 'Trạng thái đơn hàng';
            }

            $_SESSION['error'] = $errors;

            // nếu mảng lỗi rỗng thì mới thực hiện thêm sản phẩm
            if (empty($errors)) {
                // ko lỗi thì thực hiện thêm sản phẩm
                // var_dump('Oke');

                $san_pham_id = $this->modelDonHang->updateDonHang(
                    $don_hang_id,
                    $ten_nguoi_nhan,
                    $email_nguoi_nhan,
                    $sdt_nguoi_nhan,
                    $dia_chi_nguoi_nhan,
                    $ghi_chu,
                    $trang_thai_id
                );
                // Xử lý thêm album ảnh sản phẩm img_array

                header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
                exit();
            } else {
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $don_hang_id);
                exit();
            }
        }
    }

    // public function postEditAnhSanPham()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $san_pham_id = $_POST['san_pham_id'] ?? '';

    //         // Lấy danh sách ảnh hiện tại của sản phẩm

    //         $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($san_pham_id);

    //         // xử lý các ảnh được gửi từ form
    //         $img_array = $_FILES['img_array'];
    //         $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
    //         $current_img_ids = $_POST['current_img_ids'] ?? [];

    //         // Khai báo mảng để lưu ảnh thêm mới hoặc thay thế ảnh cũ
    //         $upload_file = [];

    //         // Upload ảnh mới hoặc thay thế ảnh cũ
    //         foreach ($img_array['name'] as $key => $value) {
    //             if ($img_array['error'][$key] == UPLOAD_ERR_OK) {
    //                 $new_file = uploadFileAlbum($img_array, './uploads/', $key);
    //                 if ($new_file) {
    //                     $upload_file[] = [
    //                         'id' => $current_img_ids[$key] ?? null,
    //                         'file' => $new_file
    //                     ];
    //                 }
    //             }
    //         }
    //         // Lưu ảnh mới vào db và xóa ảnh cũ nếu có
    //         foreach ($upload_file as $file_info) {
    //             if ($file_info['id']) {
    //                 $old_file = $this->modelSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];
    //                 // cập nhật ảnh cũ
    //                 $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);
    //                 // xóa ảnh cũ
    //                 deleteFile($old_file);
    //             } else {
    //                 // Thêm ảnh mới
    //                 $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $file_info['file']);
    //             }
    //         }

    //         // Xu ly xoa anh
    //         foreach ($listAnhSanPhamCurrent as $anhSP) {
    //             $anh_id = $anhSP['id'];
    //             if (in_array($anh_id, $img_delete)) {
    //                 // Xóa ảnh trong db
    //                 $this->modelSanPham->destroyAnhSanPham($anh_id);

    //                 // Xóa file
    //                 deleteFile($anhSP['link_hinh_anh']);
    //             }
    //         }
    //         header("Location: " . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
    //         exit();
    //     }
    // }

    // public function deleteSanPham()
    // {

    //     $id = $_GET['id_san_pham'];
    //     $sanPham = $this->modelSanPham->getDetailSanPham($id);

    //     $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

    //     if ($sanPham) {
    //         deleteFile($sanPham['hinh_anh']);
    //         $this->modelSanPham->destroySanPham($id);

    //         if ($listAnhSanPham) {
    //             foreach ($listAnhSanPham as $key => $anhSP)
    //                 deleteFile($anhSP['link_hinh_anh']);
    //             $this->modelSanPham->destroyAnhSanPham($anhSP['id']);
    //         }
    //     }

    //     header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
    //     exit();
    // }
    // public function detailSanPham()
    // {

    //     $id = $_GET['id_san_pham'];

    //     $sanPham = $this->modelSanPham->getDetailSanPham($id);
    //     $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

    //     if ($sanPham) {
    //         require_once './views/sanpham/detailSanPham.php';
    //     } else {
    //         header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
    //         exit();
    //     }
    // }
}
