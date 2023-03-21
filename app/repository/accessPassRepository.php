<?php

use repository\baseRepository;

include_once 'baseRepository.php';
require_once __DIR__ . '/../model/accessPass.php';

class accessPassRepository extends baseRepository
{
    public function getAccessPassById($id){
        $sql = "SELECT * FROM access_passes WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "accessPass");
        $result = $stmt->fetch();
        return $result;
    }
}