<?php
require_once __DIR__ . '/../service/orderService.php';
require_once __DIR__ . '/../model/order.php';
 class CSVController
 {
     private orderService $orderService;

     public function __construct()
     {
         $this->orderService = new OrderService();
     }

     public function exportCSV(): void
     {

         $result = $this->orderService->getAllOrders();

         $delimiter = ",";
         $filename = "Orders_" . date('Y-m-d') . ".csv";

         // Create a file pointer
         $f = fopen('php://memory', 'w');

         // Set column headers
         $fields = array('ID', 'User Id', 'No of Items', 'Total Price', 'Status');
         fputcsv($f, $fields, $delimiter);

         // Output each row of the data, format line as csv and write to file pointer
         if ($result !== false) {
             //row is a single order
             foreach ($result as $row) {
                 $lineData = array($row->id, $row->user_id, $row->no_of_items, $row->total_price, $row->status);
                     fputcsv($f, $lineData, $delimiter);
             }
         }

         // Move back to beginning of file
         fseek($f, 0);

         // Set headers to download file rather than displayed
         header('Content-Type: text/csv');
         header('Content-Disposition: attachment; filename="' . $filename . '";');


         //output all remaining data on a file pointer
         fpassthru($f);
     }
 }