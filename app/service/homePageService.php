<?php

require_once '../repository/homePageRepository.php';
class homePageService{
    private $homePageRepository;
    public function __construct(){
        $this->homePageRepository = new homePageRepository();
    }
    public function insertHome($title, $image, $content, $prompt){
        return $this->homePageRepository->insertHome($title, $image, $content, $prompt);
    }

    public function getAllHome(){
        return $this->homePageRepository->getAllHome();
    }

    public function updateHomePages($id, $title, $image, $content, $prompt){
        return $this->homePageRepository->updateHomePages($id, $title, $image, $content, $prompt);
    }

    public function deleteHome($id){
        return $this->homePageRepository->deleteHome($id);
    }
}