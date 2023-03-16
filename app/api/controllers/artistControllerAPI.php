<?php
require_once __DIR__ . '/../../service/eventService.php';
require_once __DIR__ . '/../../model/artist.php';
class artistControllerAPI
{
    private $eventService;

    // initialize services
    function __construct()
    {
        $this->eventService = new eventService();
    }

    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');

        // Respond to a GET request to /api/article
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            // your code here
            $cards = $this->eventService->getArtists();
            header('Content-Type: application/json');
            echo json_encode($cards);
            // return all articles in the database as JSON

        }

    }

    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // your code here
            $body = file_get_contents('php://input');
            $obj = json_decode($body);
            $this->eventService->deleteArtist($obj->id);
        }
    }

}