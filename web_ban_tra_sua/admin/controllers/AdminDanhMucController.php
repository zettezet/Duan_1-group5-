<?php

class AdminDanhMucController{

    public $modelDanhMuc;
    public function __construct()
    {
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    public function danhSachDanhMuc(){

        $listDanhMuc = $this->modelDanhMuc->getALLDanhMuc();
        require_once './views/danhmuc/listDanhMuc.php';
    }

    public function formAddDanhMuc(){
        // hàm này hiển thị form nhập
        require_once './views/danhmuc/addDanhMuc.php';
    }
    public function postAddDanhMuc(){
        // hàm này dùng để xử lý thêm dữ liệu
        

        // kiểm tra xem dữ liệu có phải đc submit lên không
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            // tạo 1 mảng trống để chứa dữ liệu
            $errors=[];
            if(empty($ten_danh_muc)){
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }
           
            // nếu mảng lỗi rỗng thì mới thực hiện thêm danh mục
            if(empty($errors)){
                // ko lỗi thì thực hiện thêm
                // var_dump('Oke');

                $this->modelDanhMuc->insertDanhMuc($ten_danh_muc, $mo_ta);
                header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else{
            // trả về form và lỗi
            require_once './views/danhmuc/addDanhMuc.php';
        }

    }
}

        public function formEditDanhMuc(){
        // hàm này hiển thị form nhập
        // lấy ra tt của danh mục cần sửa
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetaiDanhMuc($id);
        if(!$danhMuc){
            header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }else{
            require_once './views/danhmuc/editDanhMuc.php';
        }
        
    }
    public function postEditDanhMuc(){
        // hàm này dùng để xử lý thêm dữ liệu
        

        // kiểm tra xem dữ liệu có phải đc submit lên không
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            // tạo 1 mảng trống để chứa dữ liệu
            $errors=[];
            if(empty($ten_danh_muc)){
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }
           
            // nếu mảng lỗi rỗng thì mới thực hiện sua danh mục
            if(empty($errors)){
                // ko lỗi thì thực hiện sua
                // var_dump('Oke');

                $this->modelDanhMuc->updateDanhMuc($id, $ten_danh_muc, $mo_ta);
                header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else{
            // trả về form và lỗi
            $danhMuc = [
                'id' => $id,
                'ten_danh_muc' => $ten_danh_muc,
                'mo_ta' => $mo_ta
               
            ];
            require_once './views/danhmuc/editDanhMuc.php';
        }

    }
}
    public function deleteDanhMuc(){
         
         $id = $_GET['id_danh_muc'];
         $danhMuc = $this->modelDanhMuc->getDetaiDanhMuc($id);

        if($danhMuc){
            $this->modelDanhMuc->destroyDanhMuc($id);
            
        }
            header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
    }
}