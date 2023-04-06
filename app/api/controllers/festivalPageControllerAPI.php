<?php

require_once __DIR__ . '/../../service/festivalPageService.php';

class festivalPageControllerAPI
{
    private $festivalPageService;

    function __construct()
    {
        $this->festivalPageService = new festivalPageService();
    }

    public function getAllFestivalCards()
    {
        $cards = $this->festivalPageService->getAllFestivalCards();
        header('Content-Type: application/json');
        echo json_encode($cards);
    }

    public function createFestivalCard(){
        $data = json_decode(file_get_contents('php://input'), true);
        $heading = $data['heading'];
        $image = $data['image'];
        $paragraph = $data['paragraph'];
        $link = $data['link'];
        $this->festivalPageService->insertFestivalCard($heading, $image, $paragraph, $link);
    }

    public function updateFestivalCard()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $heading = $data['heading'];
        $image = $data['image'];
        $paragraph = $data['paragraph'];
        $link = $data['link'];
        $this->festivalPageService->updateFestivalCard($id, $heading, $image, $paragraph, $link);
    }

    public function deleteFestivalCard()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $this->festivalPageService->deleteFestivalCard($id);
    }

}