<?php

use repository\baseRepository;
require_once 'baseRepository.php';
require_once '../model/invoice.php';

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
            $invoice = new Invoice(
                $result['name_of_client'],
                $result['invoice_number'],
                $result['invoice_date'],
                $result['phone_number'],
                $result['address'],
                $result['email'],
                $result['subtotal'],
                $result['total_amount'],
                $result['vat'],
                $result['payment_date']
            );
            $invoices[] = $invoice;
        }
        return $invoices;
    }

    public function getOneOrderForInvoice() {
        $stmt = $this->connection->query("SELECT * FROM orders");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $orders = [];
        foreach ($results as $result) {
            $order = new Order(
                $result['user_id'],
                $result['no_of_items'],
                $result['total_price'],
                $result['status']
            );
            $orders[] = $order;
        }
        return $orders;
    }
}