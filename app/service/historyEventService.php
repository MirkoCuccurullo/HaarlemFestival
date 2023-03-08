<?php

require_once '../repository/ticketRepository.php';

class historyEventService{
    private $historyEventRepository;
    public function __construct(){
        $this->historyEventRepository = new historyEventRepository();
    }
    public function createHistoryEvent($historyEvent){
        return $this->historyEventRepository->createHistoryEvent($historyEvent);
    }
}