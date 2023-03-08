<?php

use repository\baseRepository;

include_once 'baseRepository.php';

class historyEventRepository extends baseRepository
{
    public function getHistoryEvent($id){
        $sql = "SELECT * FROM history_event WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'historyEvent');
        $result = $stmt->fetch();
        return $result;
    }

    public function insertHistoryEventToDatabase($title, $image, $content, $prompt): bool
    {
        $sql = "INSERT INTO history_event (title, image, content, prompt) VALUES (:title, :image, :content, :prompt)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":prompt", $prompt);
        return $stmt->execute();
    }

    public function getAllHistoryEvents()
    {
        $sql = "SELECT * FROM history_event";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'historyEvent');
        $result = $stmt->fetchAll();
        return $result;
    }

    public function updateHistoryEvent($id, $title, $image, $content, $prompt)
    {
        $sql = "UPDATE history_event SET title = :title, image = :image, content = :content, prompt = :prompt WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['title' => $title, 'image' => $image, 'content' => $content, 'prompt' => $prompt, 'id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteHistoryEvent($id)
    {
        $sql = "DELETE FROM history_event WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}