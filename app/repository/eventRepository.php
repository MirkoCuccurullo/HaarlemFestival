<?php

use repository\baseRepository;

include_once 'baseRepository.php';
require_once __DIR__ . '/../model/artist.php';
require_once __DIR__ . '/../model/dance.php';
require_once __DIR__ . '/../model/venues.php';

class eventRepository extends baseRepository
{

    public function getAllEvents(){
        $sql = "SELECT * FROM dance_event";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'dance');
        $result = $stmt->fetchAll();
        foreach ($result as $dance){

            $artist = $this->getArtistById($dance->artist);

            $dance->artist_name = $artist->name;
            $venue_name = $this->getVenueById($dance->location)->name;
            $dance->venue_name = $venue_name;
        }
        return $result;
    }

    public function insertEvent($date, $price, $start_time, $end_time, $location, $artist){
        $sql = "INSERT INTO dance_event (date, price, start_time, end_time, location, artist) VALUES (:date, :price, :start_time, :end_time, :location, :artist)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":start_time", $start_time);
        $stmt->bindParam(":end_time", $end_time);
        $stmt->bindParam(":location", $location);
        $stmt->bindParam(":artist", $artist);
        return $stmt->execute();
    }

    public function getVenues(){
        $sql = "SELECT * FROM venues";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, "venues");
        return $result;
    }

    public function getArtists(){
        $sql = "SELECT * FROM dance_artists";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, "artist");
        return $result;
    }

    public function getVenueByID($venue_id)
    {
        $sql = "SELECT * FROM venues WHERE id = :venue_id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":venue_id", $venue_id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "venues");
        $result = $stmt->fetch();
        return $result;
    }

    public function getArtistByID($artist_id)
    {
        $sql = "SELECT * FROM dance_artists WHERE id = :artist_id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":artist_id", $artist_id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "artist");
        $result = $stmt->fetch();
        return $result;
    }

    public function deleteEvent($id)
    {
        $sql = "DELETE FROM dance_event WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteArtist($id)
    {
        $sql = "DELETE FROM dance_artists WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteVenue($id)
    {
        $sql = "DELETE FROM venues WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


}