<?php
require_once __DIR__ . '/../../service/orderService.php';
require_once __DIR__ . '/../../model/order.php';
class orderControllerAPI
{
    private $orderService;

    // initialize services
    function __construct()
    {
        $this->orderService = new orderService();
    }

    public function getAll()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');

        // Respond to a GET request to /api/article
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            // your code here
            $cards = $this->orderService->getAllOrders();
            header('Content-Type: application/json');
            echo json_encode($cards);
            // return all articles in the database as JSON

        }

    }

    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // your code here
            $body = file_get_contents('php://input');
            $obj = json_decode($body);
            $this->orderService->deleteOrder($obj->id);
        }
    }

    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // your code here
            $body = file_get_contents('php://input');
            $obj = json_decode($body);
            $this->orderService->createOrder($obj);
        }
    }

    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // your code here
            $body = file_get_contents('php://input');
            $obj = json_decode($body);
            $this->orderService->updateOrder($obj);
        }
    }
}