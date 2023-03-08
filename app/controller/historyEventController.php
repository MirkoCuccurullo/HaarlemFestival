<?php

use router\router;


require_once __DIR__ . '/../service/historyEventService.php';

class historyEventController
{
    private $historyEventService;

    public function __construct()
    {
        $this->historyEventService = new historyEventService();
    }

    public function index()
    {
        require __DIR__ . '/../view/home/index.php';
    }
}