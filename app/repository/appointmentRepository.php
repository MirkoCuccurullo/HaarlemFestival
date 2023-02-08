<?php
require_once("baseRepository.php");

class appointmentRepository extends baseRepository
{

    public function updateEventId($event_id, $id){
        require_once("../model/appointment.php");
        $sqlQ = "UPDATE event SET google_calendar_event_id=:event_id WHERE id=:id";
        $stmt = $this->connection->prepare($sqlQ);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getAppointmentById($id){
        require_once("../model/appointment.php");
        $sqlQ = "SELECT * FROM event WHERE id = :id";
        $stmt = $this->connection->prepare($sqlQ);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'appointment');

        return $stmt->fetch();
    }
    public function addAppointment($appointment){
        require_once("../model/appointment.php");

        $sqlQ = "INSERT INTO event (client_name,lawyer_id,date,time_from,time_to,created) VALUES 
                                                                                  (:client_name,:lawyer_id,:date,:time_from,:time_to,NOW())";
        $stmt = $this->connection->prepare($sqlQ);
        $stmt->bindParam(':client_name', $appointment->client_name);
        $stmt->bindParam(':lawyer_id', $appointment->lawyer_id);
        $stmt->bindParam(':date', $appointment->date);
        $stmt->bindParam(':time_from', $appointment->time_from);
        $stmt->bindParam(':time_to', $appointment->time_to);

        return $stmt->execute();


    }

    public function getAllAppointments(){
        require_once("../model/appointment.php");

        $stmt = $this->connection->prepare("select * from event");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'appointment');
        $appointments = $stmt->fetchAll();

        foreach ($appointments as $appointment) {
            require_once("../model/lawyer.php");
            require_once("../repository/lawyerRepository.php");
            $lawyer_repo = new lawyerRepository();

            $lawyer = $lawyer_repo->getLawyerById($appointment->lawyer_id);
            $appointment->lawyer_name = $lawyer->firstname;
        }

        return $appointments;
    }

    public function deleteAppointment($appointmentId){
        require_once("../model/appointment.php");
        $stmt = $this->connection->prepare("delete from event where id=$appointmentId");
        $stmt->execute();
    }

    public function lastID()
    {
        return $this->connection->lastInsertId();
    }

    public function updateAppointment($newAppointment, $id)
    {
        require_once("../model/appointment.php");
        $sqlQ = "UPDATE event SET client_name=:client_name,date=:date,time_from=:timef,time_to=:timet WHERE id=:id";
        $stmt = $this->connection->prepare($sqlQ);
        $stmt->bindParam(':client_name', $newAppointment->client_name);
        $stmt->bindParam(':date', $newAppointment->date);
        $stmt->bindParam(':timef', $newAppointment->time_from);
        $stmt->bindParam(':timet', $newAppointment->time_to);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}