<?php

include_once __DIR__ . '/../model/invoice.php';
require_once __DIR__ . '/../service/invoiceService.php';

class invoiceController {

    private $invoiceService;

    public function __construct(){
        $this->invoiceService = new invoiceService();
    }

    public function displayInvoiceHTML(){
        $invoiceInfo = $this->getAllInformationForInvoice();
        include __DIR__ . '/../view/invoice/invoice_view.php';
    }

    public function getAllInformationForInvoice(){
        return $this->invoiceService->getAllInformationForInvoice();
    }

}