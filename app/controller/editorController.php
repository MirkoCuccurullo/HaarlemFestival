<?php

use router\router;


require_once __DIR__ . '/../service/editorService.php';

class editorController
{
    private $editorService;

    public function __construct()
    {
        $this->editorService = new editorService();
    }

    public function displayEditorPage()
    {
        $home = $this->editorService->getAllHome();
        require __DIR__ . '/../view/home/home-test.php';
    }
}