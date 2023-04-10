<?php
require_once __DIR__ . '/../../service/eventService.php';
require_once __DIR__ . '/../../model/venues.php';
class venuesControllerAPI
{
    private $eventService;

    function __construct()
    {
        $this->eventService = new eventService();
    }

    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');

        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $cards = $this->eventService->getVenues();
            header('Content-Type: application/json');
            echo json_encode($cards);

        }

    }

    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $body = file_get_contents('php://input');
            $obj = json_decode($body);
            $this->eventService->deleteVenue($obj->id);
        }
    }
    public function getOne($id){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');

        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $cards = $this->eventService->getVenueByID($id);
            header('Content-Type: application/json');
            echo json_encode($cards);
        }

    }
}