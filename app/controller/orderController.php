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
}