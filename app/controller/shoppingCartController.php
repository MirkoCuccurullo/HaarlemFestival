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
require_once __DIR__ . '/../service/bitlyService.php';


use router\router;

class shoppingCartController
{
    public function index()
    {
        $bitlyService = new BitlyService();
        if(isset($_GET['order']) )
        {
            $encodedOrder = $_GET['order'];
            $serializedOrder = json_decode(urldecode($encodedOrder), true);
            $order = unserialize($serializedOrder);
            $_SESSION['order'] = $order;
            //echo json_encode($_SESSION['order']);
        }
        require_once __DIR__ . '/../view/shoppingCart/index.php';
    }

    public function addEvent()
    {
        if (isset($_SESSION['order'])) {
            $order = $_SESSION['order'];
        } else {
            $order = new \Models\order();
            if (isset($_SESSION['current_user_id']))
                $order->user_id = $_SESSION['current_user_id'];
            else
                $order->user_id = null;

            $order->no_of_items = 0;
            $order->total_price = 0;
            $order->status = 'open';
        }

        $event = null;
        if(isset($_POST['addDanceEvent']))
        {
            $eventService = new EventService();
            $id = htmlspecialchars($_POST['danceEventId']);
            $event = $eventService->getEventByID($id);
            $artist = $eventService->getArtistByID($event->artist);
            $event->artist_name = $artist->name;
            $venue = $eventService->getVenueByID($event->location);
            $event->venue_name = $venue->name;
        }
        else if(isset($_POST['addReservation'])) {
            //$event = $reservation;
        }
        else if(isset($_POST['addAccessPass'])) {
            $accessPassService = new AccessPassService();
            $id = htmlspecialchars($_POST['accessPassId']);
            $event = $accessPassService->getAccessPassByID($id);
        }

        $order->addEvent($event);
        $_SESSION['order'] = $order;

        header('Location: /shoppingCart');
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
        if (isset($_POST['remove_item_key'])) {
            $key = $_POST['remove_item_key'];
            $uniqueEvents = $_SESSION['order']->getUniqueEvents();
            $event = $uniqueEvents[$key];
            if($event instanceof reservation)
            {
                $reservationService = new ReservationService();
                $reservationService->deactivateReservation($event->id);
            }
            $_SESSION['order']->removeEventByType($event);
        }
        header('Location: /shoppingCart');
    }

    public function submitOrder()
    {
        if (!isset($_SESSION['current_user_id'])) {
            $router = new Router();
            $router->route('/login');
        } else {
            if (isset($_POST['submitOrder'])) {

                $order = $_SESSION['order'];

                $orderService = new OrderService();
                $order_id = $orderService->createOrder($order);
                $order->id = $order_id;

                $ticketService = new TicketService();
                $tickets = $ticketService->createTickets($order);

                $mollieService = new MollieService();
                $mollieService->pay($order, $tickets);

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

    public function changeQuantity()
    {
        if(isset($_GET['action'])) {
            $action = $_GET['action'];
            if($action == 'add') {
                $data = json_decode(file_get_contents('php://input'), true);
                $event = unserialize($data['event']);
                $_SESSION['order']->addEvent($event);
                echo json_encode($_SESSION['order']);
            } else if ($action == 'remove') {
                $data = json_decode(file_get_contents('php://input'), true);
                $event = unserialize($data['event']);
                $_SESSION['order']->removeEvent($event);
                echo json_encode($_SESSION['order']);
            }
        }
    }

}