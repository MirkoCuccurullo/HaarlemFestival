<?php

use repository\baseRepository;

require_once __DIR__ . '/../model/restaurant.php';
require_once __DIR__ . '/../model/session.php';
include_once 'baseRepository.php';
class restaurantRepository extends baseRepository
{
    public function getRestaurantInfo(): array
    {
        $sql = "SELECT id, name, description, address, cuisines, dietary, photo  FROM restaurant";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'restaurant');
        $result = $stmt->fetchAll();

        foreach ($result as $restaurant) {
            $restaurant->sessions = $this->getSessionsByRestaurantId($restaurant->id);
        }
        return $result;


    }

    public function updateRestaurant($restaurant)
    {
        try {
            // Update the restaurant table
            $stmt = $this->connection->prepare("UPDATE restaurant SET name = :name, description = :description, address = :address, cuisines = :cuisine, dietary = :dietary, photo = :photo WHERE id = :id");
             $stmt->bindParam(":address", $restaurant->address);
            $stmt->bindParam(":cuisine", $restaurant->cuisines);
            $stmt->bindParam(":dietary", $restaurant->dietary);
            $stmt->bindParam(":name", $restaurant->name);
            $stmt->bindParam(":description", $restaurant->description);
            $stmt->bindParam(":photo", $restaurant->photo);
            $stmt->bindParam(":id", $restaurant->id);
            $stmt->execute();

        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to update restaurant: " . $e->getMessage());
        }

    }

    public function deleteRestaurant(int $id)
    {
        try {
            //delete from restaurant table
            $stmt = $this->connection->prepare("DELETE FROM restaurant WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to delete restaurant: " . $e->getMessage());
        }
    }

    public function addRestaurant(restaurant $restaurant)
    {
        try{
            $stmt = $this->connection->prepare("INSERT INTO restaurant (name, description, address, cuisines, dietary, photo) VALUES (:name, :description, :address, :cuisine, :dietary, :photo)");
            $stmt->bindParam(":name", $restaurant->name);
            $stmt->bindParam(":description", $restaurant->description);
            $stmt->bindParam(":address", $restaurant->address);
            $stmt->bindParam(":cuisine", $restaurant->cuisines);
            $stmt->bindParam(":dietary", $restaurant->dietary);
            $stmt->bindParam(":photo", $restaurant->photo);
            $stmt->execute();
        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to add restaurant: " . $e->getMessage());
        }

    }

    public function getSessionsByRestaurantId($id): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM sessionRestaurant WHERE restaurantId = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'session');
        $result = $stmt->fetchAll();
        return $result;
    }
    public function updateSession(session $session)
    {
        $stmt = $this->connection->prepare("UPDATE sessionRestaurant SET startTime = :startTime, endTime = :endTime, date=:date, reservationPrice = :rPrice, sessionPrice = :sPrice, reducedPrice= :reducedPrice, capacity = :capacity, restaurantId= :restaurantId WHERE id = :id");
        $stmt->bindParam( ":id", $session->id);
        $stmt->bindParam( ":startTime", $session->startTime);
        $stmt->bindParam( ":endTime", $session->endTime);
        $stmt->bindParam( ":date", $session->date);
        $stmt->bindParam( ":rPrice", $session->reservationPrice);
        $stmt->bindParam( ":sPrice", $session->sessionPrice);
        $stmt->bindParam( ":reducedPrice", $session->reducedPrice);
        $stmt->bindParam( ":capacity", $session->capacity);
        $stmt->bindParam( ":restaurantId", $session->restaurantId);
        $stmt->execute();
    }

    public function deleteSession(int $id)
    {
        try {
            //delete from restaurant table
            $stmt = $this->connection->prepare("DELETE FROM sessionRestaurant WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to delete session: " . $e->getMessage());
        }
    }

    public function addSession(session $session)
    {
        $stmt = $this->connection->prepare("INSERT INTO sessionRestaurant (restaurantId, startTime, endTime, date, reservationPrice, sessionPrice, reducedPrice, capacity) VALUES (:id, :startTime, :endTime,:date, :reservationPrice, :sessionPrice,:reducedPrice, :capacity)");
        //restaurant id is a foreign key in the table, so it's needed to reference
        $stmt->bindParam( ":id", $session->restaurantId);
        $stmt->bindParam( ":startTime", $session->startTime);
        $stmt->bindParam( ":endTime", $session->endTime);
        $stmt->bindParam( ":date", $session->date);
        $stmt->bindParam( ":reservationPrice", $session->reservationPrice);
        $stmt->bindParam( ":sessionPrice", $session->sessionPrice);
        $stmt->bindParam( ":reducedPrice", $session->reducedPrice);
        $stmt->bindParam( ":capacity", $session->capacity);
        $stmt->execute();
    }

    public function getAllSessions(): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM sessionRestaurant");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'session');
        $result = $stmt->fetchAll();
        return $result;

    }

    public function getRestaurantByID($id)
    {
        $stmt = $this->connection->prepare("SELECT id, name, description, address, cuisines, dietary, photo  FROM restaurant WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'restaurant');
        $result = $stmt->fetch();
        return $result;
    }

    public function getSessionById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM sessionRestaurant WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'session');
        $result = $stmt->fetch();
        return $result;
    }

}