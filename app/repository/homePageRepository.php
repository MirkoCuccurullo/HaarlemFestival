<?php

use repository\baseRepository;

require_once __DIR__ . '/../model/homePageCard.php';
include_once 'baseRepository.php';


class homePageRepository extends baseRepository
{
 public function getParagraphInfo() : array
 {
  $stmt = $this->connection->prepare("SELECT title, image, content, prompt FROM homePage");
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
     return $result;
 }

}