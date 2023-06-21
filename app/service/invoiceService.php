<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../repository/invoiceRepository.php';

use Dompdf\Dompdf;

class invoiceService
{
    public $invoiceRepository;

    public function __construct()
    {
        $this->invoiceRepository = new invoiceRepository();
    }

    public function loadHTMLToPDF($html, $order_id)
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'Portrait');
        $dompdf->render();
        $pdf_content = $dompdf->output();
        $file_name = "invoice_" . $order_id . ".pdf";
        // Save the PDF content to a local file
        file_put_contents($file_name, $pdf_content);
        $dompdf->stream($file_name);// when clicked, invoice will download

        return $file_name;
    }

    public function convertHTMLToPDF($order_id)
    {
        $invoiceRepository = new invoiceRepository();
        $invoice = new Invoice();

        $order = $invoiceRepository->getOrderById($order_id);
        $user = $invoiceRepository->getUserByOrderId($order_id);


        $html = '<!doctype html>
          <html lang="en">
         <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/css/invoice_view.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <title>Invoice</title>
         </head>
        <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="invoice-title">
                        <h2>Invoice</h2><h3 class="pull-right">Order # ' . $order->getId() . '</h3>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>Client name:</strong><br>
                                ' . $user->getName() . '<br><br>
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Email:</strong><br>
                                ' . $user->getEmail() . '<br><br>
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Invoice Date:</strong><br>
                                ' . $invoice->getInvoiceDate() . '<br><br>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Order summary</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr>
                                        <td class="text-center"><strong>Quantity</strong></td>
                                    </tr>
                                    </thead>
                                    <tbody>                                    
                                    <tr>
                                        <td class="text-center">' . $order->getNoOfItems() . '</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Total Price </strong></td>
                                        <td class="no-line text-right">' . '$' . $order->getTotalPrice() . '</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       </body>
        </html>';

        return $this->loadHTMLToPDF($html, $order_id);
    }
}
