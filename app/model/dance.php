<?php
require_once __DIR__ . '/../service/eventService.php';
require_once __DIR__ . '/../service/ticketService.php';

class dance
{

    public int $id;
    public string $date;
    public string $price;
    public string $start_time;
    public string $end_time;
    public int $location;
    public string $artist;
    public string $artist_name = "";
    public string $venue_name = "";
    public string $session = "";
    public string $artist_picture;

    public function getVenue()
    {
        $eventService = new eventService();
        return $eventService->getVenueByID($this->location);
    }

    public function getSoldTickets()
    {
        $ticketService = new ticketService();
        return $ticketService->noOfTicketsForDanceEvent($this->id);
    }
}