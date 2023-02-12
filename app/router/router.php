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
            case'/afterRegister':
                require_once("../view/registration/afterRegister.php");
                break;
            default:
                echo'404';
        }
    }
}