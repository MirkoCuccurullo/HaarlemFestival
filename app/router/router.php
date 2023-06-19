<?php

namespace router;

use controller\qrController;
use controller\webhookController;
use danceController;
use danceControllerAPI;
use festivalController;
use loginController;
use orderController;
use registrationController;
use userControllerAPI;
use invoiceController;

class router
{

    /**
     * @throws \Exception
     */
    public function route($url)
    {
        error_reporting(E_ERROR | E_PARSE);
        switch ($url) {
            case '/shoppingCart?order=' . $_GET['order']:
                require_once __DIR__ . '/../controller/shoppingCartController.php';
                $controller = new \shoppingCartController();
                $controller->index();
                break;

            case '/shoppingCart/quantity?action=' . $_GET['action']:
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    require_once __DIR__ . '/../controller/shoppingCartController.php';
                    $controller = new \shoppingCartController();
                    $controller->changeQuantity();
                }
                break;

            case '/generateToken':
                require_once __DIR__ . '/../controller/festivalController.php';
                $controller = new festivalController();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->generateToken();
                } else {
                    $controller->tokenPage();
                }
                break;
            case'/qr':
                require_once __DIR__ . '/../controller/qrController.php';
                $controller = new qrController();
                $controller->index();
                break;
            case'/':
            case'/home':
                require_once __DIR__ . '/../controller/homePageController.php';
                $controller = new \homePageController();
                $controller->index();
                break;


            case'/login':
                require_once("../view/login/login.php");
                break;

            case '/api/users':
                require("../api/controllers/userControllerAPI.php");
                $controller = new userControllerAPI();
                $controller->index();
                break;

            case"/api/dance/events":
                require("../api/controllers/danceControllerAPI.php");
                $controller = new danceControllerAPI();
                $controller->index();
                break;
            case"/api/dance/artists":
                require("../api/controllers/artistControllerAPI.php");
                $controller = new \artistControllerAPI();
                $controller->index();
                break;
            case"/api/dance/venues":
                require("../api/controllers/venuesControllerAPI.php");
                $controller = new \venuesControllerAPI();
                $controller->index();
                break;
            case'/logout':
                require_once("../view/login/logout.php");
                break;

            case '/manage/users':
                require __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                $controller->manageAllUsers();
                break;
            case '/manage/dance/events':
                require __DIR__ . '/../controller/danceController.php';
                $controller = new \danceController();
                $controller->manageAllEvents();
                break;
            case '/manage/dance/artists':
                require __DIR__ . '/../controller/danceController.php';
                $controller = new \danceController();
                $controller->manageArtists();
                break;
            case '/manage/dance/venues':
                require __DIR__ . '/../controller/danceController.php';
                $controller = new \danceController();
                $controller->manageVenues();
                break;
            case'/api/orders':
                require("../api/controllers/orderControllerAPI.php");
                $controller = new \orderControllerAPI();
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    $controller->getAll();
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $controller->add();
                }
                break;


            case'/api/delete/user':
                require("../api/controllers/userControllerAPI.php");
                $controller = new userControllerAPI();
                $controller->delete();
                break;
            case'/generate/token':
                require("../api/controllers/JwtGeneratorController.php");
                $controller = new \JwtGeneratorController();
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    $controller->generateToken();
                }
                break;

            case'/api/delete/dance/event':
                require("../api/controllers/danceControllerAPI.php");
                $controller = new danceControllerAPI();
                $controller->delete();
                break;
            case'/api/delete/dance/venue':
                require("../api/controllers/venuesControllerAPI.php");
                $controller = new \venuesControllerAPI();
                $controller->delete();
                break;
            case'/api/delete/dance/artist':
                require("../api/controllers/artistControllerAPI.php");
                $controller = new \artistControllerAPI();
                $controller->delete();
                break;

            case'/edit/user':
                require __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                if (isset($_POST['id']))
                    $controller->editUser($_POST['id']);
                else
                    header("Location: /home");
                break;
            case'/edit/artist':
                require __DIR__ . '/../controller/danceController.php';
                $controller = new \danceController();
                $controller->updateArtist();
                break;
            case'/edit/venue':
                require __DIR__ . '/../controller/danceController.php';
                $controller = new \danceController();
                $controller->updateVenue();
                break;
            case'/edit/event':
                require __DIR__ . '/../controller/danceController.php';
                $controller = new \danceController();
                $controller->updateEvent();
                break;

            case'/edit/dance/artist':
                require __DIR__ . '/../controller/danceController.php';
                $controller = new \danceController();
                $controller->editArtist();
                break;
            case'/edit/dance/venue':
                require __DIR__ . '/../controller/danceController.php';
                $controller = new \danceController();
                $controller->editVenue();
                break;
            case'/edit/dance/event':
                require __DIR__ . '/../controller/danceController.php';
                $controller = new \danceController();
                $controller->editEvent();
                break;

            case '/signin':
                require '../controller/loginController.php';
                $controller = new loginController();
                $controller->login($_POST['email'], $_POST['password']);
                break;

            case'/register':
                require __DIR__ . '/../controller/registrationController.php';
                $registrationController = new registrationController();
                $registrationController->displayRegistration();
                break;

            case'/resetPassword':
                require __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                $controller->displayResetPassword();
                break;

            case'/resetPassword/reset':
                require __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                $controller->resetPassword();
                break;

            case '/resetPassword/sendLink':
                require __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                $controller->sendResetLink();
                break;

            case '/history':
                require __DIR__ . '/../controller/historyEventController.php';
                $controller = new \historyEventController();
                $controller->historyMainPage();
                break;
            case '/historyCart':
                require __DIR__ . '/../controller/historyEventController.php';
                $controller = new \historyEventController();
                $id = $_POST['id'];
                $controller->historyCartPage($id);
                break;
            case '/historyLocationDetail':
                require __DIR__ . '/../controller/historyEventController.php';
                $controller = new \historyEventController();
                $id = $_POST['id'];
                $controller->historyLocationDetailPage($id);
                break;
            case '/historyManagement':
                require __DIR__ . '/../controller/historyEventController.php';
                $controller = new \historyEventController();
                $controller->historyManagement();
                break;
            case '/historyManagement/add':
                require __DIR__ . '/../view/history/historyAdmin/addCardContent.php';
                break;
            case '/historyManagement/addScheduleContent':
                require __DIR__ . '/../view/history/historyAdmin/addScheduleContent.php';
                break;

            case'/manageProfile':
                require_once __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                if (isset($_SESSION['current_user_id']))
                    $controller->manageProfile($_SESSION['current_user_id']);
                else
                    header("Location: /home");
                break;

            case"/dance/artist?id=" . $_GET['id']:
                require_once __DIR__ . '/../controller/danceController.php';
                $controller = new \danceController();
                $controller->displayArtist($_GET['id']);
                break;

            case'/manageProfile/update':
                require_once __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                $controller->updateProfile($_SESSION['current_user_id']);
                break;
            case"/add/event":
                if (isset($_POST['addDanceEvent'])) {
                    require_once __DIR__ . '/../controller/danceController.php';
                    $controller = new \danceController();
                    $controller->addEvent();
                } else {
                    require_once __DIR__ . '/../controller/danceController.php';
                    $controller = new danceController();
                    $controller->displayFormEvent();
                }
                break;
            case"/add/artist":
                if (isset($_POST['addDanceArtist'])) {
                    require_once __DIR__ . '/../controller/danceController.php';
                    $controller = new \danceController();
                    $controller->addArtist();
                } else {
                    require_once __DIR__ . '/../controller/danceController.php';
                    $controller = new danceController();
                    $controller->displayFormArtist();
                }
                break;
            case"/add/venue":
                if (isset($_POST['addDanceVenue'])) {
                    require_once __DIR__ . '/../controller/danceController.php';
                    $controller = new \danceController();
                    $controller->addVenue();
                } else {
                    require_once __DIR__ . '/../controller/danceController.php';
                    $controller = new danceController();
                    $controller->displayFormVenue();
                }
                break;

            case'/food':
            case '/festival/yummy':
            case '/yummy':
            case '/culinary':
                require_once __DIR__ . '/../controller/restaurantController.php';
                $controller = new \restaurantController();
                $controller->displayFoodPage();
                break;

            case'/api/homeCards':
                require_once __DIR__ . '/../api/controllers/homePageControllerAPI.php';
                $controller = new \homePageControllerAPI();
                if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
                    $controller->deleteHome();

                else if ($_SERVER['REQUEST_METHOD'] == 'GET')
                    $controller->index();
                break;

            case'/api/homeCards/update':
                require_once __DIR__ . '/../api/controllers/homePageControllerAPI.php';
                $controller = new \homePageControllerAPI();
                $controller->updateHomePages();
                break;

            case '/shoppingCart?order=' . $_GET['order']:
                require_once __DIR__ . '/../controller/shoppingCartController.php';
                $controller = new \shoppingCartController();
                $controller->index();
                break;
            case '/shoppingCart':
                require_once __DIR__ . '/../controller/shoppingCartController.php';
                $controller = new \shoppingCartController();
                require_once __DIR__ . '/../model/dance.php';
                require_once __DIR__ . '/../model/order.php';
                require_once __DIR__ . '/../model/reservation.php';
                require_once __DIR__ . '/../model/historyTourTimetable.php';
                require_once __DIR__ . '/../service/eventService.php';
                if (session_status() === PHP_SESSION_NONE) {
                    require_once __DIR__ . '/../../vendor/autoload.php';
                    session_start();
                }
//                require_once __DIR__ . '/../model/dance.php';
//                require_once __DIR__ . '/../model/order.php';
//                require_once __DIR__ . '/../model/reservation.php';
//                require_once __DIR__ . '/../service/eventService.php';
//                if (session_status() === PHP_SESSION_NONE) {
//                    require_once __DIR__ . '/../../vendor/autoload.php';
//                    session_start();
//                }
                $controller->index();
                break;


            case '/shoppingCart/add':
                require_once __DIR__ . '/../controller/shoppingCartController.php';
                $controller = new \shoppingCartController();
                $controller->addEvent();
                $controller->addDanceEvent();
                $reservation = $_POST['addReservation`'];
                $controller->addReservation($reservation);
                $controller->addHistoryEvent();

                break;

            case '/shoppingCart/remove':
                require_once __DIR__ . '/../controller/shoppingCartController.php';
                $controller = new \shoppingCartController();
                $controller->removeEvent();
                break;

            case '/shoppingCart/submit':
                require_once __DIR__ . '/../controller/shoppingCartController.php';
                $controller = new \shoppingCartController();
                $controller->submitOrder();
                break;


            case'/festival':
                require_once __DIR__ . '/../controller/festivalController.php';
                $controller = new festivalController();
                $controller->homepage();
                break;

            case'/festival/dance':
                require_once __DIR__ . '/../controller/danceController.php';
                $controller = new danceController();
                $controller->homepage();
                break;


            case'/manage-session':
            case '/manage/session':
                require_once __DIR__ . '/../controller/restaurantController.php';
                $controller = new \restaurantController();
                $controller->manageSessions();
                break;

            case '/manage-restaurant':
            case '/manage/restaurant':
                require_once __DIR__ . '/../controller/restaurantController.php';
                $controller = new \restaurantController();
                $controller->manageRestaurant();
                break;

            case '/api/session':
                require_once __DIR__ . '/../api/controllers/sessionControllerAPI.php';
                $controller = new \sessionControllerAPI();
                $controller->index();
                break;
            case '/api/delete/session':
                require_once __DIR__ . '/../api/controllers/sessionControllerAPI.php';
                $controller = new \sessionControllerAPI();
                $controller->delete();
                break;
            case '/api/delete/restaurant':
                require_once __DIR__ . '/../api/controllers/restaurantControllerAPI.php';
                $controller = new \restaurantControllerAPI();
                $controller->delete();
                break;

            case '/add/restaurant':
                require_once __DIR__ . '/../controller/restaurantController.php';
                $controller = new \restaurantController();
                if (isset($_POST['addRestaurant'])) {
                    $controller->addRestaurant();
                } else {
                    $controller->displayFormRestaurant();
                }
                break;

            case '/api/restaurant':
                require_once __DIR__ . '/../api/controllers/restaurantControllerAPI.php';
                $controller = new \restaurantControllerAPI();
                $controller->index();
                break;

            case '/edit/restaurant':
                require_once __DIR__ . '/../controller/restaurantController.php';
                $controller = new \restaurantController();
                if (isset($_POST['editRestaurant'])) {
                    $controller->updateRestaurant();
                } else {
                    $controller->editRestaurant();
                }

                break;
            case '/add/session':
                require_once __DIR__ . '/../controller/restaurantController.php';
                $controller = new \restaurantController();
                if (isset($_POST['addSession'])) {
                    $controller->addSession();
                } else {
                    $controller->displayFormSession();
                }
                break;
            case '/edit/session':
                require_once __DIR__ . '/../controller/restaurantController.php';
                $controller = new \restaurantController();
                if (isset($_POST['editSession'])) {
                    $controller->updateSession();
                } else {
                    $controller->editSession();
                }
                break;
            case '/manage/reservation':
            case '/manageReservation':
            case '/manage-reservation':
                require_once __DIR__ . '/../controller/reservationController.php';
                $controller = new \reservationController();
                $controller->manageReservation();
                break;
            case '/api/reservation':
                require_once __DIR__ . '/../api/controllers/reservationControllerAPI.php';
                $controller = new \reservationControllerAPI();
                $controller->index();
                break;
            case '/edit/reservation':
                require_once __DIR__ . '/../controller/reservationController.php';
                $controller = new \reservationController();
                if (isset($_POST['editReservation'])) {
                    $controller->updateReservation();
                } else {
                    $controller->editReservation();
                }
                break;
            case '/festival/dance/manageVenues':
                require_once __DIR__ . '/../controller/danceController.php';
                $controller = new \danceController();
                $controller->addVenue();
                break;
            case '/api/dance/events?artist=' . $_GET['artist'] . '&date=' . $_GET['date'] . '&venue=' . $_GET['venue']:
                require_once __DIR__ . '/../api/controllers/danceControllerAPI.php';
                $controller = new \danceControllerAPI();
                $artist_id = $_GET['artist'];
                $date_id = $_GET['date'];
                $venue_id = $_GET['venue'];
                $controller->getAllByFilters($artist_id, $date_id, $venue_id);
                break;
            case '/deactivate/reservation':
                require_once __DIR__ . '/../controller/reservationController.php';
                $controller = new \reservationController();
                $controller->deactivateReservation();
                break;
            case '/api/dance/artists?id=' . $_GET['id']:
                require_once __DIR__ . '/../api/controllers/artistControllerAPI.php';
                $controller = new \artistControllerAPI();
                $id = $_GET['id'];
                $controller->getOne($id);
                break;
            case'/api/dance/venues?id=' . $_GET['id']:
                require_once __DIR__ . '/../api/controllers/venuesControllerAPI.php';
                $controller = new \venuesControllerAPI();
                $id = $_GET['id'];
                $controller->getOne($id);
                break;
            case'/api/orders?id=' . $_GET['id']:
                require("../api/controllers/orderControllerAPI.php");
                $controller = new \orderControllerAPI();
                $id = $_GET['id'];
                if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                    $controller->delete($id);
                }

                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    $controller->getOne($id);
                }
                break;

            case '/api/tickets/scan?id=' . $_GET['id']:
                require_once __DIR__ . '/../api/controllers/ticketControllerAPI.php';
                $controller = new \ticketControllerAPI();
                $id = $_GET['id'];
                $controller->scanTicket($id);
                break;

            case '/api/tickets/sold?id=' . $_GET['id']:
                require_once __DIR__ . '/../api/controllers/ticketControllerAPI.php';
                $controller = new \ticketControllerAPI();
                $id = $_GET['id'];
                $controller->getSoldDanceTickets($id);
                break;

            case '/webhook':
                require_once __DIR__ . '/../controller/webhookController.php';
                $controller = new webhookController();
                $controller->webhook();
                break;

            case '/shoppingCart/confirmation?order_id=' . $_GET['order_id']:
                require_once __DIR__ . '/../controller/shoppingCartController.php';
                $controller = new \shoppingCartController();
                $order_id = $_GET['order_id'];
                $controller->confirmation($order_id);
                break;

            case "/restaurant":
                require_once __DIR__ . '/../controller/restaurantController.php';
                $controller = new \restaurantController();
                $controller->displayRestaurant();
                break;

            case '/api/festivalCards':
                require_once __DIR__ . '/../api/controllers/festivalPageControllerAPI.php';
                $controller = new \festivalPageControllerAPI();
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    $controller->getAllFestivalCards();
                } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $controller->createFestivalCard();
                } else if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                    $controller->updateFestivalCard();
                } else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                    $controller->deleteFestivalCard();
                }
                break;

            case '/add/reservation':
                require_once __DIR__ . '/../controller/reservationController.php';
                $controller = new \reservationController();
                if (isset($_POST['addReservation'])) {
                    $reservation = $controller->addReservation();
                    require_once __DIR__ . '/../controller/shoppingCartController.php';
                    $shoppingController = new \shoppingCartController();
                    $shoppingController->addReservation($reservation);
                    //var_dump($reservation);
                }
                break;

            case '/api/order':
                require_once __DIR__ . '/../api/controllers/orderControllerAPI.php';
                $controller = new \orderControllerAPI();
                $controller->getAll();
                break;
            case '/manage/order':
            case '/manage/orders':
                require_once __DIR__ . '/../controller/orderController.php';
                $controller = new orderController();
                $controller->manageOrder();
                break;
            case 'edit/order':
            case '/edit/order':
                require_once __DIR__ . '/../controller/orderController.php';
                $controller = new orderController();
                if (isset($_POST['editOrder'])) {
                    $controller->updateOrder();
                } else {
                    $controller->editOrder();
                }
                break;
            case '/delete/order':
                require_once __DIR__ . '/../controller/orderController.php';
                $controller = new \orderController();
                $controller->deleteOrder();
                break;
            case '/saveInCSV':
                require_once __DIR__ . '/../controller/CVSController.php';
                $controller = new \CSVController();
                $controller->exportCSV();
                break;
            case '/saveInExcel':
                require_once __DIR__ . '/../controller/ExcelController.php';
                $controller = new \ExcelController();
                $controller->exportExcel();
                break;
            case '/saveInPDF':
                require __DIR__ . '/../controller/invoiceController.php';
                $invoiceController = new invoiceController();
                $invoiceController->convertHTMLToPDF($_POST['id']);
                break;
            default:
                if (isset($_GET['order'])) {
                    require_once __DIR__ . '/../controller/shoppingCartController.php';
                    $controller = new \shoppingCartController();
                    $controller->index();
                    break;
                } else
                    http_response_code(404);
//            case '/saveInPDF':
//               require __DIR__ . '/../controller/invoiceController.php';
//               $invoiceController = new invoiceController();
//               $invoiceController->convertHTMLToPDF(97); //TODO: HArdcoded
//               break;
        }
    }
}