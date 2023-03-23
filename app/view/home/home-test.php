<?php
include __DIR__ . '/../../service/MollieService.php';

$mollieService = new MollieService();
$payments = $mollieService->getAllPayments();
foreach ($payments as $payment) {
    echo "Payment " . htmlspecialchars($payment->description) . " is " . htmlspecialchars($payment->status) . ".<br>";
}