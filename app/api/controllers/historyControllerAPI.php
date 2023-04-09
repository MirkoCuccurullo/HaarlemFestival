<?php
require_once __DIR__ . '/../../service/historyEventService.php';
require_once __DIR__ . '/../../model/historyTourTimetable.php';
class historyControllerAPI
{

    private $historyEventService;

    // initialize services
    function __construct()
    {
        $this->historyEventService = new historyEventService();
    }

    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');

        // Respond to a GET request to /api/article
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            // your code here
            $cards = $this->historyEventService->getHistoryTourTimetable();
            header('Content-Type: application/json');
            echo json_encode($cards);
            // return all articles in the database as JSON

        }

    }

}