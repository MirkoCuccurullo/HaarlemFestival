<?php

namespace controller;

use router\router;

require_once __DIR__ . '/../service/MollieService.php';
require_once __DIR__ . '/../service/orderService.php';
require_once __DIR__ . '/../service/ticketService.php';
require_once __DIR__ . '/../service/PDFGenerator.php';
require_once __DIR__ . '/../service/SMTPServer.php';
require_once __DIR__ . '/../service/userService.php';
require_once __DIR__ . '/../router/router.php';


class webhookController
{
    public function webhook()
    {
        try {
            $mollieService = new \MollieService();
            $payment_id = $_POST["id"];
            $payment = $mollieService->getPayment($payment_id);
            $order_id = $payment->metadata->order_id;
            $user_id = $payment->metadata->user_id;
            $tickets = $payment->metadata->tickets;

            $orderService = new \orderService();
            $orderService->updateOrderStatus($order_id, $payment->status, $payment_id);
            if ($payment->isPaid() && ! $payment->hasRefunds() && ! $payment->hasChargebacks()) {

                $ticketService = new \ticketService();
                foreach ($tickets as $ticket)
                    $ticketService->insertTicket($ticket);


                $pdfGenerator = new \PDFGenerator();
                $pdf = $pdfGenerator->createPDF($order_id, $user_id);

                $userService = new \userService();
                $user = $userService->getUserByID($user_id);

                $mailService = new \SMTPServer();

                $receiverEmail = $user->email;
                $receiverName = $user->name;
                $subject = "Your Ticket(s)";
                $message = "Hello " . $receiverName . ", thank you for your purchase! Your ticket(s) are attached to this email. See you at the events!";
                $mailService->sendEmail($receiverEmail, $receiverName, $message, $subject, $pdf);
                unlink($pdf);
            }
        }
        catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }

    }
}