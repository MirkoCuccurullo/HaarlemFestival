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

class router
{
    /**
     * @throws \Exception
     */
    public function route($url)
    {
        error_reporting(E_ERROR | E_PARSE);
        switch ($url) {
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

            case'/home/test':
                require_once __DIR__ . '/../controller/homePageController.php';
                $controller = new \homePageController();
                $controller->index2();
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

                if($_SERVER["REQUEST_METHOD"] == "POST"){
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
                if($_SERVER["REQUEST_METHOD"] == "GET"){
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
//                $controller->editUser();
                $controller->editUser($_POST['id']);
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

            case'/history':
                require __DIR__ . '/../controller/historyEventController.php';
                $controller = new \historyEventController();
                $controller->historyMainPage();
                break;
            case'/historyCart':
                require __DIR__ . '/../controller/historyEventController.php';
                $controller = new \historyEventController();
                $controller->historyCartPage($_POST['id']);
            break;
            case '/locationDetail':
                require __DIR__ . '/../controller/historyEventController.php';
                $controller = new \historyEventController();
                $controller->historyLocationDetailPage($_POST['id']);
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
                $controller->displayAddedContent();
                break;
            case '/historyManagement/add':
                require __DIR__ . '/../view/history/historyAdmin/addContent.php';
                break;


            case'/manageProfile':
                require_once __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                $controller->manageProfile($_SESSION['current_user_id']);
                break;

            case"/dance/artist":
                require_once __DIR__ . '/../controller/danceController.php';
                $controller = new \danceController();
                $controller->displayArtist();
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
                $controller->index();
                break;

            case'/api/homeCards/update':
                require_once __DIR__ . '/../api/controllers/homePageControllerAPI.php';
                $controller = new \homePageControllerAPI();
                $controller->updateHomePages();
                break;

            case '/shoppingCart':
                require_once __DIR__ . '/../controller/shoppingCartController.php';
                $controller = new \shoppingCartController();
                require_once __DIR__ . '/../model/dance.php';
                require_once __DIR__ . '/../model/order.php';
                require_once __DIR__ . '/../service/eventService.php';
                if (session_status() === PHP_SESSION_NONE) {
                    require_once __DIR__ . '/../../vendor/autoload.php';
                    session_start();
                }
                $controller->index();
                break;

            case '/shoppingCart/add':
                require_once __DIR__ . '/../controller/shoppingCartController.php';
                $controller = new \shoppingCartController();
                $controller->addDanceEvent();
                break;

            case '/shoppingCart/remove':
                require_once __DIR__ . '/../controller/shoppingCartController.php';
                $controller = new \shoppingCartController();
                $controller->removeDanceEvent();
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
            case '/deactivate/reservation':
                require_once __DIR__ . '/../controller/reservationController.php';
                $controller = new \reservationController();
                $controller->deactivateReservation();
                break;

            case'/api/orders?id=' . $_GET['id']:
                require("../api/controllers/orderControllerAPI.php");
                $controller = new \orderControllerAPI();
                $id = $_GET['id'];
                if($_SERVER["REQUEST_METHOD"] == "DELETE"){
                    $controller->delete($id);
                }

                if($_SERVER["REQUEST_METHOD"] == "PUT"){
                    $controller->update($id);
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
                if (isset($_POST['checkSpace'])) {
                    require_once __DIR__ . '/../controller/reservationController.php';
                    $controller = new \reservationController();
                    $controller->getAvailableSpacesPerSession();
                }
                break;
                case '/add/reservation':
                require_once __DIR__ . '/../controller/reservationController.php';
                $controller = new \reservationController();
                if (isset($_POST['addReservation'])) {
                    $controller->addReservation();
                }
                break;

                case '/api/order':
                require_once __DIR__ . '/../api/controllers/orderControllerAPI.php';
                $controller = new \orderControllerAPI();
                $controller->getAll();
                break;
                case '/manage/order':
                require_once __DIR__ . '/../controller/orderController.php';
                $controller = new orderController();
                $controller->manageOrder();
                break;
                case '/edit/order':
                require_once __DIR__ . '/../controller/orderController.php';
                $controller = new orderController();
                if (isset($_POST['editOrder'])) {
                    $controller->updateOrder();
                } else {
                    $controller->editOrder();
                }
                break;

            default:
                echo '404';
        }
    }
}