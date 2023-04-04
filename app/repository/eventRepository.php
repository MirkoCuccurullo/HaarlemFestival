<?php

use repository\baseRepository;

include_once 'baseRepository.php';
require_once __DIR__ . '/../model/artist.php';
require_once __DIR__ . '/../model/dance.php';
require_once __DIR__ . '/../model/venues.php';

class eventRepository extends baseRepository
{

    public function getAllEvents(){
        $sql = "SELECT de.*, a.name as artist_name, a.picture as artist_picture, v.name as venue_name FROM dance_event as de join dance_artists as a on de.artist = a.id join venues as v on de.location = v.id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'dance');
        $result = $stmt->fetchAll();
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

    public function updateArtist(mixed $id, mixed $name, mixed $genre, mixed $description)
    {
        $sql = "UPDATE dance_artists SET name = :name, genre = :genre, description = :description WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":genre", $genre);
        $stmt->bindParam(":description", $description);
        return $stmt->execute();
    }

    public function updateVenue(mixed $id, mixed $name, mixed $address, mixed $description, mixed $capacity)
    {
        $sql = "UPDATE venues SET name = :name, address = :address, description = :description, capacity = :capacity WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":capacity", $capacity);
        return $stmt->execute();
    }

    public function getEventByID(mixed $id)
    {
        $sql = "SELECT * FROM dance_event WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "dance");
        $result = $stmt->fetch();
        return $result;
    }

    public function updateEvent(mixed $id, mixed $date, mixed $location, mixed $artist, mixed $price, mixed $start_time, mixed $end_time)
    {
        $sql = "UPDATE dance_event SET date = :date, location = :location, artist = :artist, price = :price, start_time = :start_time, end_time = :end_time WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":location", $location);
        $stmt->bindParam(":artist", $artist);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":start_time", $start_time);
        $stmt->bindParam(":end_time", $end_time);
        return $stmt->execute();
    }

    public function insertArtist(mixed $name, mixed $genre, mixed $description, mixed $picture, mixed $spotify)
    {
        $sql = "INSERT INTO dance_artists (name, genre, description, picture, spotify) VALUES (:name, :genre, :description, :picture, :spotify)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":genre", $genre);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":picture", $picture);
        $stmt->bindParam(":spotify", $spotify);
        return $stmt->execute();
    }

    public function insertVenue(mixed $name, mixed $address, mixed $description, mixed $capacity, mixed $picture)
    {
        $sql = "INSERT INTO venues (name, address, description, capacity, picture) VALUES (:name, :address, :description, :capacity, :picture)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":capacity", $capacity);
        $stmt->bindParam(":picture", $picture);
        return $stmt->execute();
    }

    public function getEventsByArtist(int $id)
    {
        $sql = "SELECT de.*, a.name as artist_name, a.picture as artist_picture, v.name as vanue_name FROM dance_event as de join dance_artists as a on de.artist = a.id join venues as v on de.location = v.id WHERE artist = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, "dance");
        return $result;
    }

    public function getAllByFilters(mixed $artist_id, mixed $date_id, mixed $venue_id)
    {
        if ($artist_id != 0 && $venue_id != 0){
            $sql = "SELECT de.*, a.name as artist_name, a.picture as artist_picture, v.name as venue_name FROM dance_event as de join dance_artists as a on de.artist = a.id join venues as v on de.location = v.id WHERE artist = :artist_id AND location = :venue_id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":artist_id", $artist_id);
            $stmt->bindParam(":venue_id", $venue_id);

        }

        if ($artist_id == 0){
            $sql = "SELECT de.*, a.name as artist_name, a.picture as artist_picture, v.name as venue_name FROM dance_event as de join dance_artists as a on de.artist = a.id join venues as v on de.location = v.id WHERE location = :venue_id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":venue_id", $venue_id);
        }

        if ($venue_id == 0){
            $sql = "SELECT de.*, a.name as artist_name, a.picture as artist_picture, v.name as venue_name FROM dance_event as de join dance_artists as a on de.artist = a.id join venues as v on de.location = v.id WHERE artist = :artist_id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":artist_id", $artist_id);
        }

        if ($artist_id == 0 && $venue_id == 0){
            $sql = "SELECT de.*, a.name as artist_name, a.picture as artist_picture, v.name as venue_name FROM dance_event as de join dance_artists as a on de.artist = a.id join venues as v on de.location = v.id";
            $stmt = $this->connection->prepare($sql);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, "dance");
        return $result;

    }


}