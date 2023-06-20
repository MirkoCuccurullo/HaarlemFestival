<?php

namespace controller;

use Dompdf\Exception;
use router\router;

require_once __DIR__ . '/../service/MollieService.php';
require_once __DIR__ . '/../service/orderService.php';
require_once __DIR__ . '/../service/ticketService.php';
require_once __DIR__ . '/../service/reservationService.php';
require_once __DIR__ . '/../service/PDFGenerator.php';
require_once __DIR__ . '/../service/invoiceService.php';
require_once __DIR__ . '/../service/SMTPServer.php';
require_once __DIR__ . '/../service/userService.php';
require_once __DIR__ . '/../router/router.php';


class webhookController
{
    private $invoiceService;

    function __construct()
    {
        $this->invoiceService = new \invoiceService();
    }

    public function webhook()
    {
        try {
            $mollieService = new \MollieService();
            //get the payment id from the post data
            $payment_id = $_POST["id"];
            //get the payment from the mollie api and necessary data
            $payment = $mollieService->getPayment($payment_id);
            $order_id = $payment->metadata->order_id;
            $user_id = $payment->metadata->user_id;
            $tickets = $payment->metadata->tickets;

            $orderService = new \orderService();
            //update the order status and add the mollie payment id to the order
            $orderService->updateOrderStatus($order_id, $payment->status, $payment_id);

            //if the payment is paid, the order has no refunds and no chargebacks, send the tickets to the user
            if ($payment->isPaid() && ! $payment->hasRefunds() && ! $payment->hasChargebacks()) {

                $reservationService = new \reservationService();
                $ticketService = new \ticketService();
                foreach ($tickets as $ticket)
                {
                    //insert the ticket in the database
                    $ticketService->insertTicket($ticket);
                    if(isset($ticket->yummy_event_id))
                    {
                        //update the reservation status to paid
                        $reservation = $reservationService->getReservationById($ticket->yummy_event_id);
                        $reservation->status = "Paid";
                        $reservationService->updateReservation($reservation);
                    }
                }

                //create tickets pdf
                $pdfGenerator = new \PDFGenerator();
                $ticketPdf = $pdfGenerator->createPDF($order_id, $user_id);

                //create invoice pdf
                $invoiceService = new \invoiceService();
                $invoicePdf = $invoiceService->convertHTMLToPDF($order_id);

                //get user data
                $userService = new \userService();
                $user = $userService->getUserByID($user_id);

                $mailService = new \SMTPServer();

                //send email to user with tickets
                $receiverEmail = $user->email;
                $receiverName = $user->name;
                $subject = "Your Ticket(s)";
                $message = "Hello " . $receiverName . ", thank you for your purchase! Your ticket(s) and Invoice is attached to this email. See you at the events!";
                $mailService->sendEmail($receiverEmail, $receiverName, $message, $subject, $ticketPdf, $invoicePdf);
                unlink($ticketPdf);
                unlink($invoicePdf);
            }
        }
        catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
    }
}