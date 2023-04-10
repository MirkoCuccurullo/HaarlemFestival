<?php

require_once __DIR__ . '/../service/homePageService.php';
use router\router;


class homePageController
{
    private $homePageService;

    public function __construct()
    {
        $this->homePageService = new homePageService();
    }

    public function index()
    {
        //switch between admin and user homepage depending on the role
        if (isset($_SESSION['current_user']) && $_SESSION['current_user']->role == '3')
            require __DIR__ . '/../view/home/admin-index.php';
        else
            require __DIR__ . '/../view/home/index.php';
    }

}