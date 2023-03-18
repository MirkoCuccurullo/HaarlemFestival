<?php

namespace router;

use danceController;
use danceControllerAPI;
use festivalController;
use loginController;
use registrationController;
use userControllerAPI;

class router
{
    /**
     * @throws \Exception
     */
    public function route($url)
    {

        error_reporting(E_ALL ^ E_WARNING);

        switch ($url) {
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

                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $controller->add();
                }
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
            case '/restaurant':
            case '/festival/food':
            case '/yummy':
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
				
                case'/festival/manage-sessions':
                require_once __DIR__ . '/../controller/restaurantController.php';
                $controller = new \restaurantController();
                $controller->manageSessions();
                break;
            case 'api/sessions':
                require_once __DIR__ . '/../api/controllers/sessionControllerAPI.php';
                $controller = new \sessionsControllerAPI();
                $controller->index();
                break;
            case 'api/sessions/delete':
                require_once __DIR__ . '/../api/controllers/sessionControllerAPI.php';
                $controller = new \sessionsControllerAPI();
                $controller->delete();
                break;


            case'/food':
            case '/restaurant':
            case '/festival/food':
            case '/api/restaurant':
            case '/yummy':
                require_once __DIR__ . '/../api/controllers/restaurantControllerAPI.php';
                $controller = new \restaurantControllerAPI();
                $controller->index();
                break;
            case '/festival/manage-restaurants':
            case '/manage/restaurant':
                require_once __DIR__ . '/../controller/restaurantController.php';
                $controller = new \restaurantController();
                $controller->manageRestaurants();
                break;

            case'/festival/manage-sessions':
            case '/manage/session':
                require_once __DIR__ . '/../controller/restaurantController.php';
                $controller = new \restaurantController();
                $controller->manageSessions();
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
            default:
                echo '404';
        }
    }
}