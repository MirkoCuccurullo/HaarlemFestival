<?php

use Models\order;
use repository\baseRepository;
require_once 'baseRepository.php';
require_once '../model/invoice.php';
require_once '../model/order.php';

class InvoiceRepository extends baseRepository{

    public function getAllRowsUsingJoinForInvoice($order_id) {
        $stmt = $this->connection->prepare("SELECT  invoice.name_of_client, 
                                              invoice.invoice_number, 
                                              invoice.invoice_date, 
                                              invoice.email, 
                                              invoice.subtotal, 
                                              invoice.total_amount, 
                                              invoice.vat, 
                                              invoice.payment_date, 
                                              users.name,  
                                              orders.total_price
                 FROM invoice 
                 INNER JOIN users ON invoice.user_id = users.id 
                 INNER JOIN orders ON invoice.order_id = orders.id 
                 WHERE invoice.order_id = :order_id");
        $stmt->execute(['order_id' => $order_id]);
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'invoice');

            $invoices = [];
        if ($results) {
            foreach ($results as $result) {
                $invoice = new Invoice();
                $invoice->setClientName($result['name_of_client']);
                $invoice->setInvoiceNumber($result['invoice_number']);
                $invoice->setInvoiceDate($result['invoice_date']);
                $invoice->setEmail($result['email']);
                $invoice->setSubTotalAmount($result['subtotal']);
                $invoice->setTotalAmount($result['total_amount']);
                $invoice->setVAT($result['vat']);
                $invoice->setPaymentDate($result['payment_date']);
                $invoices[] = $invoice;
            }
        }

        $order = $this->getOrderById($order_id);
        $user = $this->getUserByOrderId($order_id);

        $invoices[] = [$order, $user];
        return $invoices;
    }

    private function getOrderById($order_id) {
        $stmt = $this->connection->prepare("SELECT * FROM orders WHERE id = :id");
        $stmt->execute(['id' => $order_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $order = new Order();
        if ($result) {
            $order->setId($result['id']);
            $order->setTotalPrice($result['total_price']);
        }
        return $order;
    }
//    public function getOrderById($id){
//        $sql = "SELECT * FROM orders where id = :id";
//        $stmt = $this->connection->prepare($sql);
//        $stmt->bindParam(":id", $id);
//        $stmt->execute();
//        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\\order');
//        $result = $stmt->fetch();
//        return $result;
//    }
    private function getUserByOrderId($order_id) {
        $user = null; // Initialize $user to null
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = (SELECT user_id FROM orders WHERE id = :id)");
        $stmt->execute(['id' => $order_id]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if ($result) {
            $user = new User();
            $user->setId($result['id']);
            $user->setName($result['name']);
        }
        return $user;
    }

    public function getInvoiceByOrderId($order_id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM invoice WHERE order_id=:order_id");
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'invoice');
        $result = $stmt->fetchAll();
        return $result;
    }

}