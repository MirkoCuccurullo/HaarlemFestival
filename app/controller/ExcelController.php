<?php
require_once __DIR__ . '/../service/orderService.php';
require_once __DIR__ . '/../model/order.php';


class ExcelController
{
    private orderService $orderService;

    public function __construct()
    {
        $this->orderService = new OrderService();
    }

    public function exportExcel()
    {
        $orders = $this->orderService->getAllOrders();

        // Set headers for Excel file
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Orders_" . date("Y-m-d") . ".xls");

        // Create Excel file and write column headers
        $excelFile = fopen('php://output', 'w');
        fputcsv($excelFile, array('ID', 'User Id', 'No of Items', 'Total Price', 'Status'), "\t");

        // Loop through data and write to Excel file
        foreach ($orders as $row) {
            $lineData = array($row->id, $row->user_id, $row->no_of_items, $row->total_price, $row->status);
        fputcsv($excelFile, $lineData, "\t");
        }

        // Close Excel file
        fclose($excelFile);
    }


}