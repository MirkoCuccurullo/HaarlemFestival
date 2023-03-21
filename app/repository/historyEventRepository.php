<?php

use repository\baseRepository;

include_once 'baseRepository.php';
require_once '../model/historyPageCard.php';

class historyEventRepository extends baseRepository
{

    public function insertHistoryContent($title, $image, $content) : bool {
        $stmt = $this->connection->prepare("INSERT INTO historyEvent (title, image, content) VALUES (:title, :image, :content)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':content', $content);
        return $stmt->execute();
    }

    public function deleteHistoryContent($id) {
        $stmt = $this->connection->prepare("DELETE FROM historyEvent WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }

    public function updateHistoryContent($id, $title, $image, $content) {
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