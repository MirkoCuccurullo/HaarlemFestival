<?php

use repository\baseRepository;

include_once 'baseRepository.php';
class editorRepository extends baseRepository
{
    public function insertHome($content)
    {
        $sql = "INSERT INTO editor(content, created) VALUES (:content, NOW())";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":content", $content);
        return $stmt->execute();
    }

    public function getAllHome()
    {
        $sql = "SELECT id, content FROM editor";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}