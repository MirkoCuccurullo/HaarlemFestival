<?php
require_once __DIR__ . '/../repository/accessPassRepository.php';
class accessPassService
{
    private $accessPassRepo;
    public function __construct(){
        $this->accessPassRepo = new accessPassRepository();
    }

    public function getAccessPassById($id){
        return $this->accessPassRepo->getAccessPassById($id);
    }
}