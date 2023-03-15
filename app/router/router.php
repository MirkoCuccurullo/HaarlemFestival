<?php

namespace router;

use loginController;
use registrationController;
use userControllerAPI;

class router
{
    /**
     * @throws \Exception
     */
    public function route($url){

        switch ($url){
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

            case'/logout':
                require_once("../view/login/logout.php");
                break;

            case '/manage/users':
                require __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                $controller->manageAllUsers();
                break;

            case'/api/delete/user':
                require("../api/controllers/userControllerAPI.php");
                $controller = new userControllerAPI();
                $controller->delete();
                break;

            case'/edit/user':
                require __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                $controller->editUser();
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

            case'/manageProfile':
                require_once __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                $controller->manageProfile($_POST['id']);
                break;

            case'/manageProfile/update':
                require_once __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                $controller->updateProfile($_POST['id']);
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

            default:
                echo'404';
        }
    }
}