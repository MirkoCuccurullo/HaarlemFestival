<?php
require_once '../repository/orderRepository.php';

class orderService
{
    private $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new orderRepository();
    }

    public function createOrder($order)
    {
        return $this->orderRepository->createOrder($order);
    }

    public function updateOrderStatus($order_id, $status)
    {
        return $this->orderRepository->updateOrderStatus($order_id, $status);
    }

    public function deleteOrder($id)
    {
        return $this->orderRepository->deleteOrder($id);
    }

    public function getOrder($id)
    {
        return $this->orderRepository->getOrder($id);
    }

    public function getAllOrders($offset = NULL, $limit = NULL)
    {
        return $this->orderRepository->getAllOrders($offset, $limit);
    }
}
