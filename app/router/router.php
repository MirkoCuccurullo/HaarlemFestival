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
                require_once '../view/home/index.php';
                break;
            case'/login':
                require_once("../view/login/login.php");
                break;
            case '/api/users':
                require("../api/controllers/userControllerAPI.php");
                $controller = new userControllerAPI();
                $controller->index();
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

            case'/manageProfile':
                require_once("../view/management/manageProfile.php");
                break;

            default:
                echo'404';
        }
    }
}