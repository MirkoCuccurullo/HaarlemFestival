<?php

use Models\order;

require_once '../repository/orderRepository.php';

class orderService
{
    private orderRepository $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new orderRepository();
    }

    public function createOrder($order)
    {
        return $this->orderRepository->createOrder($order);
    }

    public function updateOrder($id, $user_id, $no_of_items, $total_price, $dance_events)
    {
        $order = new order();
        $order->id = $id;
        $order->user_id = $user_id;
        $order->no_of_items = $no_of_items;
        $order->total_price = $total_price;
        $order->dance_events = $dance_events;

        return $this->orderRepository->updateOrder($order);
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
