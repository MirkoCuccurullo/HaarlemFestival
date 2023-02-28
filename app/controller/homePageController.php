<?php

use router\router;


require_once __DIR__ . '/../service/homePageService.php';

class homePageController
{
    private $homePageService;

    public function __construct()
    {
        $this->homePageService = new homePageService();
    }

    public function index()
    {
        require __DIR__ . '/../view/home/index.php';
    }
}