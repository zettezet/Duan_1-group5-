<?php

class AdminSanPhamController
{

    public $modelSanPham;
    public $modelDanhMuc;
    public function __construct()
    {
        $this->modelSanPham = new AdminSanPham();
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    public function danhSachSanPham()
    {

        $listSanPham = $this->modelSanPham->getALLSanPham();
        require_once './views/sanpham/listSanPham.php';
    }

    public function formAddSanPham()
    {
        // hàm này hiển thị form nhập
        $listDanhMuc = $this->modelDanhMuc->getALLDanhMuc();
        require_once './views/sanpham/addSanPham.php';

        deleteSessionError();
    }
    public function postAddSanPham()
    {
        // hàm này dùng để xử lý thêm dữ liệu


        // kiểm tra xem dữ liệu có phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            $hinh_anh = $_FILES['hinh_anh'] ?? null;

            // Lưu hình ảnh vào
            $file_thumb = uploadFile($hinh_anh, './uploads/');
            //Mảng hình ảnh
            $img_array = $_FILES['img_array'];

            // tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
            }
            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = 'giá sản phẩm không được để trống';
            }
            if (empty($gia_khuyen_mai)) {
                $errors['gia_khuyen_mai'] = 'gia khuyến mai san phẩm không được để trong';
            }
            if (empty($so_luong)) {
                $errors['so_luong'] = 'số lượng sản phẩm không được để trống';
            }

            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'ngay nhap san phẩm không được đe trong';
            }

            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'danh mục sản phẩm phải chọn';
            }

            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'trạng thái sản phẩm phải chọn';
            }
            if ($hinh_anh['error'] !== 0) {
                $errors['hinh_anh'] = 'Phải chọn ảnh sản phẩm';
            }
            $_SESSION['error'] = $errors;

            // nếu mảng lỗi rỗng thì mới thực hiện thêm sản phẩm
            if (empty($errors)) {
                // ko lỗi thì thực hiện thêm sản phẩm
                // var_dump('Oke');

                $san_pham_id = $this->modelSanPham->insertSanPham(
                    $ten_san_pham,
                    $gia_san_pham,
                    $gia_khuyen_mai,
                    $so_luong,
                    $ngay_nhap,
                    $danh_muc_id,
                    $trang_thai,
                    $mo_ta,
                    $file_thumb
                );

                // Xử lý thêm album ảnh sản phẩm img_array
                if (!empty($img_array['name'])) {
                    foreach ($img_array['name'] as $key => $value) {
                        $file = [
                            'name' => $img_array['name'][$key],
                            'type' => $img_array['type'][$key],
                            'tmp_name' => $img_array['tmp_name'][$key],
                            'error' => $img_array['error'][$key],
                            'size' => $img_array['size'][$key]
                        ];
                        $link_hinh_anh = uploadFile($file, './uploads/');
                        $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh);
                    }
                }
                header('Location: ' . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                // trả về form và lỗi

                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-them-san-pham');
                exit();
            }
        }
    }

    public function formEditSanPham()
    {
        // hàm này hiển thị form nhập
        // lấy ra tt của danh mục cần sửa
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listDanhMuc = $this->modelDanhMuc->getALLDanhMuc();
        if (!$sanPham) {
            header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        } else {
            require_once './views/sanpham/editSanPham.php';
        }
    }


    public function postEditSanPham()
    {
        // hàm này dùng để xử lý thêm dữ liệu


        // kiểm tra xem dữ liệu có phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $san_pham_id = $_POST['san_pham_id'] ?? '';

            $sanPhamOld = $this->modelSanPham->getDetailSanPham($san_pham_id);
            $old_file = $sanPhamOld['hinh_anh'];

            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            $hinh_anh = $_FILES['hinh_anh'] ?? null;


            // tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
            }
            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = 'giá sản phẩm không được để trống';
            }
            if (empty($gia_khuyen_mai)) {
                $errors['gia_khuyen_mai'] = 'gia khuyến mai san phẩm không được để trong';
            }
            if (empty($so_luong)) {
                $errors['so_luong'] = 'số lượng sản phẩm không được để trống';
            }

            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'ngay nhap san phẩm không được đe trong';
            }

            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'danh mục sản phẩm phải chọn';
            }

            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'trạng thái sản phẩm phải chọn';
            }
            $_SESSION['error'] = $errors;

            // logic sửa ảnh
            if (isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK) {
                // upload ảnh mới lên
                $new_file = uploadFile($hinh_anh, './uploads/');

                if (!empty($old_file)) { // Nếu có ảnh cũ thì xóa đi
                    deleteFile($old_file);
                }
            } else {
                $new_file = $old_file;
            }
            // nếu mảng lỗi rỗng thì mới thực hiện thêm sản phẩm
            if (empty($errors)) {
                // ko lỗi thì thực hiện thêm sản phẩm
                // var_dump('Oke');

                $san_pham_id = $this->modelSanPham->updateSanPham(
                    $san_pham_id,
                    $ten_san_pham,
                    $gia_san_pham,
                    $gia_khuyen_mai,
                    $so_luong,
                    $ngay_nhap,
                    $danh_muc_id,
                    $trang_thai,
                    $mo_ta,
                    $new_file
                );

                // Xử lý thêm album ảnh sản phẩm img_array

                header('Location: ' . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                // trả về form và lỗi

                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
                exit();
            }
        }
    }

    public function postEditAnhSanPham()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $san_pham_id = $_POST['san_pham_id'] ?? '';

            // Lấy danh sách ảnh hiện tại của sản phẩm

            $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($san_pham_id);

            // xử lý các ảnh được gửi từ form
            $img_array = $_FILES['img_array'];
            $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
            $current_img_ids = $_POST['current_img_ids'] ?? [];

            // Khai báo mảng để lưu ảnh thêm mới hoặc thay thế ảnh cũ
            $upload_file = [];

            // Upload ảnh mới hoặc thay thế ảnh cũ
            foreach ($img_array['name'] as $key => $value) {
                if ($img_array['error'][$key] == UPLOAD_ERR_OK) {
                    $new_file = uploadFileAlbum($img_array, './uploads/', $key);
                    if ($new_file) {
                        $upload_file[] = [
                            'id' => $current_img_ids[$key] ?? null,
                            'file' => $new_file
                        ];
                    }
                }
            }
            // Lưu ảnh mới vào db và xóa ảnh cũ nếu có
            foreach ($upload_file as $file_info) {
                if ($file_info['id']) {
                    $old_file = $this->modelSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];

                    // cập nhật ảnh cũ
                    $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);

                    // xóa ảnh cũ
                    deleteFile($old_file);
                } else {
                    // Thêm ảnh mới
                    $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $file_info['file']);
                }
            }

            // Xu ly xoa anh
            foreach ($listAnhSanPhamCurrent as $anhSP) {
                $anh_id = $anhSP['id'];
                if (in_array($anh_id, $img_delete)) {
                    // Xóa ảnh trong db
                    $this->modelSanPham->destroyAnhSanPham($anh_id);

                    // Xóa file
                    deleteFile($anhSP['link_hinh_anh']);
                }
            }
            header("Location: " . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
            exit();
        }
    }

    // public function deleteSanPham()
    // {

    //     $id = $_GET['id_danh_muc'];
    //     $danhMuc = $this->modelSanPham->getDetaiDanhMuc($id);

    //     if ($danhMuc) {
    //         $this->modelSanPham->destroyDanhMuc($id);
    //     }
    //     header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
    //     exit();
    // }
}
