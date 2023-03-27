<?php
require_once __DIR__ . '/../../service/orderService.php';
require_once __DIR__ . '/../../model/order.php';
require_once __DIR__ . '/controller.php';
class orderControllerAPI extends controller
{
    private $orderService;

    // initialize services
    function __construct()
    {
        $this->orderService = new orderService();
    }

    public function getAll()
    {
//        $token = $this->checkForJwt();
//        if (!$token){
//            return;
//        }

        $offset = NULL;
        $limit = NULL;

        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $appointments = $this->orderService->getAllOrders($offset, $limit);

        $this->respond($appointments);

    }

    public function getOne($id)
    {
        $token = $this->checkForJwt();
        if (!$token) {
            return;
        }
        $appointment = $this->orderService->getOrder($id);

        // we might need some kind of error checking that returns a 404 if the product is not found in the DB
        if (!$appointment) {
            $this->respondWithError(404, "Appointment not found");
            return;
        }

        $this->respond($appointment);

    }

    public function delete($id)
    {
        $token = $this->checkForJwt();
        if (!$token) {
            return;
        }
        $appointment = $this->orderService->deleteOrder($id);

        $this->respond($appointment);
    }

    public function add()
    {
//        $token = $this->checkForJwt();
//        if (!$token) {
//            return;
//        }
//        $json = file_get_contents('php://input');
//        $data = json_decode($json);
//        $order = new \Models\order();
//        $order->user_id = $data['user_id'];
//        $order->no_of_items = $data['no_of_items'];
//        $order->total_price = $data['total_price'];

        $data = $this->createObjectFromPostedJson("Models\\order");

        $appointment = $this->orderService->createOrder($order);

        $this->respond($appointment);
    }

    public function update($id)
    {
        $token = $this->checkForJwt();
        if (!$token) {
            return;
        }
        $data = $this->createObjectFromPostedJson("Models\\order");

        $appointment = $this->orderService->updateOrder($data, $id);

        $this->respond($appointment);
    }
}