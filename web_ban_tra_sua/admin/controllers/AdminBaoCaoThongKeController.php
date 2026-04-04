<?php

class AdminBaoCaoThongKeController
{
    private function normalizeDateInput(?string $raw): ?string
    {
        $raw = trim((string)$raw);
        if ($raw === '') {
            return null;
        }

        $formats = ['Y-m-d', 'd/m/Y', 'd-n-Y', 'd-m-Y'];
        foreach ($formats as $format) {
            $dt = DateTime::createFromFormat($format, $raw);
            if ($dt && $dt->format($format) === $raw) {
                return $dt->format('Y-m-d');
            }
        }

        // thử parse chung với strtotime nếu đc
        $ts = strtotime($raw);
        if ($ts !== false) {
            return date('Y-m-d', $ts);
        }

        return null;
    }

    public function home()
    {
        $baoCao = new AdminBaoCaoThongKe();

        $mode = $_GET['mode'] ?? 'month'; // day|month|year

        $today = date('Y-m-d');
        $currentYear = (int)date('Y');
        $currentMonth = (int)date('n');

        // Chỉ tính doanh thu cho trạng thái đã thanh toán/thành công
        $trangThaiIds = [4, 9];

        // Nhập tay
        $rawFrom = $_GET['from'] ?? '';
        $rawTo = $_GET['to'] ?? '';

        $year = (int)($_GET['year'] ?? $currentYear);
        $month = (int)($_GET['month'] ?? $currentMonth);

        $fromYear = (int)($_GET['fromYear'] ?? max(2000, $currentYear - 5));
        $toYear = (int)($_GET['toYear'] ?? $currentYear);

        $fromDate = $this->normalizeDateInput($rawFrom) ?? date('Y-m-01');
        $toDate = $this->normalizeDateInput($rawTo) ?? date('Y-m-t');

        if ($mode === 'month') {
            $year = max(2000, min(9999, $year));
            $month = max(1, min(12, $month));
            $monthFirst = sprintf('%04d-%02d-01', $year, $month);
            $fromDate = date('Y-m-d', strtotime($monthFirst));
            $toDate = date('Y-m-t', strtotime($monthFirst));
        }

        if ($mode === 'day') {
            $fromDate = $this->normalizeDateInput($rawFrom) ?? date('Y-m-01');
            $toDate = $this->normalizeDateInput($rawTo) ?? date('Y-m-t');
        }

        if ($mode === 'year') {
            $fromYear = max(2000, min(9999, $fromYear));
            $toYear = max($fromYear, min(9999, $toYear));
        }

        // Data theo mode
        $doanhThuNgay = [];
        $doanhThuThang = [];
        $doanhThuNam = [];

        if ($mode === 'day') {
            $doanhThuNgay = $baoCao->doanhThuTheoNgay($fromDate, $toDate, $trangThaiIds);
        } elseif ($mode === 'year') {
            $doanhThuNam = $baoCao->doanhThuTheoNam($fromYear, $toYear, $trangThaiIds);
        } else {
            $doanhThuThang = $baoCao->doanhThuTheoThang($year, $trangThaiIds);
        }

        $topSanPham = $baoCao->thongKeSanPham($fromDate, $toDate, $trangThaiIds, 10);

        $summaryRevenue = 0;
        $summaryOrders = 0;
        $rows = $mode === 'day' ? $doanhThuNgay : ($mode === 'year' ? $doanhThuNam : $doanhThuThang);
        foreach ($rows as $r) {
            $summaryRevenue += (float)($r['doanh_thu'] ?? 0);
            $summaryOrders += (int)($r['so_don'] ?? 0);
        }

        require_once './views/home.php';
    }
}
