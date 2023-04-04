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

    public function deleteEvent($id)
    {
        return $this->eventRepo->deleteEvent($id);
    }

    public function deleteArtist($id)
    {
        return $this->eventRepo->deleteArtist($id);
    }

    public function deleteVenue($id)
    {
        return $this->eventRepo->deleteVenue($id);
    }

    public function updateArtist(mixed $id, mixed $name, mixed $genre, mixed $description)
    {
        return $this->eventRepo->updateArtist($id, $name, $genre, $description);
    }

    public function updateVenue(mixed $id, mixed $name, mixed $address, mixed $description, mixed $capacity)
    {
        return $this->eventRepo->updateVenue($id, $name, $address, $description, $capacity);
    }

    public function getEventByID(mixed $id)
    {
        return $this->eventRepo->getEventByID($id);
    }

    public function updateEvent(mixed $id, mixed $date, mixed $location, mixed $artist, mixed $price, mixed $start_time, mixed $end_time)
    {
        return $this->eventRepo->updateEvent($id, $date, $location, $artist, $price, $start_time, $end_time);
    }

    public function insertArtist(mixed $name, mixed $genre, mixed $description, mixed $picture, $spotify)
    {
        return $this->eventRepo->insertArtist($name, $genre, $description, $picture, $spotify);
    }

    public function insertVenue(mixed $name, mixed $address, mixed $description, mixed $capacity, mixed $picture)
    {
        return $this->eventRepo->insertVenue($name, $address, $description, $capacity, $picture);
    }

    public function getEventsByArtist(int $id)
    {
        return $this->eventRepo->getEventsByArtist($id);
    }

    public function getReservationByID(string $id)
    {
        $service = new reservationService();
        return $service->getReservationByID($id);

    public function getAllByFilters(mixed $artist_id, mixed $date_id, mixed $venue_id)
    {
        return $this->eventRepo->getAllByFilters($artist_id, $date_id, $venue_id);

    }


}