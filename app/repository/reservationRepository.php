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

            foreach ($result as $reservation) {
                $reservation->session = $this->getSessionById($reservation->sessionId);
            }

            return $result;
        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to get reservations: " . $e->getMessage());
        }
    }

    public function updateReservation($reservation):void
    {
        try {
            // Update the reservation table
            $stmt = $this->connection->prepare("UPDATE reservation SET restaurantName=rName, status=:status, customerEmail=:email, sessionId=:session_id, numberOfAdults=:adults, numberOfUnder12=:under12, reservationPrice=:rPrice, comment=:comment WHERE id=:id");
            $stmt->bindParam(":id", $reservation->id);
            $stmt->bindParam(":rName", $reservation->restaurantName);
            $stmt->bindParam(":email", $reservation->customerEmail);
            $stmt->bindParam(":status", $reservation->status);
            $stmt->bindParam(":session_id", $reservation->session->id);
            $stmt->bindParam(":adults", $reservation->numberOfAdults);
            $stmt->bindParam(":under12", $reservation->numberOfUnder12);
            $stmt->bindParam(":rPrice", $reservation->reservationPrice);
            $stmt->bindParam(":comment", $reservation->comment);
            $stmt->execute();

        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to update reservation: " . $e->getMessage());
        }
    }
    public function addReservation():void
    {
        try{
            $sql = "INSERT INTO reservation (restaurantName, sessionId, status, numberOfAdults, numberOfUnder12, reservationPrice, customerEmail, comment) VALUES (:rName, :session_id, :status, :adults, :under12, :rPrice, :email, :comment)";
        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to add reservation: " . $e->getMessage());
        }
    }
    private function getSessionByID($id):array
    {
        try{
            $sql = "SELECT * FROM session WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'session');
            $result = $stmt->fetchAll();
            return $result;

        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to get session: " . $e->getMessage());
        }
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
            $result->session = $this->getSessionById($result->sessionId);
            return $result;

        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to get reservation: " . $e->getMessage());
        }
    }

    public function deactivateReservation(int $id)
    {
        try{
            //status 3 = deactivated
            $sql = "UPDATE reservation SET status = '3' WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
        } catch (PDOException $e) {
            // Log the error and return failure status
            error_log("Failed to deactivate reservation: " . $e->getMessage());
        }
    }
}