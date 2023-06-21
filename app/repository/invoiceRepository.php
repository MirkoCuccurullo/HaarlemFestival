<?php

use Models\order;
use repository\baseRepository;

require_once 'baseRepository.php';
require_once '../model/invoice.php';
require_once '../model/order.php';
//
require_once '../repository/orderRepository.php';
require_once '../repository/userRepository.php';

class invoiceRepository extends baseRepository
{
    public function getOrderById($order_id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM orders WHERE id = :id");
        $stmt->execute(['id' => $order_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $order = new Order();
        if ($result) {
            $order->setId($result['id']);
            $order->setTotalPrice($result['total_price']);
            $order->setNoOfItems($result['no_of_items']);
        }
        return $order;
    }

    public function getUserByOrderId($order_id)
    {
        $user = null; // Initialize $user to null
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = (SELECT user_id FROM orders WHERE id = :id)");
        $stmt->execute(['id' => $order_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $user = new User();
            $user->setId($result['id']);
            $user->setName($result['name']);
            $user->setEmail($result['email']);
        }
        return $user;
    }

}