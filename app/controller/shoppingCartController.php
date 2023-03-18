<?php
require_once __DIR__ . '/../model/order.php';
require_once __DIR__ . '/../service/eventService.php';
require_once __DIR__ . '/../service/orderService.php';

use router\router;


class shoppingCartController
{
    public function index()
    {
//        if (isset($_POST['addDanceEvent'])) {
//
//            $eventService = new EventService();
//            $events = $eventService->getAllEvents();
//
//            if (isset($_SESSION['order']))
//                $order = $_SESSION['order'];
//            else
//            {
//                $order = new Order();
//                $order->user_id = $_SESSION['current_user_id'];
//                $order->no_of_items = 0;
//                $order->total_price = 0;
//            }
//
//            foreach ($events as $event) {
//                $order->addDanceEvent($event);
//            }
//
//            $_SESSION['order'] = $order;
//        } else if (isset($_POST['remove_item_key'])) {
//            $key = $_POST['remove_item_key'];
//            $_SESSION['order']->removeDanceEvent($key);
//        }
//        else if (isset($_POST['submitOrder'])) {
//            $order = $_SESSION['order'];
//            $orderService = new OrderService();
//            $orderService->createOrder($order);
//            unset($_SESSION['order']);
//            $router = new Router();
//            $router->route('/home');
//        }
        require_once __DIR__ . '/../view/shoppingCart/index.php';
    }

    public function addDanceEvent()
    {
        if (isset($_POST['addDanceEvent'])) {

            $eventService = new EventService();
            $id = htmlspecialchars($_POST['danceEventId']);
            $event = $eventService->getEventByID($id);

            if (isset($_SESSION['order']))
                $order = $_SESSION['order'];
            else
            {
                $order = new \Models\order();
                $order->user_id = $_SESSION['current_user_id'];
                $order->no_of_items = 0;
                $order->total_price = 0;
            }

            $artist = $eventService->getArtistByID($event->artist);
            $event->artist_name = $artist->name;

            $venue = $eventService->getVenueByID($event->location);
            $event->venue_name = $venue->name;

            $order->addDanceEvent($event);
            $_SESSION['order'] = $order;
        }
        $router = new Router();
        $router->route('/shoppingCart');
    }

    public function removeDanceEvent()
    {
        if (isset($_POST['remove_item_key'])) {
            $key = $_POST['remove_item_key'];
            $_SESSION['order']->removeDanceEvent($key);
        }
        $router = new Router();
        $router->route('/shoppingCart');
    }
}