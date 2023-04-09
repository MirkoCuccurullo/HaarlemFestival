<?php

// Include autoloader
require_once __DIR__ . '/../vendor/autoload.php';
// Reference the Dompdf namespace
use Dompdf\Dompdf;
require __DIR__ . '/../repository/invoiceRepository.php';
require __DIR__ . '/../repository/orderRepository.php';
require __DIR__ . '/../service/userService.php';

class invoiceService
{
    public $invoiceRepository;
    public function __construct()
    {
        $this->invoiceRepository = new InvoiceRepository();
    }

    public function getAllInformationForInvoice(){
        return $this->invoiceRepository->getAllInformationForInvoice();
    }

    public function downloadInvoice(array $invoiceInfo)
    {
        if (!empty($_GET['downloadInvoice'])) {
            $fileName = basename($_GET['downloadInvoice']);
            //$filePath = "/HaarlemFestival/app/view/invoice/invoice_pdf/" . $fileName;
            $filePath = "destination/" . $fileName;

            if (!empty($fileName) && file_exists($filePath)) {
                header('Cache-Control: public');
                header('Content-Description: File Transfer');
                header('Content-Disposition: attachment; filename=$fileName');
                header('Content-Type: application/zip');
                header('Content-Transfer-Encoding: binary');

                readfile($filePath);
                exit;
            } else {
                echo "File does not exist";
            }
        }
    }

    public function loadHTMLToPDF($html){
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $pdf_content = $dompdf->output();
        $file_name = "invoice.pdf";
        file_put_contents($file_name, $pdf_content);
    }

    public function convertHTMLToPDF($order_id){
        $invoiceRepository = new invoiceRepository();
        $orderRepository = new orderRepository();
        $order = $orderRepository->getOrder($order_id);
        $user = $invoiceRepository->getUserByOrderId($order_id);
        $invoice = $invoiceRepository->getAllRowsUsingJoinForInvoice($order_id);

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
                        <h2>Invoice</h2><h3 class="pull-right">Order # '.$order->id.'</h3>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>Client name:</strong><br>
                                '.$user->name.'<br><br>
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Email:</strong><br>
                                '.$user->email.'<br><br>
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Invoice Date:</strong><br>
                                '.$invoice->invoiceDate.'<br><br>
                                <strong>Payment Date:</strong><br>
                                '.$invoice->paymentDate.'<br><br>
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
                                        <td><strong>Item</strong></td>
                                        <td class="text-center"><strong>Price</strong></td>
                                        <td class="text-center"><strong>Quantity</strong></td>
                                        <td class="text-right"><strong>Totals</strong></td>
                                    </tr>
                                    </thead>
                                    <tbody>                                    
                                    <tr>
                                        <td>BS-1000</td>
                                        <td class="text-center">$600.00</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">$600.00</td>
                                    </tr>
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                        <td class="thick-line text-right">
                                        '.$invoice->subTotalAmount.'
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>VAT</strong></td>
                                        <td class="no-line text-right">'.$invoice->VAT.'</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Total</strong></td>
                                        <td class="no-line text-right">'.$invoice->totalAmount.'</td>
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

        $this->loadHTMLToPDF($html);
    }

}