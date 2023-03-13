<?php

use repository\baseRepository;

include_once 'baseRepository.php';
require_once '../model/historyPageCard.php';


class historyEventRepository extends baseRepository
{
    public function getAllHistoryCard()
    {
        $stmt = $this->connection->prepare("SELECT * FROM historyEvent");
        $stmt -> execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'historyPageCard');
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getHistoryPageContent()
    {
        $stmt = $this->connection->prepare("SELECT * FROM historyPageContent");
        $stmt -> execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'historyPageContent');
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getHistoryTourTimetable()
    {
        $stmt = $this->connection->prepare("SELECT * FROM historyTourTimetable ");
        $stmt -> execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function getHistoryTicketById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM historyTourTimetable WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}