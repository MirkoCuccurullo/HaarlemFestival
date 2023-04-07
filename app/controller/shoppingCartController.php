<?php
require_once __DIR__ . '/../model/order.php';
require_once __DIR__ . '/../model/ticket.php';

require_once __DIR__ . '/../service/eventService.php';
require_once __DIR__ . '/../service/historyEventService.php';
require_once __DIR__ . '/../service/orderService.php';
require_once __DIR__ . '/../service/accessPassService.php';
require_once __DIR__ . '/../service/MollieService.php';
require_once __DIR__ . '/../service/PDFGenerator.php';
require_once __DIR__ . '/../service/ticketService.php';
require_once __DIR__ . '/../service/SMTPServer.php';
require_once __DIR__ . '/../service/userService.php';
require_once __DIR__ . '/../service/reservationService.php';


use router\router;

class shoppingCartController
{
    public function index()
    {
        require_once __DIR__ . '/../view/shoppingCart/index.php';
    }

    public function addDanceEvent()
    {
        if (isset($_SESSION['order']))
            $order = $_SESSION['order'];
        else {
            $order = new \Models\order();
            if (isset($_SESSION['current_user_id']))
                $order->user_id = $_SESSION['current_user_id'];
            else
                $order->user_id = null;

            $order->no_of_items = 0;
            $order->total_price = 0;
            $order->status = 'open';
        }

        if (isset($_POST['addDanceEvent'])) {

            $eventService = new EventService();
            $id = htmlspecialchars($_POST['danceEventId']);

            $event = $eventService->getEventByID($id);

            $artist = $eventService->getArtistByID($event->artist);
            $event->artist_name = $artist->name;

            $venue = $eventService->getVenueByID($event->location);
            $event->venue_name = $venue->name;

            $order->addEvent($event);
            $_SESSION['order'] = $order;
        } else if (isset($_POST['addAccessPass'])) {
            $accessPassService = new AccessPassService();
            $id = htmlspecialchars($_POST['accessPassId']);
            $accessPass = $accessPassService->getAccessPassByID($id);
            $order->addEvent($accessPass);
            $_SESSION['order'] = $order;
        }
        $router = new Router();
        $router->route('/shoppingCart');
    }

    public function addReservation($reservation): void
    {
        if (isset($_SESSION['order']))
            $order = $_SESSION['order'];
        else {
            $order = new \Models\order();
            if (isset($_SESSION['current_user_id']))
                $order->user_id = $_SESSION['current_user_id'];
            else
                $order->user_id = null;

            $order->no_of_items = 0;
            $order->total_price = 0;
            $order->status = 'open';
        }
        $event = $reservation;
        $order->addEvent($event);
        $_SESSION['order'] = $order;
        $router = new Router();
        $router->route('/shoppingCart');
    }

    public function addHistoryEvent()
    {
        if (isset($_SESSION['order']))
            $order = $_SESSION['order'];
        else {
            $order = new \Models\order();
            if (isset($_SESSION['current_user_id']))
                $order->user_id = $_SESSION['current_user_id'];
            else
                $order->user_id = null;

            $order->no_of_items = 0;
            $order->total_price = 0;
        }

        if (isset($_POST['addHistoryEvent'])) {

            $historyEventService = new HistoryEventService();
            $id = htmlspecialchars($_POST['historyEventId']);
            $event = $historyEventService->getHistoryTicketById($id);

            $order->addHistoryEvent($event);
            $_SESSION['order'] = $order;
        }
        $router = new Router();
        $router->route('/shoppingCart');
    }

    public function removeEvent()
    {
        foreach ($_SESSION['order']->events as $event)
            if ($event instanceof reservation)
            {
                $reservationService = new ReservationService();
                $reservationService->deactivateReservation($event->id);
            }
        if (isset($_POST['remove_item_key'])) {
            $key = $_POST['remove_item_key'];
            $_SESSION['order']->removeEvent($key);
        }
        $router = new Router();
        $router->route('/shoppingCart');
    }

    public function submitOrder()
    {
        if (!isset($_SESSION['current_user_id'])) {
            $router = new Router();
            $router->route('/login');
        } else {
            if (isset($_POST['submitOrder'])) {
//                $order = $_SESSION['order'];
//                $orderService = new OrderService();
//                $orderService->createOrder($order);
//                unset($_SESSION['order']);
//                $router = new Router();
//                $router->route('/');


                $order = $_SESSION['order'];

                //$payment_id = $_SESSION['payment_id'];

                $orderService = new OrderService();
                $order_id = $orderService->createOrder($order);
                $order->id = $order_id;

                $ticketService = new TicketService();
                $tickets = $ticketService->createTickets($order);

                $mollieService = new MollieService();
                $mollieService->pay($order, $tickets);

//
//                foreach ($tickets as $ticket)
//                    $ticketService->insertTicket($ticket);
//
//
//                $pdfGenerator = new PDFGenerator();
//                $pdf = $pdfGenerator->createPDF($order);
//
//                $userService = new UserService();
//                $user = $userService->getUserByID($order->user_id);
//
//                $mailService = new SMTPServer();
//
//                $receiverEmail = $user->email;
//                $receiverName = $user->name;
//                $subject = "Your Ticket(s)";
//                $message = "Hello " . $receiverName . ", thank you for your purchase! Your ticket(s) are attached to this email. See you at the events!";
//                $mailService->sendEmail($receiverEmail, $receiverName, $message, $subject, $pdf);
//                unlink($pdf);

//                $router = new Router();
//                $router->route('/');
                unset($_SESSION['order']);


            }
        }
    }

    public function confirmation($order_id)
    {
        $orderService = new orderService();
        $order = $orderService->getOrder($order_id);
        $status = $order->status;
        require_once __DIR__ . '/../view/shoppingCart/confirmation.php';
    }
}