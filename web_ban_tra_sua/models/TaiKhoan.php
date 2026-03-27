<?php

class TaiKhoan
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function checkLogin($email, $password)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':email' => $email
            ]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['mat_khau'])) {
                if ($user['chuc_vu_id'] == 2) {
                    if ($user['trang_thai'] == 1) {
                        return $user['email'];  // Đăng nhập thành công
                    } else {
                        return "Tài Khoản bị cấm";
                    }
                } else {
                    return "Tài Khoản không có quyền đăng nhập";
                }
            } else {
                return "Bạn nhập sai thông tin mật khẩu hoặc tài khoản";
            }
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
            return false;
        }
    }

    public function getTaiKhoanFromEmail($email)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':email' => $email
            ]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "loi" . $e->getMessage();
        }
    }
    public function findEmail($email)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':email' => $email
            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "loi" . $e->getMessage();
        }
    }
    public function create($data)
    {
        try {
            $sql = "INSERT INTO tai_khoans 
        (ho_ten, anh_dai_dien, ngay_sinh, email, so_dien_thoai, gioi_tinh, dia_chi, mat_khau, chuc_vu_id, trang_thai)
        VALUES 
        (:ho_ten, :anh_dai_dien, :ngay_sinh, :email, :so_dien_thoai, :gioi_tinh, :dia_chi, :mat_khau, :chuc_vu_id, :trang_thai)";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                ':ho_ten' => $data['ho_ten'],
                ':anh_dai_dien' => $data['anh_dai_dien'],
                ':ngay_sinh' => $data['ngay_sinh'],
                ':email' => $data['email'],
                ':so_dien_thoai' => $data['so_dien_thoai'],
                ':gioi_tinh' => $data['gioi_tinh'],
                ':dia_chi' => $data['dia_chi'],
                ':mat_khau' => $data['mat_khau'], // KHÔNG hash ở đây nữa
                ':chuc_vu_id' => $data['chuc_vu_id'] ?? 2,
                ':trang_thai' => $data['trang_thai'] ?? 1
            ]);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
