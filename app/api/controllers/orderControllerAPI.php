<?php
require_once __DIR__ . '/../../service/orderService.php';
require_once __DIR__ . '/../../model/order.php';
require_once __DIR__ . '/controller.php';
class orderControllerAPI extends controller
{
    private orderService $orderService;

    function __construct()
    {
        $this->orderService = new orderService();
    }

    public function getAll()
    {

        $offset = NULL;
        $limit = NULL;

        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $orders = $this->orderService->getAllOrders($offset, $limit);

        $this->respond($orders);

    }

    public function getOne($id)
    {
        $token = $this->checkForJwt();
        if (!$token) {
            return;
        }
        $order = $this->orderService->getOrder($id);

        if (!$order) {
            $this->respondWithError(404, "Order not found");
            return;
        }

        $this->respond($order);

    }

    public function delete($id)
    {
        $token = $this->checkForJwt();
        if (!$token) {
            return;
        }
        $order = $this->orderService->deleteOrder($id);
        $this->respond($order);
    }

    public function add()
    {

        $order = $this->createObjectFromPostedJson("Models\\order");

        $order = $this->orderService->createOrder($order);

        $this->respond($order);
    }
}