<?php

use repository\baseRepository;

include_once 'baseRepository.php';
class eventRepository extends baseRepository
{

    public function getAllEvent(){
        $sql = "SELECT * FROM dance_event";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, "event");
        return $result;
    }

    public function insertEvent($date, $price, $duration, $location, $artist){
        $sql = "INSERT INTO dance_event (date, price, duration, location, artist) VALUES (:date, :price, :duration, :location, :artist)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":duration", $duration);
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



}