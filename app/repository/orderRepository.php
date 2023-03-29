<?php

use repository\baseRepository;

require_once '../model/order.php';
include_once 'baseRepository.php';

class orderRepository extends baseRepository{
    public function createOrder($order){
        $sql = "INSERT INTO orders (user_id, no_of_items, total_price) VALUES (:user_id, :no_of_items, :total_price)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":user_id", $order->user_id);
        $stmt->bindParam(":no_of_items", $order->no_of_items);
        $stmt->bindParam(":total_price", $order->total_price);
        $stmt->execute();
        $last_id = $this->connection->lastInsertId();
        return $this->getOrder($last_id);
    }
    public function updateOrder($order){
        $sql = "UPDATE orders SET user_id = :user_id, no_of_items = :no_of_items, total_price = :total_price WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":user_id", $order->user_id);
        $stmt->bindParam(":no_of_items", $order->no_of_items);
        $stmt->bindParam(":total_price", $order->total_price);

        $stmt->bindParam(":id", $order->id);
        $stmt->execute();
        return $this->getOrder($order->id);
    }
    public function deleteOrder($id){
        $sql = "DELETE FROM orders WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        $deleted_order = $this->getOrder($id);
        $stmt->execute();
        return $deleted_order;
    }
    public function getOrder($id){
        $sql = "SELECT * FROM orders where id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\\order');
        $result = $stmt->fetchAll();
        return $result;

    }
    public function getAllOrders(){
        $sql = "SELECT * FROM orders";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\\order');
        $result = $stmt->fetchAll();
        return $result;
    }

}