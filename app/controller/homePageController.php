<?php
require_once __DIR__ . '/../service/homePageService.php';
require_once __DIR__ . '/../model/homePageCard.php';

class homePageController
{
    private homePageService $homePageService;

    public function __construct()
    {
        $this->homePageService = new homePageService();
    }

    public function homePage(): void
    {
        $homePage = $this->homePageService->getParagraphInfo();
        require __DIR__ . '/../view/home/index.php';
    }
}