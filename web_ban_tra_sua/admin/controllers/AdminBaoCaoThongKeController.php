<?php

class AdminBaoCaoThongKeController
{
    public function home()
    {
        $baoCao = new AdminBaoCaoThongKe();

        $mode = $_GET['mode'] ?? 'month'; // day|month|year

        $today = date('Y-m-d');
        $currentYear = (int)date('Y');
        $currentMonth = (int)date('n');

        // Chỉ tính doanh thu cho trạng thái đã thanh toán/thành công
        $trangThaiIds = [4, 9];

        // Default range: tháng hiện tại
        $fromDate = $_GET['from'] ?? date('Y-m-01');
        $toDate = $_GET['to'] ?? date('Y-m-t');

        $year = (int)($_GET['year'] ?? $currentYear);
        $fromYear = (int)($_GET['fromYear'] ?? max(2000, $currentYear - 5));
        $toYear = (int)($_GET['toYear'] ?? $currentYear);

        // Nếu user chọn 1 tháng cụ thể thì tự set range theo tháng đó
        $month = (int)($_GET['month'] ?? $currentMonth);
        if (isset($_GET['month']) || $mode === 'month') {
            $month = max(1, min(12, $month));
            $ym = sprintf('%04d-%02d', $year, $month);
            $fromDate = $_GET['from'] ?? ($ym . '-01');
            $toDate = $_GET['to'] ?? date('Y-m-t', strtotime($fromDate));
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
