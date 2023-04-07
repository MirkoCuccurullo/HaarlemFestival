<!doctype html>
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
<!doctype html>
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
                <h2>Invoice</h2><h3 class="pull-right">Order # <?= $order->getId()?></h3>
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
                        <a href="invoice_view.php?file=invoice.pdf" download>Download Invoice</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

