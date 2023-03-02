<?php
require_once '../repository/eventRepository.php';
class eventService
{

    private $eventRepo;
    public function __construct(){
        $this->eventRepo = new eventRepository();
    }

    public function insertEvent($date, $location, $artist, $price, $start_time, $end_time){
        return $this->eventRepo->insertEvent($date, $price, $start_time, $end_time, $location, $artist);
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

    public function getVenueByID($venue_id)
    {
        return $this->eventRepo->getVenueByID($venue_id);
    }

    public function getArtistByID($artist_id)
    {
        return $this->eventRepo->getArtistByID($artist_id);
    }


}