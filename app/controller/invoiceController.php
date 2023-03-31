<?php

include_once __DIR__ . '/../model/invoice.php';
require_once __DIR__ . '/../service/invoiceService.php';

class invoiceController {

    private $invoiceService;

    public function __construct(){
        $this->invoiceService = new invoiceService();
    }

    public function displayInvoiceHTML(){
        include __DIR__ . '/../view/invoice/invoice_view.php';

    }

}