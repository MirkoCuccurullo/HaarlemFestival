<?php
require_once '../repository/eventRepository.php';
class eventService
{

    private $eventRepo;
    public function __construct(){
        $this->eventRepo = new eventRepository();
    }

    public function insertEvent($date, $location, $artist, $price, $duration){
        return $this->eventRepo->insertEvent($date, $price, $duration, $location, $artist);
    }

    public function getAllEvents(){
        return $this->eventRepo->getAllEvents();
    }

    public function getVenues(){
        return $this->eventRepo->getVenues();
    }

    public function getArtists(){
        return $this->eventRepo->getArtists();
    }


}