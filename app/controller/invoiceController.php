<?php

include_once __DIR__ . '/../model/invoice.php';
require_once __DIR__ . '/../service/invoiceService.php';
//
require_once __DIR__ . '/../service/userService.php';
require_once __DIR__ . '/../service/ticketService.php';

class invoiceController {

    private $invoiceService;

    public function __construct(){
        $this->invoiceService = new invoiceService();
    }

    public function displayInvoice($order_id){
        $this->convertHTMLToPDF($order_id);
        var_dump($order_id);
//        require_once __DIR__ . '/../public/invoice.pdf';
    }

    public function convertHTMLToPDF($order_id){
        $this->invoiceService->convertHTMLToPDF($order_id);
    }

}