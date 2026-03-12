<?php
class SanPham
{
    public $conn; //khai báo phương thức

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // viết hàm lấy toàn bộ danh sách sp
    public function getALLProduct()
    {
        try {
            $spl = 'SELECT * FROM san_phams';

            $stmt = $this->conn->prepare($spl);

            $stmt->execute();

            return $stmt->fetchALL();
        } catch (Exception $e) {
            echo 'Lõi' . $e->getMessage();
        }
    }
}
?>
// test pull request