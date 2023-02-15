<?php
require_once __DIR__ . '/../../service/userService.php';
require_once __DIR__ . '/../../model/user.php';
class userControllerAPI
{
    private $userService;

    // initialize services
    function __construct()
    {
        $this->userService = new userService();
    }
    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');

        // Respond to a GET request to /api/article
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            // your code here
            $appointments = $this->userService->getAllUsers();
            header('Content-Type: application/json');
            echo json_encode($appointments);
            // return all articles in the database as JSON

        }

    }
}