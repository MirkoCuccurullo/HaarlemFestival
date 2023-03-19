<?php
require_once __DIR__ . '/../../service/restaurantService.php';
require_once __DIR__ . '/../../model/session.php';

class sessionControllerAPI
{
    private restaurantService $restaurantService;

    function __construct()
    {
        $this->restaurantService = new restaurantService();
    }
    public function index(): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');

        // Respond to a GET request to /api/session
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $appointments = $this->restaurantService->getAllSessions();
            header('Content-Type: application/json');
            echo json_encode($appointments);

        }
    }

    public function delete(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // your code here
            $body = file_get_contents('php://input');
            $obj = json_decode($body);
            $this->restaurantService->deleteSession($obj->id);
        }
    }
}