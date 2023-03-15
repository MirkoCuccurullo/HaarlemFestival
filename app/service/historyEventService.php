<?php

require_once '../repository/historyEventRepository.php';

class historyEventService{
    private $historyEventRepository;
    public function __construct(){
        $this->historyEventRepository = new historyEventRepository();
    }

    public function getAllHistoryCard() {
        return $this->historyEventRepository->getAllHistoryCard();
    }

    public function getHistoryPageContent() {
        return $this->historyEventRepository->getHistoryPageContent();
    }

    public function getHistoryTourTimetable() {
        return $this->historyEventRepository->getHistoryTourTimetable();
    }

    public function getHistoryTicketById($id){
        return $this->historyEventRepository->getHistoryTicketById($id);
    }

    public function getLocationDetailById($id)
    {
        return $this->historyEventRepository->getLocationDetailById($id);
    }

}