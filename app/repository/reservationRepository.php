<?php

use repository\baseRepository;

require_once __DIR__ . '/../model/reservation.php';
require_once __DIR__ . '/../model/session.php';
include_once 'baseRepository.php';

class reservationRepository extends baseRepository
{
    public function getAllReservations() :array
    {
        try{
            $sql = "SELECT *  FROM reservation";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'reservation');
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to get reservations: " . $e->getMessage());
        }
        return $result;
    }

    public function updateReservation($reservation):void
    {
        try {
            // Update the reservation table
            $stmt = $this->connection->prepare("UPDATE reservation SET restaurantName = :rName, status = :status, customerName = :cName, customerEmail = :email, sessionId = :session_id, numberOfAdults = :adults, numberOfUnder12 = :under12, price = :rPrice, comment = :comment WHERE id = :id");
            $stmt->bindParam(":rName", $reservation->restaurantName);
            $stmt->bindParam(":status", $reservation->status);
            $stmt->bindParam(":cName", $reservation->customerName);
            $stmt->bindParam(":email", $reservation->customerEmail);
            $stmt->bindParam(":session_id", $reservation->sessionId);
            $stmt->bindParam(":adults", $reservation->numberOfAdults);
            $stmt->bindParam(":under12", $reservation->numberOfUnder12);
            $stmt->bindParam(":rPrice", $reservation->price);
            $stmt->bindParam(":comment", $reservation->comment);
            $stmt->bindParam(":id", $reservation->id);
            $stmt->execute();

        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to update reservation: " . $e->getMessage());
        }
    }
    public function addReservation($reservation)
    {
        try{
// Insert the reservation into the reservation table
            $stmt = $this->connection->prepare("INSERT INTO reservation (restaurantName, status, customerName, customerEmail, sessionId, numberOfAdults, numberOfUnder12, price, comment) VALUES (:rName, :status,:cName, :email, :session_id, :adults, :under12, :rPrice, :comment)");
            $stmt->bindParam(":rName", $reservation->restaurantName);
            $stmt->bindParam(":status", $reservation->status);
            $stmt->bindParam(":cName", $reservation->customerName);
            $stmt->bindParam(":email", $reservation->customerEmail);
            $stmt->bindParam(":session_id", $reservation->sessionId);
            $stmt->bindParam(":adults", $reservation->numberOfAdults);
            $stmt->bindParam(":under12", $reservation->numberOfUnder12);
            $stmt->bindParam(":rPrice", $reservation->price);
            $stmt->bindParam(":comment", $reservation->comment);
            $stmt->execute();
            //get the last ID
            $id = $this->connection->lastInsertId();
            $reservation = $this->getReservationById($id);
        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to add reservation: " . $e->getMessage());
        }
        return $reservation;
    }

    public function getReservationById(int $id)
    {
        try{
            $sql = "SELECT * FROM reservation WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'reservation');
            $result = $stmt->fetch();
            return $result;

        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to get reservation: " . $e->getMessage());
        }
    }

    public function deactivateReservation(int $id)
    {
        try{
            $sql = "UPDATE reservation SET status = 'Deactivated' WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to deactivate reservation: " . $e->getMessage());
        }
    }

    public function getReservationsBySessionId(int $sessionId) : array
    {
        try{
            $sql = "SELECT * FROM reservation WHERE sessionId = :sessionId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":sessionId", $sessionId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'reservation');
            $reservations = $stmt->fetchAll();

        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to get reservations: " . $e->getMessage());
        }
        return $reservations;

    }

    public function getSessionById(int $sessionId)
    {
        try{
            $sql = "SELECT * FROM sessionrestaurant WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $sessionId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'session');
            $result = $stmt->fetch();
            return $result;

        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to get session: " . $e->getMessage());
        }
    }
}