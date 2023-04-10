<?php

namespace controller;
use router\router;

class qrController
{
    public function index()
    {
        //only employees allowed to access this page
        if(isset($_SESSION['current_user']) && $_SESSION['current_user']->role == '2')
            require_once __DIR__ . '/../view/festival/qr_checker.php';
        else
        {
            $router = new router();
            $router->route('/');
        }
    }
}