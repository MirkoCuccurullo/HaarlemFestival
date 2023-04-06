<?php

include_once __DIR__ . '/../model/invoice.php';
require_once __DIR__ . '/../service/invoiceService.php';
//
require_once __DIR__ . '/../service/userService.php';
require_once __DIR__ . '/../service/ticketService.php';

class invoiceController {

    private $invoiceService;

    public function __construct(){
        $this->invoiceService = new invoiceService();
    }

    public function displayInvoice(){
        $invoiceInfo = $this->getAllInformationForInvoice();
        include __DIR__ . '/../view/invoice/invoice_view.php';
    }

    public function getAllInformationForInvoice(){
        return $this->invoiceService->getAllInformationForInvoice();
    }

    public function downloadInvoice()
    {
        $invoiceInfo = $this->getAllInformationForInvoice();

        if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['submit'])) {
            $this->invoiceService->downloadInvoice($invoiceInfo);
        }
    }

    public function convertHTMLToPDF($order_id, $user_id){
        $this->invoiceService->convertHTMLToPDF($order_id, $user_id);
    }

//    public function exportExcel()
//    {
//        $orders = $this->orderService->getAllOrders();
//
//        // Set headers for Excel file
//        header("Content-Type: application/vnd.ms-excel");
//        header("Content-Disposition: attachment; filename=Orders_" . date("Y-m-d") . ".xls");
//
//        // Create Excel file and write column headers
//        $excelFile = fopen('php://output', 'w');
//        fputcsv($excelFile, array('ID', 'User Id', 'No of Items', 'Total Price', 'Status'), "\t");
//
//        // Loop through data and write to Excel file
//        foreach ($orders as $row) {
//            $lineData = array($row->id, $row->user_id, $row->no_of_items, $row->total_price, $row->status);
//            fputcsv($excelFile, $lineData, "\t");
//        }
//
//        // Close Excel file
//        fclose($excelFile);
//    }
//    public function exportCSV(): void
//    {
//        $result = $this->orderService->getAllOrders();
//        $delimiter = ",";
//        $filename = "Orders_" . date('Y-m-d') . ".csv";
//        // Create a file pointer
//        $f = fopen('php://memory', 'w');
//        // Set column headers
//        $fields = array('ID', 'User Id', 'No of Items', 'Total Price', 'Status');
//        fputcsv($f, $fields, $delimiter);
//        // Output each row of the data, format line as csv and write to file pointer
//        if ($result !== false) {
//            //row is a single order
//            foreach ($result as $row) {
//                $lineData = array($row->id, $row->user_id, $row->no_of_items, $row->total_price, $row->status);
//                fputcsv($f, $lineData, $delimiter);
//            }
//        }
//        // Move back to beginning of file
//        fseek($f, 0);
//        // Set headers to download file rather than displayed
//        header('Content-Type: text/csv');
//        header('Content-Disposition: attachment; filename="' . $filename . '";');
//        //output all remaining data on a file pointer
//        fpassthru($f);
//    }

}