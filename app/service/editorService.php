<?php

require_once '../repository/editorRepository.php';
class editorService{
    private $editorRepo;
    public function __construct(){
        $this->editorRepo = new editorRepository();
    }
    public function insertHome($content){
        return $this->editorRepo->insertHome($content);
    }

    public function getAllHome(){
        return $this->editorRepo->getAllHome();
    }
}