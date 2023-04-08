<?php

use repository\baseRepository;

include_once 'baseRepository.php';
require_once '../model/historyPageCard.php';
require_once '../model/historyTourTimetable.php';
require_once '../model/historyPageContent.php';
require_once '../model/historyEventDetail.php';

class historyEventRepository extends baseRepository
{
    // Main Content CRUD
    public function updateMainContent($id, $mainImageHeader, $tourCardHeader, $tourCardParagraph, $tourCardButtonText) {
        $stmt = $this->connection->prepare("UPDATE historypagecontent SET mainImageHeader=:mainImageHeader, tourCardHeader=:tourCardHeader, tourCardParagraph=:tourCardParagraph, tourCardButtonText=:tourCardButtonText WHERE id=:id");
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
    public function insertHistorySchedule($dateAndDay, $time, $language, $ticketAmount)  {
        $stmt = $this->connection->prepare("INSERT INTO historytourtimetable (dateAndDay, time, language, ticketAmount) VALUES (:dateAndDay, :time, :language, :ticketAmount)");
        $stmt->bindParam(':dateAndDay', $dateAndDay);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':language', $language);
        $stmt->bindParam(':ticketAmount', $ticketAmount);
        $stmt->bindParam(':price', $price);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'historyTourTimetable');
        $result = $stmt->fetchAll();
        return $result;
    }
    public function deleteHistorySchedule($id) {
        $stmt = $this->connection->prepare("DELETE FROM historytourtimetable WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    public function updateHistorySchedule($id, $dateAndDay, $time, $language, $ticketAmount) {
        $stmt = $this->connection->prepare("UPDATE historytourtimetable SET dateAndDay=:dateAndDay, time=:time, language=:language, ticketAmount=:ticketAmount WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':dateAndDay', $dateAndDay);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':language', $language);
        $stmt->bindParam(':ticketAmount', $ticketAmount);
        $stmt->bindParam(':price', $price);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'historyTourTimetable');
        $result = $stmt->fetchAll();
        return $result;
    }


    // Card Content CRUD
    public function insertHistoryCardContent($title, $image, $content) : bool {
        $stmt = $this->connection->prepare("INSERT INTO historyevent (title, image, content) VALUES (:title, :image, :content)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':content', $content);
        return $stmt->execute();
    }
    public function deleteHistoryCardContent($id) {
        $stmt = $this->connection->prepare("DELETE FROM historyevent WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }
    public function updateHistoryCardContent($id, $title, $image, $content) {
        $stmt = $this->connection->prepare("UPDATE historyevent SET title=:title, image=:image, content=:content WHERE id=:id");
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
        $stmt = $this->connection->prepare("SELECT * FROM historyevent");
        $stmt -> execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'historyPageCard');
        $result = $stmt->fetchAll();
        return $result;
    }
    public function getHistoryPageContent()
    {
        $stmt = $this->connection->prepare("SELECT * FROM historypagecontent");
        $stmt -> execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'historyPageContent');
        $result = $stmt->fetchAll();
        return $result;
    }
    public function getHistoryTicketById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM historytourtimetable WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getLocationDetailById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM historyeventdetails WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result;
    }
    public function getHistoryTourTimetable()
    {
        $stmt = $this->connection->prepare("SELECT * FROM historytourtimetable ");
        $stmt -> execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function getHistoryEventByID(string $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM historyevent WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    public function getByDayFilter($dateAndDay) {
        $stmt = $this->connection->prepare("SELECT * FROM historytourtimetable WHERE dateAndDay=:dateAndDay");
        $stmt->bindParam(':dateAndDay', $dateAndDay);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result;

    }

    public function dateAlreadyExists(string $dateAndDay)
    {
        $stmt = $this->connection->prepare("SELECT * FROM historytourtimetable WHERE dateAndDay=:dateAndDay");
        $stmt->bindParam(':dateAndDay', $dateAndDay);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result;
    }

}