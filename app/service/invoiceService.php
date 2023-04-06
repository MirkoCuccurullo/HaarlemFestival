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

//    public function convertHTMLToPDF(){
//        $invoiceInfo = $this->getAllInformationForInvoice();
//
//        // $html = $this->generateHTML($invoiceInfo);
//        $html = require __DIR__ . '/../view/invoice/invoice_view.php';
//
//        // (Optional) Setup the paper size and orientation
//        $dompdf = new Dompdf();
//        $dompdf->loadHtml($html);
//
//        // (Optional) Setup the paper size and orientation
//        $dompdf->setPaper('A4', 'landscape');
//
//        // Render the HTML as PDF
//        $dompdf->render();
//        $pdf_content = $dompdf->output();
//        $file_name = "invoice.pdf";
//        file_put_contents($file_name, $pdf_content);
//    }
    public function convertHTMLToPDF($order_id, $user_id){
        $dompdf = new Dompdf();

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
                        <h2>Invoice</h2><h3 class="pull-right">Order # '.$invoiceInfo[0]->invoiceNumber.'</h3>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>Client name:</strong><br>
                                '.$invoiceInfo[0]->clientName.'<br><br>
                                <strong>Address:</strong><br>
                                '.$invoiceInfo[0]->address.'<br>
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Email:</strong><br>
                                '.$invoiceInfo[0]->email.'<br><br>
                                <strong>Phone number:</strong><br>
                                '.$invoiceInfo[0]->phoneNumber.'<br>
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
        <!--                        <strong>Payment Method:</strong><br>-->
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Invoice Date:</strong><br>
                                '.$invoiceInfo[0]->getInvoiceDate().'<br><br>
                                <strong>Payment Date:</strong><br>
                                '.$invoiceInfo[0]->paymentDate.'<br><br>
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
                                        <td>BS-200</td>
                                        <td class="text-center">$10.99</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">$10.99</td>
                                    </tr>
                                    <tr>
                                        <td>BS-400</td>
                                        <td class="text-center">$20.00</td>
                                        <td class="text-center">3</td>
                                        <td class="text-right">$60.00</td>
                                    </tr>
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
                                        <td class="thick-line text-right"><?= $invoiceInfo[0]->subTotalAmount ?></td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>VAT</strong></td>
                                        <td class="no-line text-right"><?= $invoiceInfo[0]->VAT ?></td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Total</strong></td>
                                        <td class="no-line text-right"><?= $invoiceInfo[0]->totalAmount ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <a href="invoice_view.php?file=invoice.pdf" download>Download Invoice</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </body>
        </html>';
                }
        } ?>
    }
}