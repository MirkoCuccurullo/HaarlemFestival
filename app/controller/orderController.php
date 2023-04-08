<?php


require_once __DIR__ . '/../service/orderService.php';
require_once __DIR__ . '/../model/order.php';

class orderController
{

    private $orderService;

    public function __construct()
    {
        $this->orderService = new orderService();
    }

    public function manageOrder(): void
    {
        if(isset($_SESSION['current_user']) && $_SESSION['current_user']->role == '3')
            require __DIR__ . '/../view/management/manageOrders.php';
        else
            header('location: /home');
    }

    public function editOrder(): void
    {
        if (!isset($_POST['id'])) {
            header('Location: /home');
        }
        $order = $this->orderService->getOrder($_POST['id']);
        require __DIR__ . '/../view/management/editOrder.php';
    }

    public function updateOrder(): void
    {
        try {
            // Sanitize inputs
            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
            $no_of_items = filter_var($_POST['no_of_items'], FILTER_SANITIZE_NUMBER_INT);
            $total_price = filter_var($_POST['total_price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);

            // Validate inputs
            if (empty($id) || empty($user_id) || empty($no_of_items) || empty($total_price) || empty($status)) {
                throw new Exception("One or more required fields are missing.");
            }

            // Call the service to update the order
            $this->orderService->updateOrder($id, $user_id, $no_of_items, $total_price, $status);
            header('Location: /manage/orders');
        } catch (Exception $e) {
            // Log the error
            error_log($e->getMessage());
        }
    }
    public function deleteOrder(): void
    {
        try {
            // Sanitize inputs
            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

            // Validate inputs
            if (empty($id)) {
                throw new Exception("No order id provided");
            }

            // Call the service to delete the order
            $this->orderService->deleteOrder($id);
            header('Location: /manage/orders');
        } catch (Exception $e) {
            // Log the error
            error_log($e->getMessage());
        }
    }
}