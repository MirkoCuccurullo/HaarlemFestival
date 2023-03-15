<?php

use repository\baseRepository;

require_once __DIR__ . '/../model/restaurant.php';
require_once __DIR__ . '/../model/session.php';
include_once 'baseRepository.php';
class restaurantRepository extends baseRepository
{
	
include_once 'baseRepository.php';
class restaurantRepository extends baseRepository
{
    public function getRestaurantinfo(): array
    {
        $sql = "SELECT r.Name, ep.Image, r.Cuisines, r.dietary, s.startTime, s.endTime, s.date, s.capacity, s.reservationPrice 
                              FROM restaurants r JOIN EventPhotos ep ON r.ID = ep.referenceID 
                              JOIN sessionRestaurant s ON r.restaurantId = s.restaurantId
                              WHERE ep.Type = 'Restaurant'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($name, $image, $cuisines, $dietary, $startTime, $endTime, $date, $capacity, $reservationPrice);

        $restaurants = array();
        while ($stmt->fetch()) {
            $restaurant = array("Name" => $name, "Image" => "todo" . $image, "Cuisines" => $cuisines, "Dietary" => $dietary);
            $session = array("startTime" => $startTime, "endTime" => $endTime, "date" => $date, "capacity" => $capacity, "reservationPrice" => $reservationPrice);
            $restaurant["sessions"][] = $session;
            $restaurants[] = $restaurant;
        }
        return $restaurants;

    }

    public function updateRestaurant(restaurant $restaurant)
    {
        try {
            // Update the event table
            $stmt = $this->conn->prepare("UPDATE event SET name=:name, description=:description WHERE id=:id");
            $stmt->bindParam(":name", $restaurant->name);
            $stmt->bindParam(":description", $restaurant->description);
            $stmt->bindParam(":id", $restaurant->eventId);
            $stmt->execute();

            // Update the restaurant table
            $stmt = $this->conn->prepare("UPDATE restaurant SET address=:address, cuisines=:cuisine, dietary=:dietary WHERE restaurantId=:restaurant_id");
            $stmt->bindParam(":address", $restaurant->address);
            $stmt->bindParam(":cuisine", $restaurant->cuisines);
            $stmt->bindParam(":dietary", $restaurant->dietary);
            $stmt->bindParam(":restaurant_id", $restaurant->restaurantId);
            $stmt->execute();

            // Set success flag
            $success = true;

        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to update restaurant: " . $e->getMessage());
        }

    }

    public function deleteRestaurant(restaurant $restaurant)
    {
        try {
            //delete from event table
            $stmt = $this->conn->prepare("DELETE FROM event WHERE id = :id");
            $stmt->bind_param(":id", $restaurant->eventId);
            $stmt->execute();
            $stmt->store_result();

            //delete from restaurant table
            $stmt = $this->conn->prepare("DELETE FROM restaurant WHERE restaurantId = :id");
            $stmt->bind_param(":id", $restaurant->id);
            $stmt->execute();
            $stmt->store_result();
        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to delete restaurant: " . $e->getMessage());
        }
    }

    public function addRestaurant(restaurant $restaurant)
    {
        try{

        // Insert into the event table
        $stmt = $this->conn->prepare("INSERT INTO event (name, description) VALUES (:name, :description)");
        $stmt->bindParam(":name", $restaurant->name);
        $stmt->bindParam(":description", $restaurant->description);
        $stmt->execute();

// Get the ID of the event that was just inserted
        $event_id = $this->conn->lastInsertId();

// Insert into the restaurant table
        $stmt = $this->conn->prepare("INSERT INTO restaurant (address, cuisines, dietary, restaurantId) VALUES (:address, :cuisine, :dietary, :event_id)");
        $stmt->bindParam(":address", $restaurant->address);
        $stmt->bindParam(":cuisine", $restaurant->cuisines);
        $stmt->bindParam(":dietary", $restaurant->dietary);
        $stmt->bindParam(":event_id", $event_id);
        $stmt->execute();
        $stmt->store_result();

        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to add restaurant: " . $e->getMessage());
        }

    }

    public function getSessionsByRestaurantId($id): array
    {
        $stmt = $this->connection->prepare("SELECT startTime, endTime, date, capacity, reservationPrice, sessionPrice FROM sessionRestaurant WHERE restaurantId = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'session');
        $result = $stmt->fetchAll();
        return $result;
    }
    public function updateSession(session $session)
    {
        $stmt = $this->connection->prepare("UPDATE sessionRestaurant SET startTime = :startTime, endTime = :endTime, date=:date, reservationPrice = :rPrice, sessionPrice = :sPrice, capacity = :capacity WHERE restaurantId = :id");
        $stmt->bindParam( ":startTime", $session->startTime);
        $stmt->bindParam( ":endTime", $session->endTime);
        $stmt->bindParam( ":date", $session->date);
        $stmt->bindParam( ":rPrice", $session->reservationPrice);
        $stmt->bindParam( ":sPrice", $session->sessionPrice);
        $stmt->bindParam( ":capacity", $session->capacity);
        $stmt->bindParam( ":id", $session->restaurantId);
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
        $stmt = $this->connection->prepare("INSERT INTO sessionRestaurant (restaurantId, startTime, endTime, date, reservationPrice, sessionPrice, capacity) VALUES (:id, :startTime, :endTime,:date, :reservationPrice, :sessionPrice, :capacity)");
        //restaurant id is a foreign key in the table, so it's needed to reference
        $stmt->bindParam( ":id", $session->restaurantId);
        $stmt->bindParam( ":startTime", $session->startTime);
        $stmt->bindParam( ":endTime", $session->endTime);
        $stmt->bindParam( ":date", $session->date);
        $stmt->bindParam( ":reservationPrice", $session->reservationPrice);
        $stmt->bindParam( ":sessionPrice", $session->sessionPrice);
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

    public function getSessionsByRestaurantId(int $id): array
    {
        $stmt = $this->conn->prepare("SELECT startTime, endTime, date, capacity, reservationPrice FROM sessionRestaurant WHERE restaurantId = :id");
        $stmt->bind_param(":id", $id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $startTime, $endTime, $date, $capacity, $reservationPrice);

        $sessions = array();
        while ($stmt->fetch()) {
            $session = new session($id, $startTime, $endTime, $date, $capacity, $reservationPrice);
            $sessions[] = $session;
        }
        return $sessions;
    }
    public function editSession(session $session)
    {
        $stmt = $this->conn->prepare("UPDATE sessionRestaurant SET startTime = :startTime, endTime = :endTime, reservationPrice = :price, capacity = :capacity WHERE restaurantId = :id");
        $stmt->bind_param( ":startTime", $session->startTime);
        $stmt->bind_param( ":endTime", $session->endTime);
        $stmt->bind_param( ":price", $session->reservationPrice);
        $stmt->bind_param( ":capacity", $session->capacity);
        $stmt->bind_param( ":id", $session->id);
        $stmt->execute();
        $stmt->store_result();
    }

    public function deleteSession(session $session)
    {
        $stmt = $this->conn->prepare("DELETE FROM sessionRestaurant WHERE restaurantId = :id");
        $stmt->bind_param( ":id", $session->id);
        $stmt->execute();
        $stmt->store_result();
    }

    public function addSession(session $session, int $restaurantId)
    {
        $stmt = $this->conn->prepare("INSERT INTO sessionRestaurant (restaurantId, startTime, endTime, reservationPrice, capacity) VALUES (:id, :startTime, :endTime, :price, :capacity)");
        //restaurant id is a foreign key in the table, so it's needed to reference
        $stmt->bind_param( ":id", $restaurantId);
        $stmt->bind_param( ":startTime", $session->startTime);
        $stmt->bind_param( ":endTime", $session->endTime);
        $stmt->bind_param( ":price", $session->reservationPrice);
        $stmt->bind_param( ":capacity", $session->capacity);
        $stmt->execute();
        $stmt->store_result();
    }

    public function getAllSessions()
    {
        $stmt = $this->conn->prepare("SELECT sessionId, startTime, endTime, date, capacity, reservationPrice FROM sessionRestaurant");
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $startTime, $endTime, $date, $capacity, $reservationPrice);

        $sessions = array();
        while ($stmt->fetch()) {
            $session = new session($id, $startTime, $endTime, $date, $capacity, $reservationPrice);
            $sessions[] = $session;
        }
        return $sessions;


    }

}