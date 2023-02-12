<?php

namespace router;

class router
{

    public function route($url){

        switch ($url){

            case '/login':
                require __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                $controller->login();
                break;

            case '/management/manageProfile':
                require __DIR__ . '/../controller/userController.php';
                $controller = new \userController();
                $controller->manageProfile();
                break;

            case'/resetPassword':
                require_once("../view/resetPassword/resetPassword.php");
                break;


            default:
                http_response_code(404);
                break;
        }
    }
}