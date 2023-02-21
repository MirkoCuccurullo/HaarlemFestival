<?php
require_once __DIR__ . '/../repository/homePageRepository.php';

class homePageService
{
    private $homePageRepo;

    public function __construct()
    {
        $this->homePageRepo = new homePageRepository();
    }

    public function getParagraphInfo()
    {
        return $this->homePageRepo->getParagraphInfo();
    }
}