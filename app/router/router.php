<?php

namespace router;

class router
{

    public function route($url){

        switch ($url){
            case'/login':
                require_once("../view/login/login.php");
                break;
            case '/signin':
                require '../controller/loginController.php';
                $controller = new \loginController();
                $controller->login($_POST['email'], $_POST['password']);
                break;
            default:
                echo'404';
        }
    }

}