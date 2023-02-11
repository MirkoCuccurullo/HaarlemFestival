<?php

namespace router;

class router
{

    public function route($url){

        switch ($url){
            case'/login':
                require_once("../view/login/login.php");
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