<?php

use Models\order;
use repository\baseRepository;
require_once 'baseRepository.php';
require_once '../model/invoice.php';
require_once '../model/order.php';

class InvoiceRepository extends baseRepository{
    public function getInvoice($id){
        $stmt = $this->connection->prepare("SELECT * FROM invoice WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'invoice');
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getAllInformationForInvoice() {
        $stmt = $this->connection->query("SELECT * FROM invoice");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $invoices = [];
        foreach ($results as $result) {
            $invoice = new Invoice();
            $invoice->setClientName($result['name_of_client']);
            $invoice->setInvoiceNumber($result['invoice_number']);
            $invoice->setInvoiceDate($result['invoice_date']);
            $invoice->setPhoneNumber($result['phone_number']);
            $invoice->setAddress($result['address']);
            $invoice->setEmail($result['email']);
            $invoice->setSubTotalAmount($result['subtotal']);
            $invoice->setTotalAmount($result['total_amount']);
            $invoice->setVAT($result['vat']);
            $invoice->setPaymentDate($result['payment_date']);
            $invoices[] = $invoice;
        }
        $order[] = $this->getOneOrderForInvoice();
        $invoices[] = $order;
        return $invoices;
    }

    public function getOneOrderForInvoice() {
        $stmt = $this->connection->query("SELECT * FROM orders");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $orders = [];
        foreach ($results as $result) {
            $order = new Order();
            $order->setUserId($result['user_id']);
            $order->setNoOfItems($result['no_of_items']);
            $order->setTotalPrice($result['total_price']);
            $order->setStatus($result['status']);
            $orders[] = $order;
        }
        return $orders;
    }
}