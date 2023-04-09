<?php
require_once '../repository/festivalPageRepository.php';
class festivalPageService
{
    private $festivalPageRepository;
    public function __construct()
    {
        $this->festivalPageRepository = new festivalPageRepository();
    }
    public function insertFestivalCard($title, $image, $content, $prompt)
    {
        return $this->festivalPageRepository->insertFestivalCard($title, $image, $content, $prompt);
    }
    public function getAllFestivalCards()
    {
        return $this->festivalPageRepository->getAllFestivalCards();
    }
    public function updateFestivalCard($id, $title, $image, $content, $prompt)
    {
        return $this->festivalPageRepository->updateFestivalCard($id, $title, $image, $content, $prompt);
    }

    public function deleteFestivalCard($id)
    {
        return $this->festivalPageRepository->deleteFestivalCard($id);
    }

}