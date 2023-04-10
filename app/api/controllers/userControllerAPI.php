<?php
require_once __DIR__ . '/../../service/userService.php';
require_once __DIR__ . '/../../model/user.php';
class userControllerAPI
{
    private $userService;

    function __construct()
    {
        $this->userService = new userService();
    }
    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');

        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $appointments = $this->userService->getAllUsers();
            header('Content-Type: application/json');
            echo json_encode($appointments);
        }

    }

    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $body = file_get_contents('php://input');
            $obj = json_decode($body);
            $this->userService->deleteUser($obj->id);
        }
    }
}