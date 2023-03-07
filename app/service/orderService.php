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
        $this->orderRepository->createOrder($order);
    }

    public function updateOrder($order)
    {
        $this->orderRepository->updateOrder($order);
    }

    public function deleteOrder($id)
    {
        $this->orderRepository->deleteOrder($id);
    }

    public function getOrder($id)
    {
        $this->orderRepository->getOrder($id);
    }

    public function getAllOrders()
    {
        $this->orderRepository->getAllOrders();
    }
}
