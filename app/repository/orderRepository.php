<?php

require_once '../model/order.php';

class orderRepository extends \repository\baseRepository{
    public function createOrder($order){
        $sql = "INSERT INTO orders (user_id, no_of_items, total_price) VALUES (:user_id, :no_of_items, :total_price)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":user_id", $order->user_id);
        $stmt->bindParam(":no_of_items", $order->no_of_items);
        $stmt->bindParam(":total_price", $order->total_price);
        return $stmt->execute();
    }
    public function updateOrder($order){

    }
    public function deleteOrder($id){

    }
    public function getOrder($id){

    }
    public function getAllOrders(){

    }

}