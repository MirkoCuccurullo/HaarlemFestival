<?php

namespace router;

use registrationController;

class router
{
    /**
     * @throws \Exception
     */
    public function route($url){

        switch ($url){
            case'/login':
                require_once("../view/login/login.php");
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