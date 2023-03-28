<?php

use repository\baseRepository;

include_once 'baseRepository.php';
require_once '../model/historyPageCard.php';

class historyEventRepository extends baseRepository
{
    // Main Content CRUD
    public function updateMainContent($id, $mainImageHeader, $tourCardHeader, $tourCardParagraph, $tourCardButtonText) {
        $stmt = $this->connection->prepare("UPDATE historyPageContent SET mainImageHeader=:mainImageHeader, tourCardHeader=:tourCardHeader, tourCardParagraph=:tourCardParagraph, tourCardButtonText=:tourCardButtonText WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':mainImageHeader', $mainImageHeader);
        $stmt->bindParam(':tourCardHeader', $tourCardHeader);
        $stmt->bindParam(':tourCardParagraph', $tourCardParagraph);
        $stmt->bindParam(':tourCardButtonText', $tourCardButtonText);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }


    // Schedule Content CRUD
    public function insertHistorySchedule($dateAndDay, $time, $language, $ticketAmount) : bool {
        $stmt = $this->connection->prepare("INSERT INTO historyTourTimetable (dateAndDay, time, language, ticketAmount) VALUES (:dateAndDay, :time, :language, :ticketAmount)");
        $stmt->bindParam(':dateAndDay', $dateAndDay);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':language', $language);
        $stmt->bindParam(':ticketAmount', $ticketAmount);
        return $stmt->execute();
    }
    public function deleteHistorySchedule($id) {
        $stmt = $this->connection->prepare("DELETE FROM historyTourTimetable WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    public function updateHistorySchedule($id, $dateAndDay, $time, $language, $ticketAmount) {
        $stmt = $this->connection->prepare("UPDATE historyTourTimetable SET dateAndDay=:dateAndDay, time=:time, language=:language, ticketAmount=:ticketAmount WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':dateAndDay', $dateAndDay);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':language', $language);
        $stmt->bindParam(':ticketAmount', $ticketAmount);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }


    // Card Content CRUD
    public function insertHistoryCardContent($title, $image, $content) : bool {
        $stmt = $this->connection->prepare("INSERT INTO historyEvent (title, image, content) VALUES (:title, :image, :content)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':content', $content);
        return $stmt->execute();
    }
    public function deleteHistoryCardContent($id) {
        $stmt = $this->connection->prepare("DELETE FROM historyEvent WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }
    public function updateHistoryCardContent($id, $title, $image, $content) {
        $stmt = $this->connection->prepare("UPDATE historyEvent SET title=:title, image=:image, content=:content WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':content', $content);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }

    // Get Methods
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
    public function getLocationDetailById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM historyEventDetails WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result;
    }

}