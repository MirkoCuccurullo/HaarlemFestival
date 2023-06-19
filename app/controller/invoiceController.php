<?php
require_once __DIR__ . '/../service/invoiceService.php';

class invoiceController {

    private $invoiceService;

    public function __construct(){
        $this->invoiceService = new invoiceService();
    }

    public function convertHTMLToPDF($order_id){
        $this->invoiceService->convertHTMLToPDF($order_id);
    }

}