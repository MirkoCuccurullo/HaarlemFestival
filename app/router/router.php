<?php

namespace router;

use loginController;
use registrationController;

class router
{
    /**
     * @throws \Exception
     */
    public function route($url){

        switch ($url){
            case'/':

            case'/home':
                require_once '../view/home/index.php';
                break;

            case'/login':
                require_once("../view/login/login.php");
                break;

            case'/logout':
                require_once("../view/login/logout.php");
                break;

            case '/signin':
                require '../controller/loginController.php';
                $controller = new loginController();
                $controller->login($_POST['email'], $_POST['password']);
                break;

            case'/register':
                require __DIR__ . '/../controller/registrationController.php';
                $data = $_POST;
                $registrationController = new registrationController();
                $registrationController->displayRegistrationPage($data);
                break;

            case'/resetPassword':
                require_once("../view/resetPassword/resetPassword.php");
                break;

            case '/resetPassword/sendLink':
                require __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                $controller->sendResetLink();
                break;


            case'/manageProfile':
                require __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                $controller->manageProfile();
                break;

            case'/manageProfile/update':
                require __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                $controller->updateProfile();
                break;

            default:
                echo'404';
        }
    }
}