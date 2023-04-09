<?php

use repository\baseRepository;

include_once 'baseRepository.php';
class festivalPageRepository extends baseRepository
{
    public function insertFestivalCard($title, $image, $content, $prompt)
    {
        $sql = "INSERT INTO festival_page(title, image, content, prompt) VALUES (:title, :image, :content, :prompt)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":prompt", $prompt);
        return $stmt->execute();
    }

    public function getAllFestivalCards()
    {
        $sql = "SELECT id, title, image, content, prompt FROM festival_page";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateFestivalCard($id, $title, $image, $content, $prompt){
        $sql = "UPDATE festival_page SET title = :title, image = :image, content = :content, prompt = :prompt WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":prompt", $prompt);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function deleteFestivalCard($id){
        $sql = "DELETE FROM festival_page WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

}