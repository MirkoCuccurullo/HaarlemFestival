<?php

namespace router;

class router
{

    public function route($url){

        switch ($url){
            case'/login':
                require_once("../view/login/login.php");
                break;
            default:
                echo'404';
        }
    }

}