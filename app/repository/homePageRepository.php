<?php

use repository\baseRepository;

include_once 'baseRepository.php';
class homePageRepository extends baseRepository
{
    public function insertHome($title, $image, $content, $prompt)
    {
        $sql = "INSERT INTO homepage(title, image, content, prompt) VALUES (:title, :image, :content, :prompt)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":prompt", $prompt);
        return $stmt->execute();
    }
//    {
//        $sql = "INSERT INTO editor(content, created) VALUES (:content, NOW())";
//        $stmt = $this->connection->prepare($sql);
//        $stmt->bindParam(":content", $content);
//        return $stmt->execute();
//    }

    public function getAllHome()
    {
        $sql = "SELECT id, title, image, content, prompt FROM homepage";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateHomePages($id, $title, $image, $content, $prompt){
        $sql = "UPDATE homepage SET title = :title, image = :image, content = :content, prompt = :prompt WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":prompt", $prompt);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}