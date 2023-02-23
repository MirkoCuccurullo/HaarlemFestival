<?php
require_once __DIR__ . '/../../service/editorService.php';

class editorControllerAPI
{
    private $editorService;

    // initialize services
    function __construct()
    {
        $this->editorService = new editorService();
    }

    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');

        // Respond to a GET request to /api/article
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            // your code here
            $cards = $this->editorService->getAllHome();
            header('Content-Type: application/json');
            echo json_encode($cards);
            // return all articles in the database as JSON

        }

    }
}