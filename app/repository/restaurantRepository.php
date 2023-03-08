<?php

use repository\baseRepository;

require_once __DIR__ . '/../model/restaurant.php';
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

    public function updateRestaurant(restaurant $restaurant)
    {
        try {
            // Update the restaurant table
            $stmt = $this->connection->prepare("UPDATE restaurant SET name=:name, description=:description, address=:address, cuisines=:cuisine, dietary=:dietary WHERE id=:id");
            $stmt->bindParam(":address", $restaurant->address);
            $stmt->bindParam(":cuisine", $restaurant->cuisines);
            $stmt->bindParam(":dietary", $restaurant->dietary);
            $stmt->bindParam(":name", $restaurant->name);
            $stmt->bindParam(":description", $restaurant->description);
            $stmt->execute();

            // Set success flag
            $success = true;

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
            $stmt = $this->connection->prepare("INSERT INTO restaurant (name, description, address, cuisines, dietary, restaurantId) VALUES (:address, :cuisine, :dietary, :event_id)");
            $stmt->bindParam(":name", $restaurant->name);
            $stmt->bindParam(":description", $restaurant->description);
            $stmt->bindParam(":address", $restaurant->address);
            $stmt->bindParam(":cuisine", $restaurant->cuisines);
            $stmt->bindParam(":dietary", $restaurant->dietary);
            $stmt->execute();
        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to add restaurant: " . $e->getMessage());
        }

    }

    public function getSessionsByRestaurantId(int $id): array
    {
        $stmt = $this->connection->prepare("SELECT startTime, endTime, capacity, reservationPrice, sessionPrice FROM sessionRestaurant WHERE restaurantId = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'session');
        $result = $stmt->fetchAll();
        return $result;
    }
    public function updateSession(session $session)
    {
        $stmt = $this->connection->prepare("UPDATE sessionRestaurant SET startTime = :startTime, endTime = :endTime, reservationPrice = :rPrice, sessionPrice = :sPrice, capacity = :capacity WHERE restaurantId = :id");
        $stmt->bindParam( ":startTime", $session->startTime);
        $stmt->bindParam( ":endTime", $session->endTime);
        $stmt->bindParam( ":rPrice", $session->reservationPrice);
        $stmt->bindParam( ":sPrice", $session->sessionPrice);
        $stmt->bindParam( ":capacity", $session->capacity);
        $stmt->bindParam( ":id", $session->id);
        $stmt->execute();
    }

    public function deleteSession(int $id)
    {
        $stmt = $this->connection->prepare("DELETE FROM sessionRestaurant WHERE sessionId = :id");
        $stmt->bindParam( ":id", $id);
        $stmt->execute();
    }

    public function addSession(session $session, int $restaurantId)
    {
        $stmt = $this->connection->prepare("INSERT INTO sessionRestaurant (restaurantId, startTime, endTime, reservationPrice, sessionPrice, capacity) VALUES (:id, :startTime, :endTime, :price, :capacity)");
        //restaurant id is a foreign key in the table, so it's needed to reference
        $stmt->bindParam( ":id", $restaurantId);
        $stmt->bindParam( ":startTime", $session->startTime);
        $stmt->bindParam( ":endTime", $session->endTime);
        $stmt->bindParam( ":price", $session->reservationPrice);
        $stmt->bindParam( ":capacity", $session->capacity);
        $stmt->execute();
    }

    public function getAllSessions(): array
    {
        $stmt = $this->connection->prepare("SELECT sessionId, startTime, endTime, capacity, reservationPrice, sessionPrice, restaurantId FROM sessionRestaurant");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'session');
        $result = $stmt->fetchAll();
        return $result;

    }

    public function getRestaurantByID(int $id)
    {
        $stmt = $this->connection->prepare("SELECT id, name, description, address, cuisines, dietary, photo  FROM restaurant WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'restaurant');
        $result = $stmt->fetch();
        foreach ($result as $restaurant) {
            $restaurant->sessions = $this->getSessionsByRestaurantId($restaurant->id);
        }
        return $result;
    }

}