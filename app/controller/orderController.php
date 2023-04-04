<?php


require_once __DIR__ . '/../service/orderService.php';
require_once __DIR__ . '/../model/order.php';

class orderController{

    private $orderService;

    public function __construct()
    {
        $this->orderService = new orderService();
    }

    public function manageOrder(): void
    {
        require __DIR__ . '/../view/management/manageOrders.php';
    }

    public function editOrder(): void
    {
        $order = $this->orderService->getOrder($_POST['id']);
        require __DIR__ . '/../view/management/editOrder.php';
    }
    public function updateOrder(): void
    {
        $this->orderService->updateOrder($_POST['id'], $_POST['user_id'], $_POST['no_of_items'], $_POST['total_price'], $_POST['status']);
        header('Location: /manage/orders');
    }
   public function jsonToCSV(): void
    {
        $url = 'http://localhost/api/order';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $json_data = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($json_data, true);

        $csv_file = fopen('orders.csv', 'w');

// Write headers to the CSV file
        fputcsv($csv_file, array_keys($data[0]));

// Loop through the data and write each row to the CSV file
        foreach ($data as $row) {
            fputcsv($csv_file, $row);
        }

// Close the file pointer
        fclose($csv_file);

    }

}