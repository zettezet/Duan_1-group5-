<?php

class AdminBaoCaoThongKe
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    private function buildInClauseInts(array $ids, string $prefix = 'st'): array
    {
        $ids = array_values(array_filter(array_map('intval', $ids), fn($v) => $v > 0));
        if (empty($ids)) {
            $ids = [9]; // fallback: "Thành công"
        }

        $placeholders = [];
        $params = [];
        foreach ($ids as $i => $id) {
            $key = ':' . $prefix . $i;
            $placeholders[] = $key;
            $params[$key] = $id;
        }

        return [$placeholders, $params];
    }

    public function doanhThuTheoNgay(string $fromDate, string $toDate, array $trangThaiIds = [4, 9]): array
    {
        [$in, $params] = $this->buildInClauseInts($trangThaiIds, 'st');

        $sql = 'SELECT DATE(ngay_dat) AS ngay,
                       SUM(tong_tien) AS doanh_thu,
                       COUNT(*) AS so_don
                FROM don_hangs
                WHERE DATE(ngay_dat) BETWEEN :from_date AND :to_date
                  AND trang_thai_id IN (' . implode(',', $in) . ')
                GROUP BY DATE(ngay_dat)
                ORDER BY DATE(ngay_dat)';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array_merge($params, [
            ':from_date' => $fromDate,
            ':to_date' => $toDate,
        ]));

        return $stmt->fetchAll();
    }

    public function doanhThuTheoThang(int $year, array $trangThaiIds = [4, 9]): array
    {
        [$in, $params] = $this->buildInClauseInts($trangThaiIds, 'st');

        $sql = 'SELECT MONTH(ngay_dat) AS thang,
                       SUM(tong_tien) AS doanh_thu,
                       COUNT(*) AS so_don
                FROM don_hangs
                WHERE YEAR(ngay_dat) = :y
                  AND trang_thai_id IN (' . implode(',', $in) . ')
                GROUP BY MONTH(ngay_dat)
                ORDER BY MONTH(ngay_dat)';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array_merge($params, [':y' => $year]));
        return $stmt->fetchAll();
    }

    public function doanhThuTheoNam(int $fromYear, int $toYear, array $trangThaiIds = [4, 9]): array
    {
        [$in, $params] = $this->buildInClauseInts($trangThaiIds, 'st');

        $sql = 'SELECT YEAR(ngay_dat) AS nam,
                       SUM(tong_tien) AS doanh_thu,
                       COUNT(*) AS so_don
                FROM don_hangs
                WHERE YEAR(ngay_dat) BETWEEN :from_y AND :to_y
                  AND trang_thai_id IN (' . implode(',', $in) . ')
                GROUP BY YEAR(ngay_dat)
                ORDER BY YEAR(ngay_dat)';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array_merge($params, [
            ':from_y' => $fromYear,
            ':to_y' => $toYear,
        ]));
        return $stmt->fetchAll();
    }

    public function thongKeSanPham(string $fromDate, string $toDate, array $trangThaiIds = [4, 9], int $limit = 10): array
    {
        [$in, $params] = $this->buildInClauseInts($trangThaiIds, 'st');

        $sql = 'SELECT sp.id,
                       sp.ten_san_pham,
                       SUM(ct.so_luong) AS so_luong_ban,
                       SUM(ct.thanh_tien) AS doanh_thu
                FROM chi_tiet_don_hangs ct
                INNER JOIN don_hangs dh ON ct.don_hang_id = dh.id
                INNER JOIN san_phams sp ON ct.san_pham_id = sp.id
                WHERE DATE(dh.ngay_dat) BETWEEN :from_date AND :to_date
                  AND dh.trang_thai_id IN (' . implode(',', $in) . ')
                GROUP BY sp.id, sp.ten_san_pham
                ORDER BY so_luong_ban DESC, doanh_thu DESC
                LIMIT :lim';

        $stmt = $this->conn->prepare($sql);
        foreach ($params as $k => $v) {
            $stmt->bindValue($k, (int)$v, PDO::PARAM_INT);
        }
        $stmt->bindValue(':from_date', $fromDate);
        $stmt->bindValue(':to_date', $toDate);
        $stmt->bindValue(':lim', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
